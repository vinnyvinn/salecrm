@extends('layouts.app')
@section('content')
	<div class="page-header">
		<div class="page-block">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="page-header-title">
						<h4 class="m-b-10">Leads</h4>
					</div>
					<ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('leads.index')}}">Leads</a></li>
                   
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
					</div>
					<div class="row">
					<div class="col-12">
						
						<div class="card">
							<div class="card-header">
								<h5>Leads</h5>
								<a href="{{ url('leads/create') }}" class="btn-primary btn pull-right" style="float:right">Add Lead</a>
								{{--<div class="col-12">--}}
							{{--</div>--}}
						{{--</div>--}}
							</div>
							<div class="card-block">
								<div class="row">
									<div class="col-12">
										@if (count($leads) > 0)
											<table class="table table-sm" id="datatable">
												<thead>
												<tr>
													<th>#</th>
													<th>Name </th>
													<th>Position</th>
													<th>Email</th>
													<th>Company</th>
													<th>Progress</th>
													<th  style="text-align: right;">Actions</th>
												</tr>
												</thead>
												<tbody>
												@foreach ($leads as $key => $lead)
													<tr>
														<td>{{ $key + 1 }}</td>

														<td><a class="btn btn-link p-0 m-0" href="{{ route('leads.view', $lead->id) }}">{{ $lead->title }} {{ $lead->name }}</a>
															@if($lead->status === config('sales-constants.unqualified'))
																<span class="badge-pill badge-danger"><i class="fa fa-times"></i>
													</span>
															@elseif($lead->status === config('sales-constants.qualified'))
																<span class="badge-pill badge-success"><i class="fa fa-check"></i>
													</span>
															@endif
														</td>
														<td>{{ $lead->job_title }}</td>
														<td>{{ $lead->email }}</td>
														 <td>
                                                            @if($lead->company)
                                                                {{ $lead->company->name }}
                                                            @else
                                                                <div class="dropdown">
                                                                    <button class="btn bg-transparent btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" style="font-size:16px;color:#333;"></i></button>

                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                        <a class="dropdown-item" href="{{ url('companies/create?lead_id='.$lead->id) }}">Create New</a>
                                                                        <modal-trigger inline-template>
                                                                            <a class="dropdown-item" @click.prevent="showModal" href="#">Select existing</a>
                                                                        </modal-trigger>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </td>
														<td>
															<div class="progress">
																<div class="progress-bar bg-c-blue" style="width:{{ round(($lead->stage/3)*100) }}%"><p class="m-b-0" sty>{{ round(($lead->stage/3)*100) }}%</p></div>
															</div>
														</td>
														<td align="right">
															<a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-xs btn-success">EDIT</a>
															<status-toggler
																	post-url="{{ route('leads.delete', $lead->id) }}"
																	message="delete lead {{ $lead->name }}"
																	inline-template>
																<button class="btn btn-xs btn-danger" @click="toggleStatus">DELETE</button>
															</status-toggler>
														</td>
													</tr>
												@endforeach
												</tbody>
											</table>
										@else
											@component('component.blank')
												No Record Found
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
		</div>
	</div>
@endsection
@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#datatable').DataTable();
		});
	</script>
@endsection
@section('modals')
	<company-selector
	get-url="{{ url('api/companies') }}"
	post-url="{{ url('prospects/companies') }}"></company-selector>
@endsection