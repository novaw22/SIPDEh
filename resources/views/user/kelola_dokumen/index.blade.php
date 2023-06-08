@extends('admin.layouts_dashboard.app') @section('content')
<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{$active}} /</span> {{$title}}</h4>
	<div class="row">
		<!-- Basic Layout -->
		<div class="col-xxl">
			<div class="card mb-4">
				<div class="card-header d-flex align-items-center justify-content-between">
					<h5 class="mb-0">List {{$title}}</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#backDropModal">
                        <span class="tf-icons bx bx-plus"></span>&nbsp; Ajukan Dokumen
                    </button>
                    <!-- Modal Layout -->
                    <div class="modal fade" id="backDropModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modelHeading">Silahkan pilih jenis dokumen yang ingin Anda ajukan.</h5>
                                    <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                    ></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <form action="/user/kelola-dokumen/create">
                                            <div class="d-grid gap-2 col-lg-8 mx-auto">
                                                <input type="text" name="jenis_dokumen" id="jenis_dokumen" value="Surat Keramaian" hidden>
                                                <button class="btn btn-outline-primary" type="submit">Surat Keramaian</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
				</div>
				<div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="{{$table_id}}" class="table" style="width: 100%;">
                        <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Dokumen</th>
                            <th>Alasan</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- / Content -->
@push('script')
<script type="text/javascript">
var table;
$(document).ready(function() {
    table = $('#{{$table_id}}').DataTable({

        "language": {
            "lengthMenu": "_MENU_",
            /* 'loadingRecords': '&nbsp;',
            'processing': '<img src="{{asset('assets/img/loader-sm.gif')}}"/>' */
        },
        processing:true,
        autoWidth: true,
        ordering: true,
        serverSide: true,
        ajax: {
            url: '{{url("user/ajaxKelola-dokumen")}}',
            type:"POST",
            data: function(params) {
                params._token = "{{ csrf_token() }}";
            }
        },

        language: {
            search: "",
            searchPlaceholder: "Type in to Search",
            lengthMenu: "<div class='d-flex justify-content-start form-control-select'> _MENU_ </div>",
            // info: "_START_ -_END_ of _TOTAL_",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_",
            infoEmpty: "No records found",
            infoFiltered: "( Total _MAX_  )",
            paginate: {
              "first": "First",
              "last": "Last",
              "next": "Next",
              "previous": "Prev"
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, class: 'text-left' },
            {
                data: 'nama_pengaju',
                name: 'nama_pengaju',
                orderable: true,
                searchable: true,
                class: 'text-left'
            },
            {
                data: 'dokumen',
                name: 'dokumen',
                orderable: false,
                searchable: true,
                class: 'text-center'
            },
            {
                data: 'alasan',
                name: 'alasan',
                orderable: false,
                searchable: true,
                class: 'text-center'
            },
            {
                data: 'status_dokumen',
                name: 'status_dokumen',
                orderable: false,
                searchable: true,
                class: 'text-center'
            },
            {
                data: 'action',
                name: 'id',
                orderable: false,
                searchable: false,
                class: 'text-center'
            }
        ]
    });

    $("#{{$table_id}}").DataTable().processing(true);
    $('#{{$table_id}}_filter input').unbind();
    $('#{{$table_id}}_filter input').bind('keyup', function(e) {
        if(e.keyCode == 13) {
            table.search(this.value).draw();
        }
    });
    $('.dataTables_filter').html('<div class="input-group flex-nowrap"><span class="input-group-text" id="addon-wrapping"><i class="bi bi-search"></i></span><input type="search" class="form-control form-control-sm" placeholder="Type in to Search" aria-label="Type in to Search" aria-describedby="addon-wrapping"></div>');
});

function deleteData(id){
    CustomSwal.fire({
        icon:'warning',
        text: 'Hapus Data ?',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                url:"{{url('/admin/kelola-dokumen')}}/"+id,
                data:{
                    _method:"DELETE",
                    _token:"{{csrf_token()}}"
                },
                type:"POST",
                dataType:"JSON",
                beforeSend:function(){
                    block("#{{$table_id}}");
                },
                success:function(data){
                    if(data.success == 1){
                        Swal.fire('Sukses', data.msg, 'success');
                    }else{
                        Swal.fire('Gagal', data.msg, 'error');
                    }
                    unblock("#{{$table_id}}");
                    RefreshTable('{{$table_id}}',0);
                },
                error:function(error){
                    Swal.fire('Gagal', 'terjadi kesalahan sistem', 'error');
                    console.log(error.XMLHttpRequest);
                    unblock("#{{$table_id}}");
                    RefreshTable('{{$table_id}}',0);
                }
            });
        }
    });
}
</script>
@endpush
@endsection
