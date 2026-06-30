@extends('layouts.admin')

@section('title', 'Data Tempat Kuliner')

@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center bg-white">
        <h6 class="m-0 font-weight-bold">Daftar Tempat Kuliner</h6>
        <div>
            <a href="{{ route('admin.tempat-kuliner.create') }}" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-plus"></i> Tambah Data
            </a>
            <a href="{{ route('admin.tempat-kuliner.export-pdf') }}" class="btn btn-danger btn-sm">
                <i class="fa-solid fa-file-pdf"></i> Export PDF
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Gambar</th>
                        <th>Nama Tempat</th>
                        <th>Alamat</th>
                        <th>Jenis Makanan</th>
                        <th>Jam Operasional</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($item->gambar)
                                <img src="{{ (str_starts_with($item->gambar, 'http') || str_starts_with($item->gambar, 'data:image')) ? $item->gambar : Storage::url($item->gambar) }}" alt="{{ $item->nama_tempat }}" width="80" class="img-thumbnail">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $item->nama_tempat }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->jenis_makanan }}</td>
                        <td>{{ $item->jam_operasional }}</td>
                        <td>
                            <a href="{{ route('admin.tempat-kuliner.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.tempat-kuliner.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
        $('#dataTable').DataTable();
    });
</script>
@endpush
