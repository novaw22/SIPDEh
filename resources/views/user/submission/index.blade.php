@extends('user.layouts.app')
@section('title', "Histori Pengajuan")
@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pilih Tipe Dokumen</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="w-100" style="max-height: 400px; overflow:auto;">
            @forelse ($types as $type)
                <a href="{{ route('user.submission.create',["type" => $type->id]) }}" class="btn btn-outline-primary w-100 mb-2">Dokumen {{ $type->name }}</a>
            @empty
                <a href="#" class="btn btn-outline-primary w-100 mb-2">Tidak ada dokumen yang bisa diajukan !</a>
            @endforelse
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
</div>
<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Pengajuan</h4>
	<div class="row">
		<!-- Basic Layout -->
		<div class="col-xxl">
			<div class="card mb-4">
				<div class="card-header d-flex align-items-center justify-content-between">
					<h5 class="mb-0">Histori Pengajuan</h5>
					<button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">
					    <span class="tf-icons bx bx-plus"></span>&nbsp; Ajukan
                    </button>
				</div>
				<div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="1" class="table" style="width: 100%;">
                        <thead class="table-light">
                        <tr>
                            <th class="text-center" >No</th>
                            <th class="text-center" >Dokumen</th>
                            <th class="text-center" >Note</th>
                            <th class="text-center" >Tanggal Ambil</th>
                            <th class="text-center" >Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($submissions as $submission)
                                <tr>
                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                    <td class="text-center">{{ $submission->jenis_document->name }}</td>
                                    <td class="text-center">
                                        @empty($submission->admin_note)
                                        {{ "-" }}
                                        @else
                                        {{ \Illuminate\Support\Str::limit($submission->admin_note, 20, $end='...') }}
                                        @endempty
                                    </td>
                                    <td class="text-center">
                                        @empty($submission->pick_up_date)
                                            {{ "-" }}
                                        @else
                                            {{ date('d-m-Y', strtotime($submission->pick_up_date)) }}
                                        @endempty
                                    </td>
                                    <td class="text-center">
                                        <span class="rounded-3 px-2 py-1 text-white @if ($submission->status === "pending" || $submission->status === "need_tobe_revised") bg-warning @endif @if ($submission->status === "accepted") bg-success @endif @if ($submission->status === "rejected"||$submission->status === "cancelled") bg-danger @endif">
                                            @if ($submission->status === "pending")
                                                {{ "Diajukan" }}
                                            @endif
                                            @if ($submission->status === "accepted")
                                                {{ "Disetujui" }}
                                            @endif
                                            @if ($submission->status === "need_tobe_revised")
                                                {{ "Perlu Direvisi" }}
                                            @endif
                                            @if ($submission->status === "rejected")
                                                {{ "Ditolak" }}
                                            @endif
                                            @if ($submission->status === "cancelled")
                                                {{ "Dibatalkan" }}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <a class="btn btn-primary" href="{{ route("user.submission.detail", $submission) }}">Detail</a>
                                        @if ($submission->status === "pending" || $submission->status === "rejected" || $submission->status === "need_tobe_revised")
                                            <a href="{{ route("user.submission.edit", $submission) }}" class="btn btn-warning ms-2">Edit</a>
                                        @endif
                                        @if ($submission->status != "accepted" && $submission->status != "cancelled")
                                            <form action="{{ route('user.submission.cancel', $submission) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button class="btn btn-danger ms-2" type="submit">Batalkan</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada dokumen yang diajukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
