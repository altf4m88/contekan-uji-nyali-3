@extends('dashboard')

@section('content')
<h4 class="text-capitalize my-5 font-weight-bold">Selamat Datang, {{$user->employee_name}}</h4>
<div class="d-flex justify-content-around mb-5">
    <div class="card border-warning mb-3" style="max-width: 20rem; width: 20rem;">
        <div class="card-header">Pengaduan Belum Diproses</div>
        <div class="card-body">
            <h3 class="card-title">{{$draftReports}} Pengaduan</h3>
            <p class="card-text">Pengaduan belum divalidasi dan ditanggapi oleh petugas.</p>
        </div>
    </div>
    <div class="card border-primary mb-3" style="max-width: 20rem; width: 20rem;">
        <div class="card-header">Pengaduan Sedang Diproses</div>
        <div class="card-body">
            <h3 class="card-title">{{$onProgressReports}}  Pengaduan</h3>
            <p class="card-text">Pengaduan sedang diproses oleh badan pemerintah yang terkait.</p>
        </div>
    </div>
    <div class="card border-success mb-3" style="max-width: 20rem; width: 20rem;">
        <div class="card-header">Pengaduan Selesai</div>
        <div class="card-body">
            <h3 class="card-title">{{$doneReports}}  Pengaduan</h3>
            <p class="card-text">Pengaduan sudah selesai diproses.</p>
        </div>
    </div>
</div>

<h4>Pengaduan Terbaru</h4>
<div class="d-flex justify-content-around mb-5">
    @foreach ($latestReports as $item)
    <div class="card mb-3" style="max-width: 20rem; width: 20rem;">
        <div class="card-body">
            <h5 class="card-title">Pengaduan Masyarakat</h5>
            <p class="card-subtitle text-muted">Dikirim oleh {{$item->civillian->name}}</p>
        </div>
        <img src="{{asset("/uploads/images/$item->photo")}}" height="300px" style="object-fit: cover;" alt="">
        <div class="card-body" style="min-height: 100px">
            <p class="card-text text-truncate">{{$item->report}}</p>
        </div>
        <div class="card-footer text-muted">
            {{$item->localized_date}}
        </div>
    </div>
    @endforeach
</div>

@endsection


@section('script')
<script>

</script>


@endsection
