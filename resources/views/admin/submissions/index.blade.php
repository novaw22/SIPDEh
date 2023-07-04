@extends('admin.layouts.app')
@section('title', "List Pengajuan")
@section("search", route("admin.submissions.index"))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Pengajuan</h4>
    <div class="row">
        <div class="col-xxl">
            @if (Session::has("success"))
                <div class="alert alert-primary" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::has("warning"))
                <div class="alert alert-warning" role="alert">
                    {{ Session::get('warning') }}
                </div>
            @endif
            @if (Session::has("error"))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
        </div>
    </div>
	<div class="row">
		<!-- Basic Layout -->
		<div class="col-xxl">
			<div class="card mb-4">
				<div class="card-header d-flex align-items-center justify-content-between">
					<h5 class="mb-0">List Pengajuan</h5>
                    <form class="w-25 d-flex align-items-center" action="{{ route('admin.submissions.index') }}" id="status-form">
                        <label for="form-label">Status</label>
                        <select name="status" id="status" class="form-control ms-2" id="status">
                            <option value="">semua</option>
                            @foreach (\App\Enums\SubmissionStatuses::cases() as $status)
                                @if ($status->value != \App\Enums\SubmissionStatuses::Cancelled->value)
                                    <option @selected($status->value === $queryStatus) value="{{ $status->value }}">{{ $status->value }}</option>
                                @endif
                            @endforeach
                        </select>
                    </form>
				</div>
				<div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="1" class="table" style="width: 100%;">
                        <thead class="table-light">
                        <tr>
                            <th class="text-center" >ID</th>
                            <th class="text-center" >Nama Pemohon</th>
                            <th class="text-center" >Jenis Dokumen</th>
                            <th class="text-center" >Diajukan Pada</th>
                            <th class="text-center" >Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($submissions as $submission)
                                <tr>
                                    <td class="text-center">#{{ $submission->id }}</td>
                                    <td class="text-center">{{ $submission->name }}</td>
                                    <td class="text-center">{{ $submission->jenis_document->name }}</td>
                                    <td class="text-center">{{ $submission->created_at->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <span class="rounded-3 px-2 py-1 text-white @if ($submission->status === \App\Enums\SubmissionStatuses::Pending->value || $submission->status === \App\Enums\SubmissionStatuses::Revised->value) bg-warning @endif @if ($submission->status === \App\Enums\SubmissionStatuses::Accepted->value) bg-success @endif @if ($submission->status === \App\Enums\SubmissionStatuses::Rejected->value || $submission->status === \App\Enums\SubmissionStatuses::Cancelled->value) bg-danger @endif">
                                            {{ $submission->status }}
                                        </span>
                                    </td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <a class="btn btn-primary" href="{{ route("admin.submissions.show", $submission) }}">Review</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada pengajuan yang ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
    <div class="d-flex justify-content-center">
        {{ $submissions->links() }}
    </div>
</div>
<script>
    const status = document.getElementById("status");
    const form = document.getElementById("status-form");

    status.onchange = () => {
        form.submit();
    }
</script>
@endsection
