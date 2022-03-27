@extends('dashboard')

@section('content')
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
            <a href="/reports" class="btn btn-lg btn-warning">Lihat Pengaduan</a>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    $('#create_report').click(() => {
        $('#createModal').modal('show')
    })
</script>
@endsection
