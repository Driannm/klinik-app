@extends('app', ['title' => 'Data Pendaftaran Pasien'])

@section('search')
<form method="GET" action="{{ route('daftar.index') }}">
    <div class="d-flex justify-content-center mt-3">
        <div class="search">
            <input type="text" name="query" class="form-control border-1 shadow-none ps-1 ps-sm-2"
            placeholder="Search..." aria-label="Search..." value="{{ request('query') }}" autocomplete="off"/>
        </div>
    </div>
</form>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">DATA PENDAFTARAN PASIEN</h5>
                <a href="/daftar/create" class="btn btn-sm btn-primary">Tambah Pendaftaran</a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ session('success') }}
                        <button type="button" id="session-close-btn" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                @include('flash::message')
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Daftar</th>
                                <th>Poli</th>
                                <th>Keluhan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($daftar as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->pasien->nama }}</td>
                                    <td>{{ ucfirst($item->pasien->jenis_kelamin) }}</td>
                                    <td>{{ $item->tanggal_daftar }}</td>
                                    <td>{{ $item->poli->nama }}</td>
                                    <td>{{ $item->keluhan }}</td>
                                    <td>
                                        <a href="/daftar/{{ $item->id }}" class="btn btn-sm btn-info mt-1">Detail</a>
                                        <form action="/daftar/{{ $item->id }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger mt-1"
                                                onclick="return confirm('Yakin ingin hapus data?')"> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">Tidak Ada Data Pendaftaran Pasien</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $daftar->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection