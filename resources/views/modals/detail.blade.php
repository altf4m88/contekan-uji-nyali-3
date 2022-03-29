<div class="modal fade" tabindex="-1" role="dialog"  id="detailModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail Laporan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-person"></i> Pelapor : <span id="civillian-detail-name"></span></h5>
                    <h6 class="card-subtitle text-muted"><i class="fa-solid fa-mobile-screen"></i> No. HP : <span id="civillian-detail-phone"></span> </h6>
                    <h6 class="card-subtitle text-muted mt-1"><i class="fa-solid fa-file-circle-question"></i> Status : <span id="civillian-detail-status"></span> </h6>
                </div>
                <img src="" id="detail-image" height="400px" style="object-fit: cover;" alt="">
                <div class="card-body">
                    <p class="card-text" id="report-detail">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <div class="card-footer text-muted">
                    <i class="fa-solid fa-clock"></i> <span id="report-date"></span><br>
                    <i class="fa-solid fa-clock"></i> <span id="updated-date"></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
        </div>
        </div>
    </div>
</div>
