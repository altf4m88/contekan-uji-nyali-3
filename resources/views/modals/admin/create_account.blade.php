<div class="modal fade" tabindex="-1" role="dialog"  id="createAccountModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Akun</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{URL::to('/employee-account')}}" method="post">
                @csrf
            <fieldset class="form-group mb-2">
                <label>Nama</label>
                <input type="text" max="255" class="form-control" name="employee_name" required placeholder="Nama">
            </fieldset>
            <fieldset class="form-group mb-2">
                <label>No. HP</label>
                <input type="number" class="form-control" name="phone" placeholder="No HP">
            </fieldset>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i> Submit</button>
            </form>
        </div>
        </div>
    </div>
</div>
