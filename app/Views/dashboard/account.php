<div class="container mt-4">
    <div class='row'>

            <div class="card mt-4" style='padding: 0px;'>
                <div class="card-header">
                    <h2 id='title_' style='text-align: center;'> Account Settings </h2>
                    <small> those things that matter a little... </small>
                </div>
                <div class="card-body">

                    <div class='row'>
                        <h4> Reset User Password </h4>
                        <div class='form-group'>

                        <form method='post' action='/users/changePassword/'>
                            <label> Current Password </label>
                            <input type='password' name='currentPassword' class='form-control' />
                            <label> Password </label>
                            <input type='password'  name='newPassword' class='form-control' />
                            <label> Confirm Password </label>
                            <input type='password' name='newPasswordConfirm' class='form-control' />
                        </div>

                        <div class='form-group mt-3' style='margin: auto; width: auto'>
                            <button class='btn started'> Change Password </button>
                        </div>
                    </div>
                    </form>

                </div>

            </div>
    </div>
</div>