@extends('layouts.app')
@section('content')
	<div class="page-header">
		<div class="page-block">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="page-header-title">
						<h4 class="m-b-10">Customers</h4>
					</div>
					<ul class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ url('/') }}">
								<i class="feather icon-home"></i>
							</a>
						</li>
						<li class="breadcrumb-item"><a href="{{route('customer.index')}}">Customers</a></li>
						<li class="breadcrumb-item">All Customers</li>
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
								<h5>All Customers</h5>
							</div>
							<div class="card-block">
								@if (count($customers) > 0)
									<table class="table table-sm" id="datables">
										<thead>
										<th>#</th>
										<th>Name</th>
										<th>Company</th>
										<th>Value</th>
										<th>Progress</th>
										<th>Deadline</th>
										<th>Actions</th>
										</thead>
										<tbody>
										@foreach ($customers as $key => $customer)
											<tr>
												<td>{{ $key + 1 }}</td>
												<td><a class="btn btn-link" href="{{  route('customer.show', $customer->id) }}">{{ $customer->prospect->lead->name }}</a></td>
												<td>
													@if($customer->company)
														{{ $customer->company->name }}
													@else
														<div class="dropdown">
															<button class="btn bg-transparent btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" style="font-size:16px;color:#333;"></i></button>

															<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
																<a class="dropdown-item" href="{{ url('companies/create?prospect_id='.$customer->id) }}">Create New</a>
																<modal-trigger
																		modal-name="company-selector"
																		row-data="{{ $customer->id }}"
																		inline-template>
																	<a class="dropdown-item" @click.prevent="showModal" href="#">Select existing</a>
																</modal-trigger>
															</div>
														</div>

													@endif
												</td>
												<td>{{ number_format($customer->estimate_amount) }}</td>
												<td>
													<div class="progress">
														<div class="progress-bar bg-c-blue" style="width:{{ round(($customer->stage/3)*100) }}%"><p class="m-b-0">{{ round(($customer->stage/3)*100) }}%</p></div>
													</div>
												</td>
												<td>
													{{date('M j, Y',strtotime($customer->deadline))}}
												</td>
												<td align="right">

													<button class="btn btn-xs btn-success">Pending</button>
												</td>
											</tr>
										@endforeach
										</tbody>
									</table>
								@else
									@component('component.blank')
										No Customer Record
									@endcomponent
								@endif
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<company-selector
	post-url="{{ url('customers/companies/add')  }}"
	get-url="{{ url('api/companies') }}"
	></company-selector>
@endsection
@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
@endsection
