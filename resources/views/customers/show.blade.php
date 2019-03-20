@extends('layouts.app')
@section('content')
	<div class="page-header">
		<div class="page-block">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="page-header-title">
						<h4 class="m-b-10">Customer</h4>
					</div>
					<ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('customer.index')}}">Customers</a></li>
                        <li class="breadcrumb-item"><a href="{{route('customer.show', $customer->id)}}"> {{ $customer->prospect->lead ? $customer->prospect->lead->name : ''}}</a></li>
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
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h5>{{ ucwords($customer->name) }}</h5>
									<a href="{{route('customer.edit',$customer->id)}}" class="btn btn-primary btn-xs float-right" >Edit </a>
								</div>
								<div class="card-body">
									<h4>Description</h4>
									<p class="">{{ ucfirst($customer->description) }}</p>
									<div class="row">
										<div class="table-responsive">
											<table class="table table-hover m-b-0 without-header">
												<tbody>
												<tr>
													<td>
														<div class="d-inline-block align-middle">

															<div class="d-inline-block">
																<h6>Job Title/Position</h6>
															</div>
														</div>
													</td>
													<td align="right">
														<div class="d-inline-block align-middle">

															<div class="d-inline-block">
																<p class="text-right">{{ ucwords($customer->job_title) }}</p>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="d-inline-block align-middle">

															<div class="d-inline-block">
																<h6>Assigned To</h6>
															</div>
														</div>
													</td>
													<td align="right">
														<div class="d-inline-block align-middle">

															<div class="d-inline-block">
																<p class="text-rigt">{{ ucwords($customer->assignee->name)  }}</p>
															</div>
														</div>
													</td>
												</tr>
											@if($customer->company)
												<tr>
													<td>
														<div class="d-inline-block align-middle">

															<div class="d-inline-block">
																<h6>Company</h6>
															</div>
														</div>
													</td>
													<td align="right">
														<div class="d-inline-block align-middle">

															<div class="d-inline-block">
																<h4><a class=" link" href="{{route('companies.show',$customer->company->id)}}" > <i class="fas fa-external-link-alt"></i> {{ ucwords($customer->company->name)  }}</a></h4>
															</div>
														</div>
													</td>
												</tr>
												@if(count($customer->company->contactPerson) > 0)
												<tr>
													<td>
														<div class="d-inline-block align-middle">

															<div class="d-inline-block">
																<h6>Primary Contact</h6>
															</div>
														</div>
													</td>
													<td align="right">
														<div class="d-inline-block align-middle">

															<div class="d-inline-block">
																<a class="text-info" href="{{route('companies.show',$customer->company->id)}}" > {{ ucwords($customer->company->contactPerson->where('primary_contact','Yes')->first()->title).' '. ucwords($customer->company->contactPerson->where('primary_contact','Yes')->first()->name)  }}</a>
															</div>
														</div>
													</td>
												</tr>
												@endif
											@endif
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h5>Recent Activities</h5>
									<button class="btn btn-primary btn-xs float-right " data-toggle="modal" data-target="#large-Modal">Add Activity</button>

									@component('component.activity')
										@slot('related')
											{{ $customer->id }}
										@endslot
										customer
									@endcomponent
								</div>
								<div class="card-block">
									@foreach ($activities as $activity)
										<div class="row align-items-center b-b-default p-b-20 m-b-20">
											<div class="col-auto p-r-0 icon-btn">
												<button class="btn waves-effect waves-dark btn-success btn-outline-success">
													{!! $activity->type == 'call' ? '<i class="fas fa-phone-square"></i>' : ( $activity->type == 'email' ? '<i class="fas fa-envelope-open"></i>' : ( $activity->type == 'meeting' ? '<i class="fas fa-users"></i>' : '<i class="fas fa-gavel"></i>' ) ) !!}</button>
											</div>
											<div class="col">
												<h6 class="m-b-5">{{ ucwords($activity->title) }}</h6>
												<p class="m-b-5">{{ ucwords($activity->type) }}</p>
												<p class="text-muted m-b-0">{{ \Carbon\Carbon::parse($activity->date)->format('M d, Y') }}</p>
											</div>
											<div class="col-auto text-right">
												@if ($activity->completed)
													<span class="badge badge-success">done</span>
												@elseif($activity->cancelled)
													<span class="badge badge-danger">cancelled</span>
												@else
													<status-toggler
															post-url="{{ route('customers.activities.completed', $activity->id) }}"
															message="mark activity as done?"
															inline-template>
														<button @click="toggleStatus" class="btn btn-success btn-xs">done</button>
													</status-toggler>
													<status-toggler
															message="mark activity as cancelled?"
															post-url="{{ route('customers.activities.cancelled', $activity->id) }}"
															inline-template>
														<button class="btn btn-danger btn-xs" @click="toggleStatus">cancel</button>
													</status-toggler>
												@endif
											</div>
										</div>
									@endforeach
								</div>
								<div class="card-footer">
									<a href="{{ route('customers.activities.calendar', $customer->id) }}" class="btn btn-block btn-xs btn-primary float-right">View Calendar</a>
								</div>
							</div>
						</div>
					</div>

					</div>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3>Customer Information</h3>
								</div>
								<div class="card-body">
									<h5>Bank Infomation</h5>
									<div class="col-12">
										<table class="table table-bordered">
											<tr>
												<td><h6>Bank Name:</h6>{{$customer->bank_name}}</td>
												<td><h6>Bank Address: </h6>{{$customer->bank_address}}</td>
												<td><h6>Tel: </h6>{{$customer->telephone}}</td>
												<td><h6>Branch: </h6>{{$customer->branch}}</td>
												<td><h6>Bankcode:</h6>{{$customer->bank_code}}</td>
											</tr>
											<tr>
												<td><h6>Swiftcode: </h6>{{$customer->swiftcode}}</td>
												<td><h6>Bank Account No: </h6>{{$customer->bank_account_no}}</td>
												<td><h6>Payment Date: </h6>{{date('M j, Y',strtotime($customer->payment_date))}}</td>
												<td><h6>Payment Mode: </h6>{{$customer->payment_mode}}</td>
												<td><h6>Currency: </h6>{{$customer->currency}}</td>
											</tr>
										</table>
									</div>

									<h5>Business/Trade References</h5>
									{{--<div class="col-md-12">--}}
									<div class="col-md-6 float-left">
										<h6>Company 1</h6>
										<table class="table table-bordered">
											<tr>
												<td><h6>Company Name:</h6>{{$customer->co_name_1}}</td>
												<td><h6>Contact Name: </h6>{{$customer->co_contact_name_1}}</td>
											</tr>
											<tr>
												<td><h6> Address: </h6>{{$customer->co_address_1}}</td>
												<td><h6>City: </h6>{{$customer->co_city_1}}</td>
											</tr>
											<tr>
												<td><h6>PostCode:</h6>{{$customer->co_postcode_1}}</td>
												<td><h6>Phone: </h6>{{$customer->co_phone_1}}</td>
											</tr>
											<tr>
												<td><h6>Email: </h6>{{$customer->co_email_1}}</td>
												<td><h6>Comment: </h6>{{$customer->co_comment_1}}</td>
											</tr>
										</table>
									</div>
									<div class="col-md-6 float-right">
										<h6>Company 2</h6>
										<table class="table table-bordered">
											<tr>
												<td><h6>Company Name:</h6>{{$customer->co_name_2}}</td>
												<td><h6>Contact Name: </h6>{{$customer->co_contact_name_2}}</td>
											</tr>
											<tr>
												<td><h6> Address: </h6>{{$customer->co_address_2}}</td>
												<td><h6>City: </h6>{{$customer->co_city_2}}</td>
											</tr>
											<tr>
												<td><h6>PostCode:</h6>{{$customer->co_postcode_2}}</td>
												<td><h6>Phone: </h6>{{$customer->co_phone_2}}</td>
											</tr>
											<tr>
												<td><h6>Email: </h6>{{$customer->co_email_2}}</td>
												<td><h6>Comment: </h6>{{$customer->co_comment_2}}</td>
											</tr>
										</table>
									</div>
									{{--</div>--}}
										<div class="clearfix"></div>
										<h5>Attachmnets</h5>
										<div class="col-12">
											<table class="table table-bordered">
												<tr>
													<td><h6>PIN Certificate: </h6><a class="text-info" href="{{asset($customer->pin_cert)}}" target="_blank">PIN Certificate</a> </td>
													<td><h6>VAT Certificate: </h6><a class="text-info" href="{{asset($customer->vat_cert)}}" target="_blank">VAT Certificate</a> </td>
													<td><h6>Company Registration Certificate: </h6><a class="text-info" href="{{asset($customer->co_reg_cert)}}" target="_blank">Company Registration Certificate</a> </td>
												</tr>
												<tr>
													<td><h6>ID of Representative(s): </h6><a class="text-info" href="{{asset($customer->rep_id_file)}}" target="_blank">Company Registration Certificate:</a> </td>
													<td><h6>List of Directors (CR 12 Form) </h6><a class="text-info" href="{{asset($customer->directors_list)}}" target="_blank">List of Directors (CR 12 Form)</a> </td>
													<td><h6>Office Location - Utility Bill: </h6><a class="text-info" href="{{asset($customer->utility_bill)}}" target="_blank">Office Location</a> </td>
												</tr>
											</table>
										</div>

									{{--<div class="col-md-12">--}}
										<h3>Financial Information in {{mb_strtoupper($customer->currency)}}</h3>
										<div class="col-md-12">
											<table class="table table-bordered">
												<tr>
													<td><h6>Financial Information in {{mb_strtoupper($customer->currency)}}</h6></td>
													<td><h6>Previous 1 year</h6></td>
													<td><h6>Previous 2 years</h6></td>
												</tr>
												<tr>
													<td><h6>Annual Turnover :</h6></td>
													<td>{{$customer->total_turnover_1}}</td>
													<td>{{$customer->total_turnover_2}}</td>
												</tr>
												<tr>
													<td><h6> Total Assets: </h6></td>
													<td>{{$customer->total_assets_1}}</td>
													<td>{{$customer->total_assets_2}}</td>
												</tr>
												<tr>
													<td><h6> Current Assets: </h6></td>
													<td>{{$customer->current_assets_1}}</td>
													<td>{{$customer->current_assets_2}}</td>
												</tr>
												<tr>
													<td><h6> Total Liabilities: </h6></td>
													<td>{{$customer->total_liabilities_1}}</td>
													<td>{{$customer->total_liabilities_2}}</td>
												</tr>
												<tr>
													<td><h6> Current Liabilities: </h6></td>
													<td>{{$customer->current_liabilities_1}}</td>
													<td>{{$customer->current_liabilities_2}}</td>
												</tr>
												<tr>
													<td><h6> Profits Before Taxes: </h6></td>
													<td>{{$customer->profit_before_taxes_1}}</td>
													<td>{{$customer->profit_before_taxes_2}}</td>
												</tr>
												<tr>
													<td><h6> Profits After Taxes: </h6></td>
													<td>{{$customer->profit_after_taxes_1}}</td>
													<td>{{$customer->profit_after_taxes_2}}</td>
												</tr>
											</table>
										</div>
									{{--</div>--}}
									</div>
								</div>
							</div>
					</div>
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h5>Opportunities</h5>
								<modal-trigger
										modal-name="opportunity-editor"
										row-data=""
										inline-template>
									<button class="float-right btn btn-primary btn-sm" @click="showModal">Add Opportunity</button>
								</modal-trigger>
							</div>
							<div class="card-block">
								<table class="table table-sm table-striped" id="datatable">
									<thead>
									<tr>
										<th>#</th>
										<th>Title</th>
										<th>Opportunity Value</th>
										<th>Target Value</th>
										<th>Stage</th>
										<th></th>
									</tr>
									</thead>
									<tbody>
									@foreach($customer->opportunities as $key => $opportunity)
										<tr>
											<td>{{ $key + 1 }}</td>
											<td>{{ $opportunity->title }}</td>
											<td>{{ $opportunity->opportunity_value }}</td>
											<td>{{ $opportunity->target_value }}</td>
											<td>{{ $opportunity->status }}</td>
											<td align="right">
												<modal-trigger
														modal-name="status-picker"
														:row-data="{{ json_encode($opportunity)}}"
														inline-template>
													<button class="btn btn-xs btn-primary" @click="showModal">change stage</button>
												</modal-trigger>
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
@endsection
@section("modals")
	<opportunity-editor
			post-url="{{ url('customers/opportunity/create', $customer->id) }}"
			edit-url="{{ url('/') }}"
			:users="{{ json_encode($users) }}"
			:types="{{ json_encode(config('sales-constants.opportunity-types')) }}"
	>
	</opportunity-editor>
	<status-picker
			post-url="{{ url('opportunity/status/set') }}"
			:statuses="{{ json_encode(config('sales-constants.prospect-statuses')) }}">
	</status-picker>
@endsection