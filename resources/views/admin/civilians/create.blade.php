@extends('admin.layouts.app')
@section('title', "Buat Penduduk Baru")
@section("search", route("admin.civilians.index"))
@section('content')
<!-- Modal -->
<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span><span class="text-muted fw-light">Penduduk /</span> Baru</h4>
	@if (Session::has("success"))
        <div class="alert alert-primary" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::has("error"))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="row">
		<!-- Basic Layout -->
		<div class="col-xxl">
			<div class="card mb-4">
				<div class="card-header d-flex align-items-center justify-content-between">
					<h5 class="mb-0">Buat Penduduk</h5>
					<a href="{{ route('admin.civilians.index') }}" class="btn btn-danger">
					    Kembali
                    </a>
				</div>
				<div class="card-body">
                    <form action="{{ route('admin.civilians.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Nama Lengkap</label>
                            <input
                              type="text"
                              class="form-control @error('fullname') is-invalid @enderror"
                              id="fullname"
                              name="fullname"
                              value="{{ old('fullname') }}"
                              placeholder="Masukan nama lengkap"
                              required
                            />
                            @error('fullname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input
                              type="text"
                              class="form-control @error('nik') is-invalid @enderror"
                              id="nik"
                              name="nik"
                              value="{{ old('nik') }}"
                              placeholder="Masukan NIK"
                              required
                            />
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="place_of_birth" class="form-label">Tempat Lahir</label>
                            <input
                              type="text"
                              class="form-control @error('place_of_birth') is-invalid @enderror"
                              id="place_of_birth"
                              name="place_of_birth"
                              value="{{ old('place_of_birth') }}"
                              placeholder="Masukan tempat lahir"
                              required
                            />
                            @error('place_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                            <input
                              type="date"
                              class="form-control @error('date_of_birth') is-invalid @enderror"
                              id="date_of_birth"
                              name="date_of_birth"
                              value="{{ old('date_of_birth') }}"
                              placeholder="Masukan tanggal lahir"
                              required
                            />
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="address" class="form-label">Alamat Lengkap</label>
                            <textarea required class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" rows="5" placeholder="Masukan alamat lengkap">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-5 d-flex justify-content-center align-items-center">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
