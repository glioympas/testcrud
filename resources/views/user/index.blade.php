@extends(Auth::user()->isAdministrator() ? 'layouts.dashboard' : 'layouts.app')


@section('content')

<!-- Modals -->
	@include('modals.edit_profile')
<!-- End Modals -->

<div class="container">
	<div class="card">
	  <h5 class="card-header">Welcome to your profile settings {{ Auth::user()->name }}</h5>
	  <div class="card-body">
	    <h5 class="card-title">Let's have a summary of your profile</h5>
	    <div class="card-text">
	    	<ul class="list-group">
			  <li class="list-group-item"><strong>Name:</strong> {{ Auth::user()->name }}</li>
			  <li class="list-group-item"><strong>Email:</strong> {{ Auth::user()->email }}</li>
			  <li class="list-group-item"><strong>Became member:</strong> {{ Auth::user()->created_at }}</li>

			</ul>
	    </div>
	    <button class="editProfile btn btn-primary ml-2 mt-4" type="button" data-toggle="modal" data-target="#editProfileModal">Edit your profile settings</button>
	  </div>
	</div>

	<div class="mt-4">
		<strong>
			<i>*Σημείωση:</i>
			Εδώ πέρα επίτηδες κάνω refresh την σελίδα μετά το update επειδή θα έπρεπε το text να αλλάξει σε αρκετά σημεία
			όπως να γίνει update το όνομα πάνω στο navbar, και στα στοιχεία του χρήστη.
			Επίσης μετά από ένα profil update , μια ανανέωση πιστεύω δίνει στο χρήστη μια πιο "ασφαλές" εντύπωση.
		</strong>
	</div>
</div>

@endsection

@section('scripts')
	<script>

		$(document).ready(function(){


			//Set current values to modal's form
			$('.editProfile').on('click', function(){
				$('#name').val("{{ Auth::user()->name }}");
				$('#email').val("{{ Auth::user()->email }}");

				$('#current_password').val(''); //In case any cache comes in the middle
			});

			//Update profil form 
			$('#edit_profile_form').on('submit', function(e){
				e.preventDefault();
				let formData = $(this).serializeArray();
				formData.push({'name' : '_method', 'value' : 'PATCH'});

				$.ajax({
					method:'POST',
					url:"{{ route('update_profil') }}",
					data: formData,
					success: function(response)
					{
						$('#closeEditProfileModal').click();
						$('#edit_profile_form')[0].reset();
						swal("Completed", `Your profile updated successfully.`, "success");

						//Reload Website because there are many areas where texts must change.
						window.location.reload();
					},
					error: function(error)
					{

						//Validation Errors - 422 Status Code.
						if(error.status == 422){
							let errorMessage = '';

							if(error.responseJSON.incorrect_password){
								errorMessage += `<div class="alert alert-danger"> Current password is incorrect. </div>`;
								$('.edit_profile_errors').html(errorMessage);
							}

							$.each(error.responseJSON.errors, function(key,message){
								errorMessage += `<div class="alert alert-danger"> ${message} </div>`;
								$('.edit_profile_errors').html(errorMessage);
							})
						}
					}
				});
			});

		});


	</script>
@endsection