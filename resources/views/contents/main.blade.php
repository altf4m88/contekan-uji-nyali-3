@extends('dashboard')

@section('content')
<div id="create-report-toast" class="toast @if(Session::has('success-create')) show @else hide @endif" role="alert" aria-live="polite" aria-atomic="true" style="position: absolute; top: 5rem; right: 2rem;">
    <div class="toast-header">
        <strong class="me-auto">Sukses Mengirim Laporan</strong>
        <button type="button" id="create-report-toast-button" class="btn-close ms-2 mb-1" data-bs-dismiss="toast" aria-label="Close">
            <span aria-hidden="true"></span>
        </button>
    </div>
    <div class="toast-body">
        {!! Session::get('success-create') !!}
    </div>
</div>

<div class="d-flex my-3 mb-5 justify-content-around" style="height: 65vh">
    <div class="div w-50">
        <img class="w-100" src="{{asset('asset/svg/dashboard-green.svg')}}">
    </div>
    <div class="text-center d-flex align-items-center justify-content-center flex-column">
        <div class="">
            <h1>Selamat Datang</h1>
            <h1>Di Pengaduan Masyarakat</h1>
        </div>
        <div class="mt-3">
            <button class="btn btn-lg btn-primary" id="create_report">Buat Pengaduan</button>
            {{-- <a href="/reports" class="btn btn-lg btn-warning">Lihat Pengaduan</a> --}}
        </div>
    </div>
</div>
<div class="d-flex ">
    <div class="d-flex justify-content-around w-100">
        <div class="d-flex flex-column mx-2 mb-3 w-75">
            <div class="d-flex flex-column mb-4">
                <h2>Pengaduan Belum Diproses</h2>
                @forelse ($draftReport as $report)
                    <div class="list-group mb-3" max-width="30rem">
                        <a href="javascript:void(0)"  class="list-group-item list-group-item-action flex-column align-items-start border-warning">
                            <div class="d-flex w-100 justify-content-end">
                                <small class="text-muted">{{$report->localized_date}}</small>
                            </div>
                            <p class="mb-1 mt-2">{{$report->report}}</p>
                        <small class="text-muted">Dikirim oleh {{substr_replace($report->civillian->name, '*****', 3)}}</small>
                        </a>
                    </div>
                @empty
                    <div class="alert alert-warning">
                        Belum ada laporan.
                    </div>
                @endforelse
            </div>
            <div class="d-flex flex-column mb-4">
                <h2>Pengaduan Sedang Diproses</h2>
                @forelse ($onProgressReport as $report)
                    <div class="list-group mb-3" max-width="30rem">
                        <a href="javascript:void(0)"  class="list-group-item list-group-item-action flex-column align-items-start border-primary">
                            <div class="d-flex w-100 justify-content-end">
                                <small class="text-muted">{{$report->localized_date}}</small>
                            </div>
                            <p class="mb-1 mt-2">{{$report->report}}</p>
                        <small class="text-muted">Dikirim oleh {{substr_replace($report->civillian->name, '*****', 3)}}</small>
                        </a>
                    </div>
                @empty
                    <div class="alert alert-primary">
                        Belum ada laporan.
                    </div>
                @endforelse
            </div>
            <div class="d-flex flex-column mb-4">
                <h2>Pengaduan Selesai Diproses</h2>
                @forelse($doneReport as $report)
                    <div class="list-group mb-3" max-width="30rem">
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action flex-column align-items-start border-success">
                            <div class="d-flex w-100 justify-content-end">
                                <small class="text-muted">{{$report->localized_date}}</small>
                            </div>
                            <p class="mb-1 mt-2">{{$report->report}}</p>
                        <small class="text-muted">Dikirim oleh {{substr_replace($report->civillian->name, '*****', 3)}}</small>
                        </a>
                    </div>
                @empty
                    <div class="alert alert-success">
                        Belum ada laporan.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    $('#create_report').click(() => {
        $('#createModal').modal('show')
    })

    $('#show-login-modal').click(() => {
        $('#loginModal').modal('show')
    })

    $('#create-report-toast-button').click(() => {
        $('#create-report-toast').toast('hide');
    });
</script>
@endsection
