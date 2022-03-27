<div class="modal fade" tabindex="-1" role="dialog"  id="editModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{URL::to('/report')}}" method="post">
            @method('PATCH')
            @csrf
            <div class="alert alert-info">
                Ganti status laporan jika sedang atau sudah ditangani oleh badan pemerintah yang terkait. Hanya hapus laporan jika laporan tidak valid.
            </div>
            <input type="hidden" name="id" id="edit-id">
            <fieldset class="form-group">
                <legend>Ubah Status</legend>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="option-DRAFT" value="DRAFT" >
                        Belum Diproses
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="option-ONPROGRESS" value="ONPROGRESS">
                        Sedang Diproses
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="option-DONE" value="DONE">
                        Selesai Diproses
                    </label>
                </div>
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
