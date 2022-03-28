@extends('dashboard')

@section('content')
<h4 class="text-capitalize mt-5 mb-2 font-weight-bold"><i class="fa-solid fa-users"></i> Selamat Datang, {{$user->employee_name}}</h4>
<div class="d-flex justify-content-around mb-5">
    <div class="card border-warning mb-3" style="max-width: 20rem; width: 20rem;">
        <div class="card-header"><i class="fa-solid fa-circle-question"></i> Pengaduan Belum Diproses</div>
        <div class="card-body">
            <h3 class="card-title"><i class="fa-solid fa-file-lines"></i> {{$draftReports}} Pengaduan</h3>
            <p class="card-text">Pengaduan belum divalidasi dan ditanggapi oleh petugas.</p>
        </div>
    </div>
    <div class="card border-primary mb-3" style="max-width: 20rem; width: 20rem;">
        <div class="card-header"><i class="fa-solid fa-bars-progress"></i> Pengaduan Sedang Diproses</div>
        <div class="card-body">
            <h3 class="card-title"><i class="fa-solid fa-file-lines"></i> {{$onProgressReports}}  Pengaduan</h3>
            <p class="card-text">Pengaduan sedang diproses oleh badan pemerintah yang terkait.</p>
        </div>
    </div>
    <div class="card border-success mb-3" style="max-width: 20rem; width: 20rem;">
        <div class="card-header"><i class="fa-solid fa-list-check"></i> Pengaduan Selesai</div>
        <div class="card-body">
            <h3 class="card-title"><i class="fa-solid fa-file-lines"></i> {{$doneReports}}  Pengaduan</h3>
            <p class="card-text">Pengaduan sudah selesai diproses.</p>
        </div>
    </div>
</div>

<h4><i class="fa-solid fa-square-plus"></i> Pengaduan Terbaru</h4>
<div class="d-flex justify-content-around mb-5">
    @foreach ($latestReports as $item)
    <div class="card mb-3" style="max-width: 20rem; width: 20rem;">
        <div class="card-body">
            <h5 class="card-title"><i class="fa-regular fa-file-lines"></i> Pengaduan Masyarakat</h5>
            <p class="card-subtitle text-muted">Dikirim oleh {{$item->civillian->name}} <i class="fa-solid fa-user"></i></p>
        </div>
        <img src="{{asset("/uploads/images/$item->photo")}}" height="300px" style="object-fit: cover;" alt="">
        <div class="card-body" style="min-height: 100px">
            <p class="card-text text-truncate">{{$item->report}}</p>
        </div>
        <div class="card-footer text-muted">
            <i class="fa-solid fa-calendar-day"></i> {{$item->localized_date}}
        </div>
    </div>
    @endforeach
</div>

@endsection


@section('script')
<script>

</script>


@endsection
