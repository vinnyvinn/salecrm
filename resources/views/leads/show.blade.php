@extends('layouts.app')
@section('content')
	<div class="page-header">
		<div class="page-block">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="page-header-title">
						<h4 class="m-b-10">Lead</h4>
					</div>
					<ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('leads.index')}}">Leads</a></li>
                        <li class="breadcrumb-item"><a href="{{route('leads.view', $lead->id)}}"> {{ $lead->name }}</a></li>
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
								<h5>{{ ucwords($lead->title) }}. {{ ucwords($lead->name ) }}</h5>
								<a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-xs btn-success float-right">edit</a>
							</div>
							<div class="card-block">
		
								<p class="">{{ ucfirst($lead->description) }}</p>
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
																<p class="text-right">{{ ucwords($lead->assignee->name) }}</p>
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
																<p class="text-rigt">{{ ucwords($lead->job_title) }}</p>
															</div>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="card-footer amount-close-card">
								<h5 class="sub-title">Lead Progress {{ round(($lead->stage/3)*100) }}%</h5>
									<div class="progress ">
                                        <div class="progress-bar bg-c-blue" style="width:{{ ($lead->stage/3)*100 }}%"></div>
                                    </div>
							</div>
						</div>
					</div>
					<div class="col-6">
							<div class="card amount-close-card">
								<div class="card-header">
									<h5>Questionnaire {{$lead->stage == config('sales-constants.default')?'':'Result'}}</h5>
								</div>
							@if ($lead->stage > config('sales-constants.default'))
								<div class="card-block">
									<div class="row">
										<div class="col-12 text-center">
                                            @if(number_format(\App\Http\Controllers\LeadQuizController::getSum(json_decode($lead->leadQuizResults->question_result, true), 'answer') / count(json_decode($lead->leadQuizResults->question_result, true)), 1) < 40)
											<i class="far fa-frown fa-5x"></i>
                                            @else
                                                <i class="far fa-smile fa-5x"></i>
                                            @endif
										</div>
									</div>
									<div class="row" style="margin-top: 26px">
										<div class="col-12">
											<h4 class="text-center">
												{{ ucwords($lead->name) }} Questionnaire Result
											</h4>
										</div>
									</div>
                                    <div class="row align-items-center m-b-15" style="margin-top: 26px">
                                        <div class="col-auto">
                                            <h6 class="m-b-0 text-c-blue">{{ ucwords($lead->leadQuizResults->leadQuiz->title ) }}</h6>
                                        </div>
                                        <div class="col text-right">
                                            <p class="m-b-0">{{ number_format(\App\Http\Controllers\LeadQuizController::getSum(json_decode($lead->leadQuizResults->question_result, true), 'answer') / count(json_decode($lead->leadQuizResults->question_result, true)), 1) }}%</p>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar {{ number_format(\App\Http\Controllers\LeadQuizController::getSum(json_decode($lead->leadQuizResults->question_result, true), 'answer') / count(json_decode($lead->leadQuizResults->question_result, true)), 1) < 40 ? 'bg-c-red' : 'bg-c-green' }}" style="width:{{ (\App\Http\Controllers\LeadQuizController::getSum(json_decode($lead->leadQuizResults->question_result, true), 'answer') / count(json_decode($lead->leadQuizResults->question_result, true))) }}%"></div>
                                    </div>
									<div class="row" style="margin-top: 28px; margin-bottom: 27px">
										<div class="col-12">
											<h4 class="text-center">
												<button class="btn btn-primary" data-toggle="modal" data-target="#large-Modal">View Result</button>

                                                <div class="modal fade" id="large-Modal" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">{{ ucwords($lead->leadQuizResults->leadQuiz->title ) }} Questionnaire Result</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-stripped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Question</th>
                                                                        <th>Weight</th>
                                                                        <th>Answer</th>
                                                                        <th>%</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach(json_decode($lead->leadQuizResults->question_result, true) as $item)
                                                                        <tr>
                                                                            <td>{{ $loop->iteration }}</td>
                                                                            <td>{{ ucfirst($item['question']) }}</td>
                                                                            <td>{{ $item['weight'] }}</td>
                                                                            <td>{{ number_format(($item['weight'] * $item['answer']) / 100) }}</td>
                                                                            <td>{{ $item['answer'] }}%</td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
											</h4>
										</div>
									</div>
                                </div>

							@else
									<div class="card-block">
										<div class="row">
											<div class="col-12 text-center">
												@if ($lead->stage == config('sales-constants.default'))
													<h4>Fill Questionnaire <br><br> For</h4>
												@else
													<i class="far fa-frown fa-5x"></i>
												@endif

											</div>
										</div>
										<div class="row" style="margin-top: 20px">
											<div class="col-12">
												<h4 class="text-center">
													{{ ucwords($lead->name) }}
												</h4>
											</div>
										</div>
										<div class="row align-items-center m-b-15" style="margin-top: 26px">
											<div class="col-auto">
												<h6 class="m-b-0 text-c-blue">{{ $lead->stage == config('sales-constants.default') ? 'No Result' : 'Questionnaire Percentage'}}</h6>
											</div>
											<div class="col text-right">
												<p class="m-b-0">{{ $lead->stage == config('sales-constants.default') ? '0%' : 90 }}</p>
											</div>
										</div>
										<div class="progress">
											<div class="progress-bar bg-c-blue" style="width:{{ $lead->stage == config('sales-constants.default') ? '0%' : '90%' }}"></div>
										</div>
										<div class="row" style="margin-top: 28px; margin-bottom: 22px">
											<div class="col-12">
												<h4 class="text-center">
													@if ($lead->stage == config('sales-constants.default'))
														<a href="{{ url('lead/'.$lead->id.'/questionnaire') }}" class="btn-primary btn mr-4">Fill Questionnaire</a>
													@endif
												</h4>
											</div>
										</div>
									</div>
							@endif
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card ">
								<div class="card-header">
									<h5>Reviews</h5>
									@if ($lead->stage >= config('sales-constants.questionnaire') and !$lead->reviews->where('review_type',config('sales-constants.general'))->first())
										<a href="{{route('reviews.create',$lead->id)}}" class="pull-right btn-primary btn mr-4 btn-xs" style="float:right">Add Reviews</a>
									@endif
								</div>
							@if ($lead->stage > config('sales-constants.questionnaire'))
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover m-b-0 without-header">
											<tbody>
												<tr>
												@foreach($lead->reviews as $review)
													<td>
														<div class="d-inline-block align-middle">
															<div class="d-inline-block">
																<h6>{{ucwords($review->review_type)}}</h6>
																<p class="text-muted m-b-0">By: {{$review->user->name}}</p>
															</div>
														</div>
													</td>
													<td class="text-right">
														<button class="btn {{$review->confirmed == true ?'btn-success':'btn-danger'}} waves-effect waves-light btn-xs"><i class="fa {{$review->confirmed == true ?'fa-check':'fa-times'}}"></i> </button>
														<button class="btn btn-primary waves-effect waves-light btn-xs" data-toggle="modal" data-target="#default-Modal{{$review->id}}">View</button>
													</td>
													@include('_partials.reviews._modal')
												@endforeach
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							@endif
							</div>
						</div>
					</div>

				@if ($lead->stage == config('sales-constants.prospect') and $lead->status != config('sales-constants.unqualified'))
					<div class="row">
						<div class="col-12">
							<div class="card ">
								<div class="card-header">
									<h5>Qualified to Prospect</h5>
										<a href="{{ route('prospects.create', $lead) }}" class="pull-right btn-success btn">Move to Prospect</a>
								</div>

							</div>
						</div>
					</div>
				@endif

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