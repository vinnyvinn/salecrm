@extends('layouts.app')
@section('content')
	<div class="page-header">
	<div class="page-block">
		<div class="row align-items-center">
			<div class="col-md-12">
				<div class="page-header-title">
					<h4 class="m-b-10">Prospects</h4>
				</div>
			</div>
		</div>
	</div>

	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="row">
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<h5>{{ ucwords($lead->name ) }}</h5>
								</div>
								<div class="card-block">
								<h5>Description</h5>
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
																<p style="text-align: right;">{{ strtoupper($lead->job_title) }}</p>
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
																{{-- <p style="text-align: right;">{{ ucwords($lead->assignee->name) }}</p> --}}
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
								<button class="btn btn-primary" data-toggle="modal" data-target="#large-Modal">Questionnaire Result</button>
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
							</div>
							</div>
						</div>
						<div class="col-md-8">
							<form action="{{ route('prospects.update', $prospect) }}" method="post">
								<div class="card">
									<div class="card-header">
										<h5>Create Prospect</h5>
									</div>
									<div class="card-block">
										{{  csrf_field() }}
										<input type="hidden" name="lead_id" value="{{ $lead }}">
										<div class="form-group form-row">
											<div class="col-md-6">
												<label>Company</label>
											<select name="company" id="company" class="form-control" >
												<option value="">Select Company</option>
												<option value="">None</option>
												@foreach ($companies as $company)
												<option value="{{ $company->id }}" {{ old('company') == $company->id || $prospect->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
												@endforeach
											</select>
											@if ($errors->has('company'))
											<span class="text-danger form-text">{{ $errors->first('company') }}</span>
											@endif
											</div>
											<div class="col-md-6">
												<label>Estimated value of prospect</label>
												<input class="form-control" min="0" type="number" name="estimated_value" id="estimated_value" value="{{ old('estimated_value') ? old('estimated_value') : $prospect->estimate_amount }}" required>
												@if ($errors->has('estimated_value'))
													<span class="form-text text-danger">{{ $errors->first('estimated_value') }}</span>
												@endif
											</div>
										</div>
										<div class="form-group form-row">
											<div class="col-md-6">
												<label>Deadline</label>
												<input name="deadline" type="text" class="form-control datepicker" value="{{ old('deadline') ? old('deadline') : $prospect->deadline->format('m/d/Y') }}" required readonly placeholder="Deadline">
												@if ($errors->has('deadline'))
													<span class="text-danger form-text">{{ $errors->first('deadline') }}</span>
												@endif
											</div>
											<div class="col-md-6">
												<label>Assigned to</label>
											<select name="assigned_to" id="assigned_to" class="form-control" required>

												<option value="">Select Assignee</option>
												@foreach ($system_users as $user)
													<option value="{{ $user->id }}" {{ old('assigned_to') == $user->id || $prospect->assignee_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
												@endforeach
											</select>
											@if ($errors->has('assigned_to'))
													<span class="text-danger form-text">{{ $errors->first('assigned_to') }}</span>
												@endif
											</div>
										</div>
			
										<div class="form-group">
											<label>Comments</label>
											<textarea name="comments" id="comments" cols="20" rows="5" class="form-control" required>{{ old('comments') ? old('comnents') : $prospect->comments }}</textarea>
										</div>
									</div>
									<div class="card-footer">
										<button class="btn float-right mr-1 btn-sm btn-primary" type="submit">Save</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection