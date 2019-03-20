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
                        <li class="breadcrumb-item"><a href="{{route('leads.edit', $lead->id)}}">Edit {{ $lead->name }}</a></li>
                    </ul>
			</div>
		</div>
	</div>

	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="row">
					<div class="col-12">
						<form action="{{ route('leads.update', $lead->id) }}" method="post">
						<div class="card">
							<div class="card-header">
								<h5>Create Leads</h5>
								<a href="{{ route('leads.index') }}" class="btn-primary btn pull-right" style="float:right">View Leads</a>
							</div>
							<div class="card-block">
									{{  csrf_field() }}
									<div class="card">
										<div class="card-header">
											<h5>Create Contact Person</h5>
										</div>
										<div class="card-block">
											<div class="form-group form-row">
												<div class="col-md-3">
													<label class="float-label">Lead Owner</label>
													<select class="form-control"  name="lead_owner">
														<option value="">Select Owner</option>
														@foreach ($system_users as $user)
															<option value="{{ $user->id }}" {{ $lead->owner_id == $user->id ? 'selected' :'' }}>{{ $user->name }}</option>
														@endforeach
													</select>
													@if ($errors->has('lead_owner'))
														<span class="text-danger">{{ $errors->first('lead_owner') }}</span>
													@endif
												</div>
												<div class="col-md-3">
													<label>Job Title/Position</label>
													<input type="text" class="form-control" name="job_title" value="{{ $lead->job_title }}">
												</div>
												<div class="col-md-6">
													<label class="float-label d-block">Title <span class="ml-5">Name</span> {{ $errors->has('title') ? $errors->first('title') : '' }}</label>
													<div class="input-group mb-0">
														<div class="input-group-append">
															<select name="title" class="form-control">
																<option value=""></option>
																<option value="mr" {{ $lead->title == 'mr' || old('title') == 'mr' ? 'selected' : '' }}>Mr.</option>
																<option value="mrs" {{ $lead->title == 'mrs' || old('title') == 'mrs' ? 'selected' : '' }}>Mrs.</option>
																<option value="miss" {{ $lead->title == 'miss'  || old('title') == 'miss'? 'selected' : '' }}>Miss</option>
															</select>
														</div>
														<input type="text" class="form-control" placeholder="Full Name" name="name" value="{{ $lead->name }}">
													</div>
													@if ($errors->has('name'))
														<span class="text-danger">{{ $errors->first('name') }}</span>
													@endif
												</div>
											</div>
											<div class="form-row form-group">
												<div class="col-md-6">
													<label for="email">Email</label>
													<input type="text" class="form-control" name="email" value="{{ (bool)old('email') ? old('email') : $lead->email  }}">
													@if ($errors->has('email'))
														{{ $errors->first('email') }}
													@endif
												</div>
												<div class="col-md-6">
													<label>Phone</label>
													<input type="text" class="form-control" name="phone" value="{{ old('phone') ? old('phone') :$lead->phone }}">
													@if ($errors->has('phone'))
														{{ $errors->first('phone') }}
													@endif
												</div>
											</div>
											<div class="form-row form-group">
												<div class="col-md-6">
													<label>Address 1</label>
													<input type="text" class="form-control" name="address_1" value="{{ old('address_1') ? old('address_1') : $lead->address_1 }}">
													@if ($errors->has('address_1'))
														<span class="text-danger">{{ $errors->first('address_1') }}</span>
													@endif
												</div>
												<div class="col-md-6">
													<label>Address 2</label>
													<input type="text" class="form-control" name="address_2" value="{{ old('address_2') ? old('address_2') : $lead->address_2 }}">
													@if ($errors->has('address_2'))
														<span class="text-danger">{{ $errors->first('address_2') }}</span>
													@endif
												</div>
											</div>
											<div class="form-row form-group">
												<div class="col-md-4">
													<label>Country</label>
													<select name="country" class="form-control" id="country">
														<option value="{{$lead->country}}"> {{$lead->country}}</option>
														@include('_partials.country')
													</select>
													@if ($errors->has('country'))
														<span class="text-danger">{{ $errors->first('country') }}</span>
													@endif
												</div>
												<div class="col-md-4">
													<label>City</label>
													<input type="text" name="city" value="{{ $lead->city }}" id="city" class="form-control">
													@if ($errors->has('city'))
														<span class="text-danger">{{ $errors->first('city') }}</span>
													@endif
												</div>
												<div class="col-md-4">
													<label class="float-label">Lead Assignee</label>
													<select class="form-control"  name="assignee">
														<option value="">Select Assignee</option>
														@foreach ($system_users as $user)
															<option value="{{ $user->id }}" {{ old('assignee') == $user->id || $lead->assignee_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
														@endforeach
													</select>
													@if ($errors->has('assignee'))
														<span class="text-danger">{{ $errors->first('assignee') }}</span>
													@endif
												</div>
											</div>
											<div class="form-group">
												<label>Description</label>
												<textarea name="description" id="description" class="form-control" cols="30" rows="5">{{ $lead->description }}</textarea>
											</div>
										</div>
									</div>
									<div class="form-group form-row">
										<button class="btn float-right mr-1 btn-sm btn-primary" type="submit">Save</button>
									</div>
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
	@section('js')
		<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyDB5rEKmWBsmryGshIwUP3iNOAlv3ys7AA&libraries=places'></script>
		<script src="{{ asset('js/locationpicker.jquery.js') }}"></script>
		<script>
            $('#us3').locationpicker({
                location: {
                    latitude:-1.262947 ,
                    longitude:36.8024603 ,
                },
                radius: 300,
                inputBinding: {
                    latitudeInput: $('#us3-lat'),
                    longitudeInput: $('#us3-lon'),
                    radiusInput: $('#us3-radius'),
                    locationNameInput: $('#us3-address')
                },
                enableAutocomplete: true,
                onchanged: function (currentLocation, radius, isMarkerDropped) {
                }
            });
		</script>
@endsection