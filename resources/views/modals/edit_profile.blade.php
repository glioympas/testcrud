<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="editProfileModalLabel">Edit your profile</h5>
          <button id="closeEditProfileModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <div class="modal-body">
          <div class="edit_profile_errors">
          </div>

          <form id="edit_profile_form">
            @csrf
            <input type="hidden" name="edit_user_id" value="{{ Auth::user()->id }}" />
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" id="name" name="name" class="form-control">
            </div>

            <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" id="email" name="email" class="form-control">
            </div>

            <div class="form-group">
              <label for="current_password">Your current password: (Required)</label>
              <input type="password" id="current_password" name="current_password"  class="form-control">
            </div>

            <div class="form-group">
              <label for="new_password">Your new password: (Not Required)</label>
              <input type="password" id="new_password" name="new_password"  class="form-control">
            </div>
            
            <button type="submit" class="btn btn-success">Update my profil</button>

          </form>
        </div>

      </div>
    </div>
</div>