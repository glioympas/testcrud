@extends('layouts.dashboard')

@section('content')
	
	<!-- Modals -->
		@include('modals.create_customer')
		@include('modals.edit_customer')
	<!-- End Modals -->

	<h1>Manage Customer Users</h1>
	<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#createCustomerModal">Create a new customer</button>
	<table class="customers-table table mt-4 table-responsive">
		<thead>
			<th>Name</th>
			<th>Email</th>
			<th>Created</th>
			<th>Last Updated</th>
			<th>Actions</th>
		</thead>

		<tbody>
			@foreach($customers as $customer)
			
				<tr data-userid="{{ $customer->id }}">
					<td>{{ $customer->name }}</td>
					<td>{{ $customer->email }}</td>
					<td>{{ $customer->created_at }}</td>
					<td>{{ $customer->updated_at }}</td>
					<td>
						<button class="btn btn-outline-primary editCustomer type="button" data-toggle="modal" data-target="#editCustomerModal">Edit</button>
						<button class="btn btn-outline-danger deleteCustomer">Delete</button>
					</td>
				</tr>

			@endforeach
		</tbody>

	</table>
@endsection


@section('scripts')
	<script>
		$(document).ready(function(){

			//Create Customer
			$('#create_customer_form').on('submit', function(e){
				e.preventDefault();
				let formData = $(this).serialize();
				$.ajax({
					method: "POST",
					url: "{{ route('customers.store') }}",
					data: formData,
					success: function(response)
					{
						let user = response.user;
						//Create row with created user informations.
						let row = `
								<tr data-userid="${user.id}">
								<td>${user.name}</td>
								<td>${user.email}</td>
								<td>${user.created_at}</td>
								<td>${user.updated_at}</td>
								<td>
									<button class="btn btn-outline-primary editCustomer type="button" data-toggle="modal" data-target="#editCustomerModal">Edit</button>
									<button class="btn btn-outline-danger deleteCustomer">Delete</button>
								</td>
								</tr>
						`;

						//Add Row to TBODY
						$('table tbody').prepend(row);

						//Close Modal and Reset Form Values
						$('#closeCreateCustomerModal').click();
						$('#create_customer_form')[0].reset();
						swal("Completed", `Customer ${user.name} created successfully.`, "success");
					},
					error: function(error)
					{
						//Validation Errors - 422 Status Code.
						if(error.status == 422){
							let errorMessage = '';
							$.each(error.responseJSON.errors, function(key,message){
								errorMessage += `<div class="alert alert-danger"> ${message} </div>`;
								$('.create_customer_errors').html(errorMessage);
							})
						}
					}
				});
			});



			//Delete Customer
			$(document).on('click' , '.deleteCustomer', function(){
				swal({
				  title: "Are you sure?",
				  text: "Do you want to delete this customer?",
				  icon: "warning",
				  buttons: ["Cancel", "Delete"],
				  dangerMode: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
				    let userId = this.parentElement.parentElement.getAttribute('data-userid'); 
					$.ajax({
						method:'POST',
						url:"/admin/customers/"+userId,
						data:{'_method':'DELETE', '_token': "{{ csrf_token() }}"},
						success: function(response)
						{
							let row = $(`tr[data-userid="${userId}"]`);
							row.remove();
							swal("Deleted", "Customer deleted successfully.", "success");
						}
					});
				  }
				});
				
			});


			//Edit Customer (Set Form Values)
			$(document).on('click', '.editCustomer', function(){
				let nameElement = this.parentElement.parentElement.firstElementChild;
				let emailElement =  this.parentElement.parentElement.firstElementChild.nextElementSibling;
				let userId = this.parentElement.parentElement.getAttribute('data-userid');
				$('#edit_user_id').val(userId);
				$('#edit_name').val(nameElement.innerText);
				$('#edit_email').val(emailElement.innerText);
			})

			//Edit Customer (Save)
			$('#edit_customer_form').on('submit' , function(e){
				e.preventDefault();
				let formData = $(this).serializeArray();
				formData.push({name:'_method', value:'PATCH'});
				$.ajax({
					method:'POST',
					url:'/admin/customers/'+ $('#edit_user_id').val(),
					data: formData,
					success: function(response)
					{
						//Update row values at table.
						let user = response.user;
						let row = document.querySelector(`tr[data-userid="${user.id}"]`);
						row.firstElementChild.innerText = user.name;
						row.firstElementChild.nextElementSibling.innerText = user.email;

						//update: Last Updated column of the table
						row.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.innerText = "1 second ago";

						//close modal and reset form
						$('#closeEditCustomerModal').click();
						$('#edit_customer_form')[0].reset();
						swal("Completed", `Customer updated successfully.`, "success");
					},
					error: function(error)
					{
						//Validation Errors - 422 Status Code.
						if(error.status == 422){
							let errorMessage = '';
							$.each(error.responseJSON.errors, function(key,message){
								errorMessage += `<div class="alert alert-danger"> ${message} </div>`;
								$('.edit_customer_errors').html(errorMessage);
							})
						}
					}
				});
			});

		});
	</script>
@endsection