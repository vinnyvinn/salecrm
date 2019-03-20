@extends('layouts.app')
@section('content')
	<div class="page-header">
		<div class="page-block">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="page-header-title">
						<h4 class="m-b-10">Prospect</h4>
					</div>
					<ul class="breadcrumb float-left">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('prospects.index')}}">Prospects</a></li>
                        <li class="breadcrumb-item"><a href="{{route('prospects.show', $prospect)}}"> {{ $prospect->lead ? $prospect->lead->name : ''}}</a></li>
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
								<h5><b>Prospect Name :</b> {{ ucwords($prospect->lead->name) }}</h5>
								@if ($prospect->status == 'open')
									<a href="{{ route('prospects.edit', $prospect->id) }}" class="btn btn-xs btn-success float-right">edit</a>
								@endif
								<a href="{{route('customer.create',$prospect->id)}}" class="btn btn-primary pull-right mr-1 btn-xs">Convert to Customer</a>
							</div>
							<div class="card-body">
								<h4>Description</h4>
									<p class="">{{ ucfirst($prospect->lead->description) }}</p>
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
																<p class="text-right">{{ ucwords($prospect->lead->job_title) }}</p>
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
																<p class="text-right">{{ ucwords($prospect->lead->assignee->name)  }}</p>
															</div>
														</div>
													</td>
												</tr>
												@if($prospect->company)
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
																	<h4><a class=" link" href="{{route('companies.show',$prospect->company->id)}}" > <i class="fas fa-external-link-alt"></i> {{ ucwords($prospect->company->name)  }}</a></h4>
																</div>
															</div>
														</td>
													</tr>
													@if(count($prospect->company->contactPerson) > 0)
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
																		<a class="text-info" href="{{route('companies.show',$prospect->company->id)}}" > {{ ucwords($prospect->company->contactPerson->where('primary_contact','Yes')->first()->title).' '. ucwords($prospect->company->contactPerson->where('primary_contact','Yes')->first()->name)  }}</a>
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
								@if ($prospect->status == 'open')
									<button class="btn btn-primary btn-xs float-right " data-toggle="modal" data-target="#large-Modal">Add Activity</button>
                                @component('component.activity')
                                    @slot('related')
                                        {{ $prospect->id }}
                                    @endslot
                                        prospect
                                @endcomponent
{{--									<a href="{{ route('prospects.activities.add', $prospect->id) }}" class="btn btn-xs btn-primary float-right mr-1">Add Activities</a>--}}
								@endif
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
											<p class="m-b-5">{{ strtoupper($activity->type) }}</p>
											<p class="text-muted m-b-0">{{ \Carbon\Carbon::parse($activity->date)->format('M d, Y') }}</p>
											<p class="text-muted m-b-0">{{ $activity->deadline->format('M d, Y') }}</p>
										</div>
										<div class="col-auto text-right">
											@if ($activity->completed)
												<span class="badge badge-success">done</span>
											@elseif($activity->cancelled)
												<span class="badge badge-danger">cancelled</span>
											@else
												<status-toggler
												post-url="{{ route('prospects.activities.completed', $activity->id) }}"
												message="mark activity as done?"
												inline-template>
												<button @click="toggleStatus" class="btn btn-success btn-xs">done</button>
												</status-toggler>
												<status-toggler
												message="mark activity as cancelled?"
												post-url="{{ route('prospects.activities.cancelled', $activity->id) }}"
												inline-template>
												<button class="btn btn-danger btn-xs" @click="toggleStatus">cancel</button>
												</status-toggler>
											@endif
										</div>
									</div>
								@endforeach
							</div>
							<div class="card-footer">
								<a href="{{ route('prospects.activities.calendar', $prospect->id) }}" class="btn btn-block btn-xs btn-primary float-right">View Calendar</a>
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
                                        @foreach($prospect->opportunities as $key => $opportunity)
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
		</div>
@endsection
@section("css")
	<link rel="stylesheet" href="{{ asset('dashable/bower_components/select2/css/select2.min.css') }}">
	<style>
		.select2-container--default .select2-selection--multiple .select2-selection__choice {
			background-color: #3f4d67 !important;
			border: none !important;
		}
	</style>
@endsection
@section('js')
	<script src="{{ asset('dashable/bower_components/select2/js/select2.full.min.js') }}"></script>
	<script>
		$(document).ready(function(){
		   	$('select[multiple]').select2();
		});
	</script>
	<script type="text/javascript">
        $(document).ready(function(){
            $('#datatable').DataTable();
        });
	</script>
	<script src="{{ asset('js/app.js') }}"></script>
@endsection
 @section('modals')
	 <opportunity-editor
	 post-url="{{ url('prospects/opportunity/create', $prospect->id) }}"
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