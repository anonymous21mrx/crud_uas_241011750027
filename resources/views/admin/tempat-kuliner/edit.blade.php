@extends('layouts.admin')

@section('title', 'Edit Tempat Kuliner')

@section('content')
<div class="card mb-4">
    <div class="card-header bg-white">
        <h6 class="m-0 font-weight-bold">Form Edit Data</h6>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.tempat-kuliner.update', $tempatKuliner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_tempat" class="form-label">Nama Tempat Kuliner <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_tempat" name="nama_tempat" value="{{ old('nama_tempat', $tempatKuliner->nama_tempat) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar (Biarkan kosong jika tidak ingin mengubah)</label>
                @if($tempatKuliner->gambar)
                    <div class="mb-2">
                        <img src="{{ Storage::url($tempatKuliner->gambar) }}" alt="Preview" class="img-thumbnail" width="150">
                    </div>
                @endif
                <input class="form-control" type="file" id="gambar" name="gambar" accept="image/*">
            </div>
            
            <div class="mb-3">
                <label for="jenis_makanan" class="form-label">Jenis Makanan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="jenis_makanan" name="jenis_makanan" value="{{ old('jenis_makanan', $tempatKuliner->jenis_makanan) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="jam_operasional" class="form-label">Jam Operasional <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="jam_operasional" name="jam_operasional" placeholder="Contoh: 08:00 - 22:00" value="{{ old('jam_operasional', $tempatKuliner->jam_operasional) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $tempatKuliner->alamat) }}</textarea>
            </div>
            
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Update Data</button>
            <a href="{{ route('admin.tempat-kuliner.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
        </form>
    </div>
</div>
@endsection
