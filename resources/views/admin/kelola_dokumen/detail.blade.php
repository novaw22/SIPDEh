@extends('admin.layouts_dashboard.app') 
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{$active}}/</span> {{$title}}</h4>
	<!-- Basic Layout & Basic with Icons -->
	<div class="row">
		<!-- Basic Layout -->
		<div class="col-xxl">
			<div class="card mb-4">
				<div class="card-header d-flex align-items-center justify-content-between">
					<h5 class="mb-0">Detail {{$title}}</h5>
					<small class="text-muted float-end">------</small>
				</div>
				<hr class="my-0"/>
				<div class="card-body">
					<form action="/admin/museum" method="post" enctype="multipart/form-data">
						 @csrf
						<div class="row mb-3">
							<label class="col-sm-2 col-form-label" for="basic-default-name">Nama Pengaju</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="nama_pengaju" name="nama_pengaju" value="{{$data->nama_pengaju}}" disabled/>
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-sm-2 col-form-label" for="basic-default-name">Dokumen</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="dokumen" name="dokumen" value="{{$data->dokumen}}" disabled/>
							</div>
						</div>
						<div class="row mb-3">
							<label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Status</label>
							<div class="col-sm-10">
								<select class="form-select" id="status" name="status" aria-label="Default select example">
									<option selected>Pilih status dokumen</option>
									<option value="belum disetujui">Belum Disetujui</option>
									<option value="disetujui">Disetujui</option>
									<option value="ditolak">Ditolak</option>
								  </select>
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-sm-2 col-form-label" for="basic-default-message">Alasan</label>
							<div class="col-sm-10">
								<textarea id="alasan" name="alasan" class="form-control" aria-describedby="basic-icon-default-message2" disabled>{{$data->alasan}}</textarea>
							</div>
						</div>
						<div class="row justify-content-end">
							<div class="col-sm-10">
								<button type="submit" class="btn btn-primary">Save</button>
								<a href="/admin/museum" class="btn btn-outline-secondary">Cancel</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- / Content -->
<script>
    document.addEventListener('DOMContentLoaded', function (e) {
        (function () {
            const deactivateAcc = document.querySelector('#formAccountDeactivation');
            // Update/reset user image of account page
            let accountUserImage = document.getElementById('uploadedAvatar');
            const fileInput = document.querySelector('.account-file-input'),
            resetFileInput = document.querySelector('.account-image-reset');
            if (accountUserImage) {
            const resetImage = accountUserImage.src;
            fileInput.onchange = () => {
                if (fileInput.files[0]) {
                accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
                }
            };
            resetFileInput.onclick = () => {
                fileInput.value = '';
                accountUserImage.src = resetImage;
            };
            }
        })();
    });
    var peta = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

    var map = L.map('map', {
        center: [-8.537304773847266, 115.12583771558118],
        zoom: 10,
        layers: [peta]
    });

	var curLocation = [-8.519690764779996, 115.12325785399827];
	map.attributionControl.setPrefix(false);

	var micon = L.icon({
	  iconUrl: "/admin/assets/img/avatars/museum.png",
	  iconSize: [34, 34], // size of the icon
	  popupAnchor: [0, -30], // point from which the popup should open relative to the iconAnchor
	});

	var marker = new L.marker(curLocation, {
        draggable: 'true',
		icon: micon,
    });

    map.addLayer(marker);

    marker.on('dragend', function(event) {
        var location = marker.getLatLng();
        marker.setLatLng(location, {
            draggable: 'true',
        }).bindPopup(location).update();
        $('#lat').val(location.lat).keyup()
		$('#long').val(location.lng).keyup()
    });

    var latitude = document.querySelector("[name=lat]");
	var longtitude = document.querySelector("[name=long]");
    map.on("click", function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        if (!marker) {
            marker = L.marker(e.latlng).addTo(map);
        } else {
            marker.setLatLng(e.latlng);
        }
		latitude.value = lat;
        longtitude.value = lng;
    });
</script>
@endsection