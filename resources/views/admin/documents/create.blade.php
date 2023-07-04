@extends('admin.layouts.app')
@section('title', "Buat Jenis Dokumen Baru")
@section("search", route("admin.documents.index"))
@section('content')
<!-- Modal -->
<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span><span class="text-muted fw-light">Jenis Dokumen /</span> Baru</h4>
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
					<h5 class="mb-0">Buat Jenis Dokumen</h5>
					<a href="{{ route('admin.documents.index') }}" class="btn btn-danger">
					    Kembali
                    </a>
				</div>
				<div class="card-body">
                    <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Nama Jenis Dokumen</label>
                            <input
                              type="text"
                              class="form-control @error('name') is-invalid @enderror"
                              id="fullname"
                              name="name"
                              value="{{ old('name') }}"
                              placeholder="Masukan nama jenis dokumen"
                            />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Jenis Dokumen</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                            name="description" rows="5" placeholder="Deskripsi jenis dokumen">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="template" class="form-label">Template Dokumen</label>
                            <input
                              type="file"
                              class="form-control @error('template') is-invalid @enderror"
                              id="template"
                              name="template"
                              value="{{ old('template') }}"
                              accept="application/msword"
                              placeholder="Masukan template dokumen"
                            />
                            @error('template')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label for="description" class="form-label d-block">User yang dapat mengajukan</label>
                        @foreach ($userStatuses as $userStatus)
                            <div class="form-check form-check-inline mb-4">
                                <input @checked($loop->index === 0) @if($loop->index === 0) onclick="return false;" @endif class="form-check-input" type="checkbox" name="{{ $userStatus->value }}" value="1" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $userStatus->name }}
                                </label>
                            </div>
                        @endforeach
                        <h2 class="form-label fw-bold">*Persyaratan Khusus</h2>
                        <hr>
                        <div id="special-term-container" class="container p-0">
                        </div>
                        <button type="button" id="add-special-term-btn" class="btn btn-outline-primary w-100">Tambah Persyaratan Khusus</button>
                        <div class="mt-5 d-flex justify-content-center align-items-center">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    const addBtn = document.getElementById("add-special-term-btn");
    const addContainer = document.getElementById("special-term-container");
    let index = 0;    
    addBtn.onclick = () => {
        const div = document.createElement('div');
        div.className = 'w-100 rounded-2 mb-3';
        div.innerHTML = `
            <div class="d-flex ">
                <div class="me-3 w-50">
                    <label for="description" class="form-label">Nama Syarat</label>
                    <input type="text" class="form-control d-inline mx-1" placeholder="Nama Syarat" name="specialTermName${index}" />
                </div>
                <div class="w-50">
                    <label for="description" class="form-label">Jenis Syarat</label>
                    <select class="form-control" name="specialTermType${index}">
                        @foreach ($specialTermTypes as $specialTermType )
                            <option value="{{ $specialTermType->value }}">{{ $specialTermType->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        `;
        addContainer.append(div);
        index++;
    }
</script>
@endsection
