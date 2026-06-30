@extends('layouts.admin')

@section('title', 'Tambah Menu')

@section('content')
<div class="card mb-4">
    <div class="card-header bg-white">
        <h6 class="m-0 font-weight-bold">Form Tambah Menu</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="tempat_kuliner_id" class="form-label">Tempat Kuliner</label>
                <select name="tempat_kuliner_id" id="tempat_kuliner_id" class="form-select @error('tempat_kuliner_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Tempat Kuliner --</option>
                    @foreach($tempatKuliners as $tempat)
                        <option value="{{ $tempat->id }}" {{ old('tempat_kuliner_id') == $tempat->id ? 'selected' : '' }}>
                            {{ $tempat->nama_tempat }}
                        </option>
                    @endforeach
                </select>
                @error('tempat_kuliner_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nama_menu" class="form-label">Nama Menu</label>
                <input type="text" class="form-control @error('nama_menu') is-invalid @enderror" id="nama_menu" name="nama_menu" value="{{ old('nama_menu') }}" required>
                @error('nama_menu')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga (Rp)</label>
                <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}" required min="0">
                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="gambar" class="form-label">Gambar Menu</label>
                <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*" required>
                @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
