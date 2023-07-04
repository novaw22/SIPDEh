@extends('admin.layouts.app')
@section('title', "List User")
@section("search", route("admin.users.index"))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> User</h4>
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
					<h5 class="mb-0">List User</h5>
				</div>
				<div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="1" class="table" style="width: 100%;">
                        <thead class="table-light">
                        <tr>
                            <th class="text-center" >No</th>
                            <th class="text-center" >Email</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($users as $user)
                                <tr>
                                    <td class="text-center">{{ $loop->index + $users->firstItem() }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <a class="btn btn-primary" href="{{ route("admin.users.show", $user) }}">Detail</a>
                                        <a href="{{ route("admin.users.edit", $user) }}" class="btn btn-warning ms-2">Edit</a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger ms-2" type="submit">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada user yang ditemukan</td>
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
        {{ $users->links() }}
    </div>
</div>
@endsection
