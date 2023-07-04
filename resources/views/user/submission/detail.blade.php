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
                    <form>
                        <h2 class="form-label fw-bold text-primary">*Status</h2>
                        <hr>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Status</label>
                            <input
                              type="text"
                              class="form-control @error('name') is-invalid @enderror"
                              id="fullname"
                              name="name"
                              value="{{ $submission->status }}"
                              disabled
                            />
                        </div>
                        @if (!$submission->is_softcopy)
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Tanggal Ambil</label>
                                @empty($submission->pick_up_date)
                                    <small class="d-block fw-bold">Belum ada tanggal pengambilan !</small>
                                @else
                                    <input
                                    type="date"
                                    class="form-control"
                                    id="fullname"
                                    value="{{ $submission->pick_up_date }}"
                                    disabled
                                />
                                @endempty
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="description" class="form-label">Catatan dari Kaling</label>
                            <textarea disabled class="form-control" id="description"rows="5">@empty($submission->admin_note){{ "Tidak ada catatan dari kaling" }}@else{{ $submission->admin_note }}@endempty</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="soft_copy" class="form-label">Dokumen Digital</label>
                            @empty($submission->soft_copy)
                                <small class="d-block text-warning">Dokumen digital belum diupload</small>
                            @else
                                <a target="_blank" class="d-block" href="{{ route('assets.submission.softCopy', $submission) }}">Download dokumen digital</a>
                            @endempty
                        </div>
                        <h2 class="form-label fw-bold text-primary">*Pengajuan</h2>
                        <hr>
                        <div class="mb-3">
                            <label for="file" class="form-label">File yang telah Discan</label>
                            <a target="_blank" class="d-block" href="{{ route('assets.submission.file', $submission) }}">Lihat dokumen</a>
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Nama Pemohon</label>
                            <input
                              type="text"
                              class="form-control @error('name') is-invalid @enderror"
                              id="fullname"
                              name="name"
                              value="{{ $submission->name }}"
                              disabled
                              placeholder="Masukan nama pemohon"
                            />
                        </div>
                        <div class="mb-4">
                            <label for="description" class="form-label">Perihal</label>
                            <textarea disabled class="form-control @error('description') is-invalid @enderror" id="description"
                            name="description" rows="5" placeholder="Masukan alasan pengajuan anda">{{ $submission->description }}</textarea>
                        </div>
                        @if(!$details->isEmpty())
                            <h2 class="form-label fw-bold text-primary">*Detail Pengajuan</h2>
                            <hr>
                            @foreach ($details as $detail)
                                <div class="mb-4">
                                    <label class="form-label">{{ $detail->special_term->name }}</label>
                                    @if ($detail->special_term->type === 'image' || $detail->special_term->type === 'pdf')
                                        <a target="_blank" class="d-block" href="{{ route('assets.submission.detail', ['submissionDetail' => $detail]) }}">Lihat Dokumen</a>
                                    @else
                                        <input type="text" class="form-control" value="{{$detail->content}}" disabled>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
