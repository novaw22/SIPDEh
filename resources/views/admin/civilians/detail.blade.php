@extends('admin.layouts.app')
@section('title', "Detail Penduduk")
@section("search", route("admin.civilians.index"))
@section('content')
<!-- Modal -->
<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span><span class="text-muted fw-light">Penduduk /</span> Detail</h4>
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
                    <form>
                        @csrf
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Nama Lengkap</label>
                            <input
                              type="text"
                              class="form-control @error('fullname') is-invalid @enderror"
                              id="fullname"
                              name="fullname"
                              value="{{ $civilian->fullname }}"
                              placeholder="Masukan nama lengkap"
                              disabled
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
                              value="{{ $civilian->nik }}"
                              placeholder="Masukan NIK"
                              disabled
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
                              value="{{ $civilian->place_of_birth }}"
                              placeholder="Masukan tempat lahir"
                              disabled
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
                              value="{{ $civilian->date_of_birth }}"
                              placeholder="Masukan tanggal lahir"
                              disabled
                            />
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="address" class="form-label">Alamat Lengkap</label>
                            <textarea disabled required class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" rows="5" placeholder="Masukan alamat lengkap">{{ $civilian->address }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
