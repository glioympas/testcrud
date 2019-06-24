<div class="modal fade" id="createCustomerModal" tabindex="-1" role="dialog" aria-labelledby="createCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">


        <div class="modal-header">
          <h5 class="modal-title" id="createCustomerModalLabel">Create new customer</h5>
          <button id="closeCreateCustomerModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <div class="modal-body">
          
          <div class="create_customer_errors">
            
          </div>

          <form id="create_customer_form" action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="name">Customer Name:</label>
              <input type="text" id="name" name="name" class="form-control">
            </div>

            <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" id="email" name="email" class="form-control">
            </div>

            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" id="password" name="password" class="form-control">
            </div>
            
            <button type="submit" class="btn btn-success">Create Customer</button>

          </form>
        </div>

      </div>
    </div>
</div>