@extends('admin.layouts.app')
@section('title', "Edit User")
@section("search", route("admin.users.index"))
@section('content')
<!-- Modal -->
<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span><span class="text-muted fw-light">User /</span> Edit</h4>
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
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PATCH')
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
                            <label for="password" class="form-label">Password Baru</label>
                            <input
                              type="password"
                              class="form-control @error('password') is-invalid @enderror"
                              id="password"
                              name="password"
                            />
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Nama Lengkap</label>
                            <input
                              type="text"
                              class="form-control @error('fullname') is-invalid @enderror"
                              id="fullname"
                              name="fullname"
                              placeholder="Nama Lengkap"
                              value="{{ old("fullname",$user->profile->fullname) }}"
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
                              placeholder="NIK"
                              value="{{ old("nik",$user->profile->nik) }}"
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
                              placeholder="Tempat lahir"
                              value="{{ old('place_of_birth',$user->profile->place_of_birth) }}"
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
                              placeholder="Tanggal lahir"
                              value="{{ $user->profile->date_of_birth }}"
                            />
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">No. Telp</label>
                            <input
                              type="text"
                              class="form-control @error('phone') is-invalid @enderror"
                              id="phone"
                              name="phone"
                              placeholder="No telepon"
                              value="{{ old('phone', $user->profile->phone) }}"
                            />
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" rows="5" placeholder="Alamat lengkap">{{ old('address',$user->profile->address) }}</textarea>
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
