<div class="modal fade border-success" tabindex="-1" role="dialog"  id="loginModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Login</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{URL::to('/login')}}" method="post">
            @csrf
            <fieldset class="form-group mb-4">
                <label for="inputName">Username</label>
                <input type="text" max="255"  class="form-control" name="username" id="inputUsername" required placeholder="Username">
            </fieldset>
            <fieldset class="form-group mb-2">
                <label for="inputName">Password</label>
                <input type="password" max="255"  class="form-control" name="password" id="inputPassword" required placeholder="Password">
            </fieldset>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-paper-plane"></i> Submit</button>
            </form>
        </div>
        </div>
    </div>
</div>
