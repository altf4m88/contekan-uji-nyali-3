<div class="modal fade" tabindex="-1" role="dialog"  id="createModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Buat Pengaduan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{URL::to('/create-report')}}" method="post" enctype="multipart/form-data">
                @csrf
            <fieldset class="form-group mb-2">
                <label for="civillian-id-input">NIK</label>
                <input type="number" class="form-control" name="civillian_id" id="civillian-id-input" required placeholder="NIK">
            </fieldset>
            <fieldset class="form-group mb-2">
                <label for="inputName">Nama</label>
                <input type="text" max="255"  class="form-control" name="name" id="inputName" required placeholder="Nama">
            </fieldset>
            <fieldset class="form-group mb-2">
                <label for="inputPhone">No. HP</label>
                <input type="number" class="form-control" name="phone" id="inputPhone" placeholder="No. HP">
            </fieldset>
            <fieldset class="form-group mb-2">
                <label for="exampleInputPassword1">Pengaduan</label>
                <textarea name="report" class="form-control" id="" cols="30" rows="5"></textarea>
            </fieldset>
            <fieldset class="form-group mb-2">
                <label for="exampleInputFile">Foto Pengaduan</label>
                <input type="file"  class="form-control" accept="image/*" name="photo" id="exampleInputFile" required placeholder="Pilih file">
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
