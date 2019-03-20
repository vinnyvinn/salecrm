@extends('layouts.app')
@section('content')
	<div class="page-header">
		<div class="page-block">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="page-header-title">
						<h4 class="m-b-10">Companies</h4>
					</div>
					<ul class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ url('/') }}">
								<i class="feather icon-home"></i>
							</a>
						</li>
						<li class="breadcrumb-item"><a href="{{route('companies.index')}}">Companies</a></li>
						<li class="breadcrumb-item">All Companies</li>
					</ul>
			</div>
		</div>
	</div>
	</div>
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h5>All Companies</h5>
								<a href="{{ route('companies.create') }}" class="btn btn-sm btn-primary float-right">Add Company</a>
							</div>
							<div class="card-block">
								@if (count($companies) > 0)
									<table class="table table-sm" id="datatable">
										<thead>
											<tr>
												<th>#</th>
												<th>Name</th>
												<th>Email</th>
												<th>Phone</th>
												<th>Prospects</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($companies as $key => $company)
												<tr>
													<td>{{ $key + 1 }}</td>
													<td>{{ $company->name }}</td>
													<td>{{ $company->email }}</td>
													<td>{{ $company->phone }}</td>
													<td>{{ number_format(count($company->prospects)) }}</td>
													<td>
														<a href="{{route('companies.show',$company->id)}}" class="btn btn-primary btn-xs">View</a>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								@else
									<div class="alert text-center alert-secondary">
										<img src="{{ asset('images/empty.svg') }}">
										<h4 class="text-uppercase">no records found</h4>
									</div>
								@endif
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('js')
	<script>
		$(document).ready(function(){
			$('#datatable').DataTable();
		});
	</script>
@endsection
