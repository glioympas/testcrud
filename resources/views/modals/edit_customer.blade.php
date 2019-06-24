<div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">


        <div class="modal-header">
          <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
          <button id="closeEditCustomerModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <div class="modal-body">

          <div class="edit_customer_errors">
            
          </div>

          <form id="edit_customer_form">
            @csrf
            <input type="hidden" name="edit_user_id"" id="edit_user_id" value="" >
            <div class="form-group">
              <label for="edit_name">Customer Name:</label>
              <input type="text" id="edit_name" name="name" class="form-control">
            </div>

            <div class="form-group">
              <label for="edit_email">Email:</label>
              <input type="text" id="edit_email" name="email" class="form-control">
            </div>

            
            <button type="submit" class="btn btn-success">Update Customer</button>

          </form>
        </div>

      </div>
    </div>
</div>