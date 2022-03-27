<div class="modal fade" tabindex="-1" role="dialog"  id="editAccountModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{URL::to('/employee-account')}}" method="post">
                @method('PATCH')
                @csrf
                <input type="hidden" name="id" id="edit-id">
            <fieldset class="form-group mb-2">
                <label>Username</label>
                <input type="text" max="255" class="form-control" name="username" id="edit-username" readonly required placeholder="Username">
            </fieldset>
            <fieldset class="form-group mb-2">
                <label>Nama</label>
                <input type="text" max="255" class="form-control" name="employee_name" id="edit-employee-name" required placeholder="Nama">
            </fieldset>
            <fieldset class="form-group mb-2">
                <label>No. HP</label>
                <input type="number" class="form-control" name="phone" id="edit-phone" placeholder="No HP">
            </fieldset>
        </div>
        <div class="modal-footer d-flex justify-content-between">
            <div>
                <button type="button" class="btn btn-danger" onclick="deleteData()">Hapus</button>
            </div>
            <div class="d-flex ">
                <div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

            </form>
        </div>
        </div>
    </div>
</div>
