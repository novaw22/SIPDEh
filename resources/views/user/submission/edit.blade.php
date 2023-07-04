@extends('user.layouts.app')
@section('title', "Detail Pengajuan")
@section('content')
<!-- Modal -->
<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span><span class="text-muted fw-light">Pengajuan /</span> Detail</h4>
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
					<h5 class="mb-0">Detail Pengajuan</h5>
					<a href="{{ route('user.submission.index') }}" class="btn btn-danger">
					    Kembali
                    </a>
				</div>
				<div class="card-body">
                    <form action="{{ route('user.submission.update', $submission) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PATCH")
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
                            <a target="_blank" class="d-block" href="{{ route('assets.submission.file', $submission) }}">Lihat dokumen</a>
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Nama Pemohon</label>
                            <input
                              type="text"
                              class="form-control @error('name') is-invalid @enderror"
                              id="fullname"
                              name="name"
                              value="{{ old("name",$submission->name) }}"
                              placeholder="Masukan nama pemohon"
                            />
                        </div>
                        <div class="mb-4">
                            <label for="description" class="form-label">Perihal</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                            name="description" rows="5" placeholder="Masukan alasan pengajuan anda">{{ old("description", $submission->description) }}</textarea>
                        </div>
                        @if(!$details->isEmpty())
                            <h2 class="form-label fw-bold">*Detail Pengajuan</h2>
                            <hr>
                            @foreach ($details as $detail)
                                <div class="mb-4">
                                    <label class="form-label">{{ $detail->special_term->name }}</label>
                                    @if ($detail->special_term->type === 'image' || $detail->special_term->type === 'pdf')
                                        @if ($detail->special_term->type === 'image')
                                            <input type="file" accept="image/jpeg,image/png,application/pdf,image/jpg" name="{{$detail->id}}" class="form-control">
                                        @else
                                            <input type="file" accept="application/pdf" name="{{$detail->id}}" class="form-control">
                                        @endif
                                        <a target="_blank" class="d-block" href="{{ route('assets.submission.detail', ['submissionDetail' => $detail]) }}">Lihat Dokumen</a>
                                    @else
                                        <input type="text" class="form-control" name="{{$detail->id}}" value="{{$detail->content}}">
                                    @endif
                                </div>
                            @endforeach
                        @endif
                        <div class="mt-5 d-flex justify-content-center align-items-center">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
