@extends('layouts.app')
@section('content')
	<div class="page-header">
		<div class="page-block">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="page-header-title">
						<h4 class="m-b-10">customer</h4>
					</div>
					 <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('customer.index')}}">customers</a></li>
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
						<div class="col-md-2"></div>
					<div class="col-md-8">
						
						<div class="card">
							<div class="card-header">
								<h5>Create Activity</h5>
							</div>
							<div class="card-body">
								<form action="{{ route('customers.activities.store',$customer->id) }}" method="post">
									{{  csrf_field() }}
									<div class="form-group form-row">
										<div class="col-md-6">
											<label>Title</label>
											<input type="text" name="title" class="form-control" id="title">
											@if ($errors->has('title'))
											<span class="form-text text-danger">{{ $errors->first('title') }}</span>
											@endif
										</div>
										<div class="col-md-6">
											<label>Activity Type</label>
											<select class="form-control" name="activity_type">
												<option class="">Select Type</option>
												@foreach (config('sales-constants.activity-types') as $element)		
													<option value="{{ $element }}">{{ $element }}</option>
												@endforeach
											</select>	
											@if ($errors->has('activity_type'))
											<span class="form-text text-danger">{{ $errors->first('activity_type') }}</span>
											@endif
										</div>
									</div>
									<div class="form-row form-group">
										<div class="col-md-4">
											<label for="assigned_to">Assigned to</label>
											<select name="assigned_to" id="assigned_to" class="form-control">
												<option value="">Select an Assignee</option>
												@foreach ($system_users as $user)
													<option value="{{ $user->id }}" {{ old('assigned_to') == $user->id || $customer->assignee_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
												@endforeach
											</select>
											@if($errors->has('assigned_to'))
												<span class="text-danger">{{ $errors->first('assigned_to') }}</span>
											@endif
										</div>
										<div class="col-md-4">
											<label for="date">Date to be done</label>
											<input type="text" name="date" id="date" class="form-control datepicker" readonly required>
											@if($errors->has('date'))
												<span class="text-danger">{{ $errors->first('date') }}</span>
											@endif
										</div>
										<div class="col-md-4">
											<label for="deadline">Deadline</label>
											<input type="text" name="deadline" id="deadline" class="form-control datepicker" readonly placeholder="Deadline" required>
											@if($errors->has('deadline'))
												<span class="text-danger">{{ $errors->first('deadline') }}</span>
											@endif
										</div>
									</div>
									<div class="form-group">
										<label>Description</label>
										<textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
									</div>
									<div class="form-group">
										<button class="btn btn-primary btn-sm float-right">Add Activity</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection