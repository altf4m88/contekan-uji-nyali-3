@extends('dashboard')

@section('content')

@if(Session::has('success-create'))
<div class="alert alert-dismissible alert-success">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    {!! Session::get('success-create') !!}
</div>
@endif

@if(Session::has('success-edit'))
<div class="alert alert-dismissible alert-primary">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    {!! Session::get('success-edit') !!}
</div>
@endif
<div style="height: 100vh">
    <div class="d-flex justify-content-between mb-4">
        <form action="{{URL('/registration')}}" method="get">
            <div class="input-group">
                <input height="20px" type="search" class="form-control pl-3 py-2 border-left-0 border" value="{{request()->employee_name ?? ''}}" name="employee_name" id="teacher-search-box" placeholder="Cari petugas..." onkeyup="checkSearch(event)">
            </div>
        </form>
        <button class="btn btn-primary" id="show-create-account-modal">Tambah Akun</button>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Nama Petugas</th>
                <th scope="col">Username</th>
                <th scope="col">No. HP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees['data'] as $employee)
                <tr>
                    <td> <a href="#" class="text-primary text-decoration-none" onclick="showEdit({{$employee['id']}})">{{$employee['employee_name']}}</a></td>
                    <td>{{$employee['username']}}</td>
                    <td>{{$employee['phone'] ? $employee['phone'] : '-'}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@if($employees && ($employees['total'] > 20))
    <nav class="navigation mt-5 d-flex justify-content-between">
        <div>
            <span class="pagination-detail">{{ $employees['to'] }} dari {{ $employees['total'] }} Petugas</span>
        </div>
        <ul class="pagination">
            <li class="page-item {{ (request()->page ?? 1) - 1 <= 0 ? 'disabled' : '' }}">
                <a class="page-link" href="?page={{ (request()->page ?? 1) - 1 }}" tabindex="-1">&lt;</a>
            </li>
            @if(request()->page >= 5 && $employees['last_page'] > 7)
            <li class="page-item">
                <a class="page-link" href="?page=1">1</a>
            </li>
            <li class="page-item"><a class="page-link">...</a></li>
            @endif
            @if(request()->page <= 7 && $employees['last_page'] <= 7)
                @for($i=1; $i <= $employees['last_page']; $i++)
                <li class="page-item {{ (request()->page ?? 1) == $i ? 'active disabled' : '' }}">
                    <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                </li>
                @endfor
            @elseif(request()->page < 5 && $employees['last_page'] > 5)
                @for($i=1; $i <= 5; $i++)
                <li class="page-item {{ (request()->page ?? 1) == $i ? 'active disabled' : '' }}">
                    <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                </li>
                @endfor
            @elseif(request()->page >= 5 && request()->page <= $employees['last_page'] - 4)
                @for($i=request()->page - 1; $i <= request()->page + 1; $i++)
                <li class="page-item {{ (request()->page ?? 1) == $i ? 'active disabled' : '' }}">
                    <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                </li>
                @endfor
            @else
                @for($i=$employees['last_page'] - 4; $i <= $employees['last_page']; $i++)
                <li class="page-item {{ (request()->page ?? 1) == $i ? 'active disabled' : '' }}">
                    <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                </li>
                @endfor
            @endif
            @if(request()->page <= $employees['last_page'] - 4 && $employees['last_page'] > 7)
            <li class="page-item"><a class="page-link">...</a></li>
            <li class="page-item">
                <a class="page-link" href="?page={{$employees['last_page']}}">{{$employees['last_page']}}</a>
            </li>
            @endif
            <li class="page-item {{ ((request()->page ?? 1) + 1) > $employees['last_page'] ? 'disabled' : '' }}">
                <a class="page-link" href="?page={{ (request()->page ?? 1) + 1 }}">&gt;</a>
            </li>
        </ul>
    </nav>
@endif()
</div>
@endsection

@section('modals')
    @include('modals.admin.create_account')
    @include('modals.admin.edit_account')
@endsection

@section('script')
<script>
    function checkSearch(e) {
        if (e.keyCode === 8 && e.currentTarget.value == '') {
            history.pushState({}, null, "{{ URL('/registration') }}");
            location.reload()
        }
    }


    $('#show-create-account-modal').click(() => {
        $('#createAccountModal').modal('show');
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function showEdit(id) {
        const url = "/employee-detail";

        $.ajax({
            method: 'get',
            data: {
                id
            },
            dataType: 'json',
            url: url,
            success: function(response) {
                $('#edit-id').val(response.id);
                $('#edit-employee-name').val(response.employee_name);
                $('#edit-username').val(response.username);
                $('#edit-phone').val(response.phone);
                $('#editAccountModal').modal('show');
            },
            error: function(error) {
            }
        });
    }

    function deleteData() {
        const url = "/employee-account";
        let id = $('#edit-id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'delete',
            data: {
                id
            },
            dataType: 'json',
            url: url,
            success: function(response) {
                window.location.reload();
            },
            error: function(error) {
            }
        });
    }
</script>

@endsection
