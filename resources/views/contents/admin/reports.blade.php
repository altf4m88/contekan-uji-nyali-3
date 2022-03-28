@extends('dashboard')

@section('style')
    <style>
        .table {
            table-layout: fixed;
        }
    </style>
@endsection

@section('content')

@if(Session::has('success-update'))
<div class="alert alert-dismissible alert-success">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    {!! Session::get('success-update') !!}
</div>
@endif

<h4>Laporan Pengaduan Masyarakat</h4>
<div style="height: 100vh" class="mt-3">
    <div class="d-flex justify-content-between mb-4">
        <form action="{{URL('/employee-reports')}}" method="get">
            <div class="input-group">
                <input height="20px" type="search" class="form-control pl-3 py-2 border-left-0 border" value="{{request()->civillian_name ?? ''}}" name="civillian_name" id="teacher-search-box" placeholder="Cari laporan..." onkeyup="checkSearch(event)">
            </div>
        </form>
        {{-- <a class="btn btn-success" href="/print-reports">Cetak Rekap Laporan</a> --}}
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Pengirim</th>
                <th scope="col">No. HP Pelapor</th>
                <th scope="col">Laporan</th>
                <th scope="col">Tanggal Pengaduan</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports['data'] as $report)
                <tr class="@if($report['status'] === 'DRAFT') table-warning @elseif($report['status'] === 'ONPROGRESS') table-primary @else table-success @endif">
                    <td>{{$report['civillian']['name']}}</td>
                    <td>{{$report['civillian']['phone'] ? $report['civillian']['phone'] : '-'}}</td>
                    <td class="text-truncate">{{$report['report']}}</td>
                    <td>{{$report['created_at']}}</td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="showDetailModal({{$report['id']}})">Detail</button>
                        <a class="btn btn-sm btn-success" href="/print-report/{{$report['id']}}" target="_blank">Cetak</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if($reports && ($reports['total'] > 20))
        <nav class="navigation mt-5 d-flex justify-content-between">
            <div>
                <span class="pagination-detail">{{ $reports['to'] }} dari {{ $reports['total'] }} Laporan</span>
            </div>
            <ul class="pagination">
                <li class="page-item {{ (request()->page ?? 1) - 1 <= 0 ? 'disabled' : '' }}">
                    <a class="page-link" href="?page={{ (request()->page ?? 1) - 1 }}" tabindex="-1">&lt;</a>
                </li>
                @if(request()->page >= 5 && $reports['last_page'] > 7)
                <li class="page-item">
                    <a class="page-link" href="?page=1">1</a>
                </li>
                <li class="page-item"><a class="page-link">...</a></li>
                @endif
                @if(request()->page <= 7 && $reports['last_page'] <= 7)
                    @for($i=1; $i <= $reports['last_page']; $i++)
                    <li class="page-item {{ (request()->page ?? 1) == $i ? 'active disabled' : '' }}">
                        <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                    </li>
                    @endfor
                @elseif(request()->page < 5 && $reports['last_page'] > 5)
                    @for($i=1; $i <= 5; $i++)
                    <li class="page-item {{ (request()->page ?? 1) == $i ? 'active disabled' : '' }}">
                        <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                    </li>
                    @endfor
                @elseif(request()->page >= 5 && request()->page <= $reports['last_page'] - 4)
                    @for($i=request()->page - 1; $i <= request()->page + 1; $i++)
                    <li class="page-item {{ (request()->page ?? 1) == $i ? 'active disabled' : '' }}">
                        <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                    </li>
                    @endfor
                @else
                    @for($i=$reports['last_page'] - 4; $i <= $reports['last_page']; $i++)
                    <li class="page-item {{ (request()->page ?? 1) == $i ? 'active disabled' : '' }}">
                        <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                    </li>
                    @endfor
                @endif
                @if(request()->page <= $reports['last_page'] - 4 && $reports['last_page'] > 7)
                <li class="page-item"><a class="page-link">...</a></li>
                <li class="page-item">
                    <a class="page-link" href="?page={{$reports['last_page']}}">{{$reports['last_page']}}</a>
                </li>
                @endif
                <li class="page-item {{ ((request()->page ?? 1) + 1) > $reports['last_page'] ? 'disabled' : '' }}">
                    <a class="page-link" href="?page={{ (request()->page ?? 1) + 1 }}">&gt;</a>
                </li>
            </ul>
        </nav>
    @endif()
</div>
@endsection

@section('modals')
    @include('modals.admin.detail')
@endsection

@section('script')
<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function showDetailModal(id) {
    const url = "/report-detail-admin";
    const baseAssetUrl = `{{asset("/uploads/images")}}`;

    $.ajax({
        method: 'get',
        data: {
            id
        },
        dataType: 'json',
        url: url,
        success: function(response) {
            $('#civillian-detail-name').html(response.civillian.name);
            $('#civillian-detail-phone').html(response.civillian.phone ?? '-');
            $('#report-detail').html(response.report);
            $('#report-date').html(response.created_at);
            $('#detail-image').attr('src', `${baseAssetUrl}/${response.photo}`)
            $('#detailModal').modal('show');
        },
        error: function(error) {
        }
    });
}
</script>


@endsection
