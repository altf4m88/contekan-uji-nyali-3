@extends('dashboard')

@section('content')
@dump(get_defined_vars())
<div class="d-flex ">
    <div class="d-flex justify-content-around w-100">
        <div class="d-flex flex-column mx-2 mb-3 w-50">
            <div class="d-flex flex-column mb-4">
                <h2>Pengaduan Belum Diproses</h2>
                @foreach ($draftReport as $report)
                    <div class="list-group mb-3" max-width="30rem">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-end">
                                <small class="text-muted">{{$report->created_at}}</small>
                            </div>
                            <p class="mb-1">{{$report->report}}</p>
                        <small class="text-muted">Dikirim oleh {{substr_replace($report->civillian->name, '*****', 3)}}</small>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="d-flex flex-column mb-4">
                <h2>Pengaduan Sedang Diproses</h2>
                <div class="list-group" max-width="30rem">
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">List group item heading</h5>
                            <small class="text-muted">3 days ago</small>
                        </div>
                        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                        <small class="text-muted">Donec id elit non mi porta.</small>
                    </a>
                </div>
            </div>
            <div class="d-flex flex-column mb-4">
                <h2>Pengaduan Selesai Diproses</h2>
                <div class="list-group" max-width="30rem">
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">List group item heading</h5>
                            <small class="text-muted">3 days ago</small>
                        </div>
                        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                        <small class="text-muted">Donec id elit non mi porta.</small>
                    </a>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column mx-2 mb-3 w-25">
            <h2>Pengaduan Anda</h2>
            <div>
                <div class="list-group mb-3" max-width="20rem">
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                      <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">List group item heading</h5>
                        <small class="text-muted">3 days ago</small>
                      </div>
                      <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                      <small class="text-muted">Donec id elit non mi porta.</small>
                    </a>
                  </div>
                  <div class="list-group mb-3" max-width="20rem">
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                      <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">List group item heading</h5>
                        <small class="text-muted">3 days ago</small>
                      </div>
                      <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                      <small class="text-muted">Donec id elit non mi porta.</small>
                    </a>
                  </div>
                  <div class="list-group mb-3" max-width="20rem">
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                      <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">List group item heading</h5>
                        <small class="text-muted">3 days ago</small>
                      </div>
                      <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                      <small class="text-muted">Donec id elit non mi porta.</small>
                    </a>
                  </div>
            </div>
        </div>
    </div>

</div>
@endsection
