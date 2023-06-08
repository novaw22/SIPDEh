@extends('admin.layouts_dashboard.app') 
@section('content') 
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
	<div class="row">
	  <div class="col-lg-8 mb-4 order-0">
		<div class="card">
			<div class="row row-bordered g-0">
			  <div class="col-md-8">
				<h5 class="card-header m-0 me-2 pb-3">Total Pengajuan</h5>
				<div id="totalRevenueChart" class="px-2"></div>
			  </div>
			  <div class="col-md-4">
				<div class="card-body">
				  <div class="text-center">
					<div class="dropdown">
					  <button
						class="btn btn-sm btn-outline-primary dropdown-toggle"
						type="button"
						id="growthReportId"
						data-bs-toggle="dropdown"
						aria-haspopup="true"
						aria-expanded="false"
					  >
						2022
					  </button>
					  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
						<a class="dropdown-item" href="javascript:void(0);">2021</a>
						<a class="dropdown-item" href="javascript:void(0);">2020</a>
						<a class="dropdown-item" href="javascript:void(0);">2019</a>
					  </div>
					</div>
				  </div>
				</div>
				<div id="growthChart"></div>
				<div class="text-center fw-semibold pt-3 mb-2">62% Company Growth</div>
  
				<div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
				  <div class="d-flex">
					<div class="me-2">
					  <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
					</div>
					<div class="d-flex flex-column">
					  <small>2022</small>
					  <h6 class="mb-0">$32.5k</h6>
					</div>
				  </div>
				  <div class="d-flex">
					<div class="me-2">
					  <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
					</div>
					<div class="d-flex flex-column">
					  <small>2021</small>
					  <h6 class="mb-0">$41.2k</h6>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
	  </div>
	  <div class="col-lg-4 col-md-4 order-1">
		<div class="row">
		  <div class="col-lg-6 col-md-12 col-6 mb-4">
			<div class="card">
			  <div class="card-body">
				<div class="card-title d-flex align-items-start justify-content-between">
				  <div class="avatar flex-shrink-0">
					<img
					  src="{{ asset('admin/assets/img/icons/unicons/chart-success.png') }}"
					  alt="chart success"
					  class="rounded"
					/>
				  </div>
				</div>
				<span class="fw-semibold d-block mb-1">Penduduk</span>
				<h3 class="card-title mb-2">{{$penduduk_count}}</h3>
			  </div>
			</div>
		  </div>
		  <div class="col-lg-6 col-md-12 col-6 mb-4">
			<div class="card">
			  <div class="card-body">
				<div class="card-title d-flex align-items-start justify-content-between">
				  <div class="avatar flex-shrink-0">
					<img
					  src="{{ asset('admin/assets/img/icons/unicons/wallet-info.png') }}"
					  alt="Credit Card"
					  class="rounded"
					/>
				  </div>
				</div>
				<span class="fw-semibold d-block mb-1">Jenis Dokumen</span>
				<h3 class="card-title text-nowrap mb-1">{{$jenis_dokumen_count}}</h3>
			  </div>
			</div>
		  </div>
		  <div class="col-lg-6 col-md-12 col-6 mb-4">
			<div class="card">
			  <div class="card-body">
				<div class="card-title d-flex align-items-start justify-content-between">
				  <div class="avatar flex-shrink-0">
					<img src="{{ asset('admin/assets/img/icons/unicons/paypal.png') }}" alt="Credit Card" class="rounded" />
				  </div>
				</div>
				<span class="fw-semibold d-block mb-1">Syarat Pengajuan</span>
				<h3 class="card-title text-nowrap mb-2">{{$syarat_pengajuan_count}}</h3>
			  </div>
			</div>
		  </div>
		  <div class="col-lg-6 col-md-12 col-6 mb-4">
			<div class="card">
			  <div class="card-body">
				<div class="card-title d-flex align-items-start justify-content-between">
				  <div class="avatar flex-shrink-0">
					<img src="{{ asset('admin/assets/img/icons/unicons/cc-primary.png') }}" alt="Credit Card" class="rounded" />
				  </div>
				</div>
				<span class="fw-semibold d-block mb-1">Pengajuan Dokumen</span>
				<h3 class="card-title mb-2">{{$pengajuan_dokumen_count}}</h3>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
  </div>
  <!-- / Content -->
@endsection