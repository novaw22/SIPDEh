@extends('admin.layouts.app')
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
				<div class="card-header d-flex align-items-center justify-content-between mb-3">
					<h5 class="mb-0">Detail Pengajuan#{{ $submission->id }}</h5>
					<a href="{{ route('admin.submissions.index') }}" class="btn btn-danger">
					    Kembali
                    </a>
				</div>
				<div class="card-body">
                    <form action="{{ route('admin.submissions.update', $submission) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <h2 class="form-label fw-bold text-primary">*Status Pengajuan</h2>
                        <hr>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" @disabled($submission->status === \App\Enums\SubmissionStatuses::Cancelled->value)>
                                @foreach (\App\Enums\SubmissionStatuses::cases() as $status)
                                    @if ($status->value != \App\Enums\SubmissionStatuses::Cancelled->value)
                                        <option @selected($status->value === $submission->status) value="{{ $status->value }}">{{ $status->value }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pick_up_date" class="form-label">Tanggal Ambil</label>
                            <input
                              type="date"
                              class="form-control"
                              id="pick_up_date"
                              name="pick_up_date"
                              value="{{ old('pick_up_date',$submission->pick_up_date )}}"
                            />
                            @error('pick_up_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror     
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Catatan dari Kaling</label>
                            <textarea name="admin_note" placeholder="Catatan dari admin mengenai pengajuan" class="form-control" id="description"rows="5">{{ old('admin_note',$submission->admin_note) }}</textarea>
                            @error('admin_note')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="soft_copy" class="form-label">Dokumen Digital</label>
                            <input type="file" accept="application/pdf" name="soft_copy" class="form-control" id="soft-copy" placeholder="Upload pdf dari pengajuan">
                            @empty($submission->soft_copy)
                                <small class="d-block text-warning">Dokumen digital belum diupload</small>
                            @else
                                <a target="_blank" class="d-block" href="{{ route('assets.submission.softCopy', $submission) }}">Lihat dokumen digital</a>
                            @endempty
                            @error('soft_copy')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                        @if(!$submission->details->isEmpty())
                            <h2 class="form-label fw-bold text-primary">*Detail Pengajuan</h2>
                            <hr>
                            @foreach ($submission->details as $detail)
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
