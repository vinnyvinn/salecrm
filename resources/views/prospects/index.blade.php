@extends('layouts.app')
@section('content')
	<div class="page-header">
		<div class="page-block">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="page-header-title">
						<h4 class="m-b-10">Prospects</h4>
					</div>
					 <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('prospects.index')}}">Prospects</a></li>
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
								<h5>Prospects</h5>
							</div>
							<div class="card-block">
								@if (count($prospects) > 0)
									<table class="table table-sm" id="datables">
											<thead>
												<tr>
													<th>#</th>
													<th>Name</th>
													<th>Company</th>
													<th>Value</th>
													<th>Deadline</th>
													<th class="text-right">Actions</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($prospects as $key => $prospect)
													<tr>
														<td>{{ $key + 1 }}</td>
														<td><a class="btn btn-link" href="{{  route('prospects.show', $prospect->id) }}">{{ $prospect->lead->name }}</a></td>
														<td>
															@if($prospect->company)
															{{ $prospect->company->name }}
															@else
															<div class="dropdown">
																<button class="btn bg-transparent btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" style="font-size:16px;color:#333;"></i></button>
																
																<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
																	<a class="dropdown-item" href="{{ url('companies/create?prospect_id='.$prospect->id) }}">Create New</a>
																	<modal-trigger
																			modal-name="company-selector"
																	row-data="{{ $prospect->id }}"
																	inline-template>
																	<a class="dropdown-item" @click.prevent="showModal" href="#">Select existing</a>
																	</modal-trigger>
																</div>
															</div>

															@endif
														</td>
														<td>{{ number_format($prospect->estimate_amount) }}</td>
														
                                                        <td>
                                                            {{date('M j, Y',strtotime($prospect->deadline))}}
                                                        </td>
														<td align="right">
															@if ($prospect->status == 'open')
																<a href="{{  route('prospects.edit', $prospect->id) }}" class="btn btn-xs btn-success">Edit</a>
															@else
																@if ($prospect->status == 'lost')
																	<div class="badge badge-danger">client was {{ $prospect->status }}</div>
																@endif
																@if ($prospect->status == 'future')
																	<div class="badge badge-info">client has {{ $prospect->status }} potential</div>
																@endif
																@if ($prospect->status == 'won')
																	<div class="badge badge-success">client has been won {{ $prospect->status }}</div>
																@endif
															@endif
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
								@else
									@component('component.blank')
										No Questionnaire Selected
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
@endsection
@section('js')
	<script type="text/javascript">
        $(document).ready(function(){
            $('#datatable').DataTable();
        });
	</script>
	<script src="{{ asset('js/app.js') }}"></script>
@endsection
@section('modals')
	<company-selector
	get-url="{{ url('api/companies') }}"
	post-url="{{ url('prospects/companies/add') }}"></company-selector>
@endsection