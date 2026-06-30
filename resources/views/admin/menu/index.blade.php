@extends('layouts.admin')

@section('title', 'Data Menu')

@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center bg-white">
        <h6 class="m-0 font-weight-bold">Daftar Menu Tempat Kuliner</h6>
        <div>
            <a href="{{ route('admin.menu.create') }}" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-plus"></i> Tambah Menu
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTableMenu" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Gambar</th>
                        <th>Nama Menu</th>
                        <th>Tempat Kuliner</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($item->gambar)
                                <img src="{{ str_starts_with($item->gambar, 'http') ? $item->gambar : Storage::url($item->gambar) }}" alt="{{ $item->nama_menu }}" width="50" class="img-thumbnail">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $item->nama_menu }}</td>
                        <td>{{ $item->tempatKuliner->nama_tempat ?? '-' }}</td>
                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>
                            <a href="{{ route('admin.menu.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTableMenu').DataTable();
    });
</script>
@endpush
