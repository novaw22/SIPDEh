@extends('admin.layouts.app')
@section('title', "Detail User")
@section("search", route("admin.users.index"))
@section('content')
<!-- Modal -->
<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span><span class="text-muted fw-light">User /</span> Detail</h4>
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
					<h5 class="mb-0">Detail Jenis Dokumen</h5>
					<a href="{{ route('admin.users.index') }}" class="btn btn-danger">
					    Kembali
                    </a>
				</div>
				<div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Email</label>
                            <input
                              type="text"
                              class="form-control @error('name') is-invalid @enderror"
                              id="fullname"
                              name="email"
                              value="{{ $user->email }}"
                              disabled
                            />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Nama Lengkap</label>
                            <input
                              type="text"
                              class="form-control @error('name') is-invalid @enderror"
                              id="fullname"
                              name="fullname"
                              value="{{ $user->profile->fullname }}"
                              disabled
                            />
                            @error('fullname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">NIK</label>
                            <input
                              type="text"
                              class="form-control @error('name') is-invalid @enderror"
                              id="fullname"
                              name="nik"
                              value="{{ $user->profile->nik }}"
                              disabled
                            />
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Tempat Lahir</label>
                            <input
                              type="text"
                              class="form-control @error('name') is-invalid @enderror"
                              id="fullname"
                              name="nik"
                              value="{{ $user->profile->place_of_birth ?? "-" }}"
                              disabled
                            />
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Tanggal Lahir</label>
                            <input
                              type="date"
                              class="form-control @error('name') is-invalid @enderror"
                              id="fullname"
                              name="nik"
                              value="{{ $user->profile->date_of_birth }}"
                              disabled
                            />
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">No. Telp</label>
                            <input
                              type="text"
                              class="form-control @error('name') is-invalid @enderror"
                              id="fullname"
                              name="nik"
                              value="{{ $user->profile->phone }}"
                              disabled
                            />
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="description" class="form-label">Alamat</label>
                            <textarea disabled class="form-control @error('description') is-invalid @enderror" id="description"
                            name="description" rows="5" placeholder="Deskripsi jenis dokumen">{{ $user->profile->address }}</textarea>
                            @error('description')
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
