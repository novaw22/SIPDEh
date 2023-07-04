@extends('user.layouts.app')
@section('title', "Pengajuan Baru")
@section('content')
<!-- Modal -->
<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span><span class="text-muted fw-light">Pengajuan /</span> Baru</h4>
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
					<h5 class="mb-0">Pengajuan Dokumen {{ $type->name }}</h5>
					<a href="{{ route('user.submission.index') }}" class="btn btn-danger">
					    Kembali
                    </a>
				</div>
				<div class="card-body">
                    <form action="{{ route('user.submission.store', $type) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">File yang telah Discan</label>
                            <input
                              type="file"
                              class="form-control @error('file') is-invalid @enderror"
                              id="file"
                              name="file"
                              accept="application/pdf"
                              placeholder="Masukan softcopy dari file yang diajukan"
                            />
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Nama Pemohon</label>
                            <input
                              type="text"
                              class="form-control @error('name') is-invalid @enderror"
                              id="fullname"
                              name="name"
                              value="{{ old('name', Auth::user()->profile->fullname) }}"
                              placeholder="Masukan nama pemohon"
                            />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="description" class="form-label">Perihal</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                            name="description" rows="5" placeholder="Masukan alasan pengajuan anda">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @if(!$special_terms->isEmpty())
                            <h2 class="form-label fw-bold">*Persyaratan Khusus</h2>
                            <hr>
                            @foreach ($special_terms as $term)
                                <div class="mb-4">
                                    <label for="{{ $term->id }}" class="form-label">{{ $term->name }}</label>
                                    <input
                                        @if($term->type === 'image' || $term->type === 'pdf')
                                            type="file"
                                            @if ($term->type === 'image')
                                                accept="image/jpeg,image/png,application/pdf,image/jpg"
                                            @endif
                                            @if ($term->type === 'pdf')
                                                accept="application/pdf"
                                            @endif
                                        @else
                                            type="text"
                                        @endif
                                        class="form-control @error($term->id) is-invalid @enderror"
                                        id="{{ $term->id }}"
                                        name="{{ $term->id }}"
                                        value="{{ old($term->id) }}"
                                        placeholder="Masukan {{ $term->name }}"
                                    />
                                    @error($term->id)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        @endif
                        <div class="mt-5 d-flex justify-content-center align-items-center">
                            <button class="btn btn-primary">Ajukan</button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
