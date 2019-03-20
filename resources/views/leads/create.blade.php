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
					<li class="breadcrumb-item">Add Leads </li>
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
						<form action="{{ url('leads/store') }}" method="post">
						<div class="card">
							<div class="card-header">
								<h5>Create Leads</h5>
								<a href="{{ route('leads.index') }}" class="btn-primary btn pull-right" style="float:right">View Leads</a>
							</div>

							<div class="card-block">
								<toggle
										:old-value="{{ old('company_toggle') == 'true' ? 'true' : 'false' }}"
										inline-template>
									<div>
										<div class="form-group">
											<div class="custom-control custom-radio custom-control-inline">
												<input :value="true" type="radio" @change="emitShit" v-model="showCompanyForm" id="company_on" name="company_toggle" class="custom-control-input">
												<label class="custom-control-label" for="company_on">Organization/Company</label>
											</div>
											<div class="custom-control custom-radio custom-control-inline">
												<input :value="false"  @change="emitShit" v-model="showCompanyForm" type="radio" id="company_off" name="company_toggle" class="custom-control-input" >
												<label class="custom-control-label" for="company_off">Individual</label>
											</div>
										</div>
										<div class="card" v-if="showCompanyForm">
											<div class="card-header">
												<h5>Create company @if (isset($prospect)) "for prospect ".$prospect->lead->name @endif</h5>
											</div>
											<div class="card-block">
												<input type="hidden" name="company_set" value="1">
												<div class="form-group form-row">
													<div class="col-md-6">
														<div class="col-md-12">
															<label>Company Name</label>
															<input value="{{ old('company_name') }}" type="text" class="form-control" name="company_name" required>
															@if ($errors->has('company_name'))
																<span class="text-danger">{{ $errors->first('company_name') }}</span>
															@endif
														</div>
														<div class="col-md-12">
															<label>Industry/Category</label>
															<select name="industry" class="form-control" required>
																<option value="">Select Industry</option>
																<option value="1">Agriculture</option>
																<option value="2">Education</option>
																<option value="3">Technology</option>
															</select>
															@if ($errors->has('industry'))
																<span class="text-danger">{{ $errors->first('industry') }}</span>
															@endif
														</div>
														<div class="col-md-12">
															<label>Type</label>
															<select name="company_type" class="form-control" required>
																<option value="">Select Type</option>
																<option >Sole Trader</option>
																<option >Partnership</option>
																<option >Limited Liability</option>
																<option >Other</option>
															</select>
															@if ($errors->has('company_type'))
																<span class="text-danger">{{ $errors->first('company_type') }}</span>
															@endif
														</div>
														<div class="col-md-12">
															<label>Company Email</label>
															<input value="{{ old('company_email') }}" type="email" class="form-control" name="company_email" required>
															@if ($errors->has('company_email'))
																<span class="text-danger">{{ $errors->first('company_email') }}</span>
															@endif
														</div>
														<div class="col-md-12">
															<label>Company Phone No</label>
															<input value="{{ old('company_phone') }}" type="text" class="form-control" name="company_phone" required>
															@if ($errors->has('company_phone'))
																<span class="text-danger">{{ $errors->first('company_phone') }}</span>
															@endif
														</div>
														<div class="col-md-12">
															<label> Telephone</label>
															<input value="{{ old('company_telephone') }}" type="text" class="form-control" name="company_telephone" required>
															@if ($errors->has('company_telephone'))
																<span class="text-danger">{{ $errors->first('company_telephone') }}</span>
															@endif
														</div>
														<div class="col-md-12">
															<label>Company Address</label>
															<input value="{{ old('company_address_1') }}" type="text" class="form-control" name="company_address_1" required>
															@if ($errors->has('company_address_1'))
																<span class="text-danger">{{ $errors->first('company_address_1') }}</span>
															@endif
														</div>
														<div class="col-md-12">
															<label>Company Address 2 (optional)</label>
															<input value="{{ old('company_address_2') }}" type="text" class="form-control" name="company_address_2" >
															@if ($errors->has('company_address_2'))
																<span class="text-danger">{{ $errors->first('company_address_2') }}</span>
															@endif
														</div>
														<div class="col-md-12">
															<label>Company KRA PIN</label>
															<input value="{{ old('kra_pin') }}" type="text" class="form-control" name="kra_pin" required>
															@if ($errors->has('kra_pin'))
																<span class="text-danger">{{ $errors->first('kra_pin') }}</span>
															@endif
														</div>
													</div>
													<div class="col-md-6">
														<label>Drag the pin to your Company Location or search below</label>
														<div class="form-group ">
															<input type="text" class="form-control" value="{{ old('company_location') }}" name="company_location" id="us3-address"  required />
														</div>
														<div class="col-md-12 " id="us3" style="width: 600px; height: 400px;"></div>
														<div class="clearfix">&nbsp;</div>
														<div class="m-t-small">
															<div class="col-sm-3">
																<input type="hidden" class="form-control" value="-2.9" name="lat" style="width: 110px" id="us3-lat" required readonly/>
															</div>
															<div class="col-sm-3">
																<input type="hidden" class="form-control" name="lng" value="36" style="width: 110px" id="us3-lon" />
															</div>
														</div>
														<div class="clearfix"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</toggle>
								<div class="card">
									<div class="card-header">
										<h5>Create Contact Person</h5>
									</div>
									<div class="card-body">
										{{  csrf_field() }}
										<div class="form-group form-row">
											<div class="col-md-3">
												<label class="float-label">Lead Source</label>
												<select class="form-control"  name="lead_owner">
													<option value="">Select Owner</option>
													@foreach ($system_users as $user)
														<option value="{{ $user->id }}" {{ old('lead_owner') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
													@endforeach
												</select>
												@if ($errors->has('lead_owner'))
													<span class="text-danger">{{ $errors->first('lead_owner') }}</span>
												@endif
											</div>
											<div class="col-md-3">
												<label>Job Title/Position</label>
												<input type="text" class="form-control" name="job_title" value="{{ old('job_title') }}">
											</div>
											<div class="col-md-6">
												<label class="float-label d-block">Title <span class="ml-5">Name</span> {{ $errors->has('title') ? $errors->first('title') : '' }}</label>
												<div class="input-group mb-0">
													<div class="input-group-append">
														<select name="title" class="form-control">
															<option value="">Title</option>
															<option value="mr" {{ old('title') == 'mr' ? 'selected' : '' }}>Mr.</option>
															<option value="mrs" {{ old('title') == 'mrs' ? 'selected' : '' }}>Mrs.</option>
															<option value="miss" {{ old('title') == 'miss' ? 'selected' : '' }}>Miss</option>
														</select>
													</div>
													<input type="text" class="form-control" placeholder="Full Name" name="name" value="{{  old('name') }}">
												</div>
												@if ($errors->has('name'))
													<span class="text-danger">{{ $errors->first('name') }}</span>
												@endif
											</div>
										</div>
										@if (isset($prospect))
											<input type="hidden" name="prospect_id" value="{{ $prospect->id }}">
										@endif
										<div class="form-row form-group">
											<div class="col-md-6">
												<label for="email">Email</label>
												<input type="text" value="{{ old('email') }}" class="form-control" name="email" required>
												@if ($errors->has('email'))
													{{ $errors->first('email') }}
												@endif
											</div>
											<div class="col-md-6">
												<label>Phone</label>
												<input type="text" value="{{ old('phone') }}" class="form-control" name="phone" required>
												@if ($errors->has('phone'))
													{{ $errors->first('phone') }}
												@endif
											</div>
										</div>
										<div class="form-row form-group">
											<div class="col-md-6">
												<label>Address 1</label>
												<input type="text" value="{{ old('address_1') }}" class="form-control" name="address_1" required>
												@if ($errors->has('address_1'))
													<span class="text-danger">{{ $errors->first('address_1') }}</span>
												@endif
											</div>
											<div class="col-md-6">
												<label>Address 2</label>
												<input type="text" value="{{ old('address_2') }}" class="form-control" name="address_2" required>
												@if ($errors->has('address_2'))
													<span class="text-danger">{{ $errors->first('address_2') }}</span>
												@endif
											</div>
										</div>
										<div class="form-row form-group">
											<div class="col-md-4">
												<label>Country</label>
												<select name="country" class="form-control" id="country" required>
													<option value="">Select Country</option>
													@include('_partials.country')
												</select>
												@if ($errors->has('country'))
													<span class="text-danger">{{ $errors->first('country') }}</span>
												@endif
											</div>
											<div class="col-md-4">
												<label>City</label>
												<input type="text" name="city" id="city" value="{{ old('city') }}" class="form-control" required>
												@if ($errors->has('city'))
													<span class="text-danger">{{ $errors->first('city') }}</span>
												@endif
											</div>
											<div class="col-md-4">
												<label class="float-label">Lead Assignee</label>
												<select class="form-control"  name="assignee" required>
													<option value="">Select Assignee</option>
													@foreach ($system_users as $user)
														<option value="{{ $user->id }}" {{ old('assignee') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
													@endforeach
												</select>
												@if ($errors->has('assignee'))
													<span class="text-danger">{{ $errors->first('assignee') }}</span>
												@endif
											</div>
										</div>
										<div class="form-group">
											<label>Description</label>
											<textarea name="description" id="description" class="form-control" cols="30" rows="5">{{  old('description') }}</textarea>
										</div>
									</div>
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
</div>
@endsection
@section('js')
	<script type="text/javascript">
		function toggleCompanyForm() {
		    // $('#company_toggle').
		}
		$(document).ready(function(){
			// $('#datatable').DataTable();
			toggleCompanyForm();
		});
	</script>
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyDB5rEKmWBsmryGshIwUP3iNOAlv3ys7AA&libraries=places'></script>
	<script src="{{ asset('js/locationpicker.jquery.js') }}"></script>
	<script>
		function initMaps() {
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
		}
		$(document).ready(function(){
            var options = {
                    center: new google.maps.LatLng(37.09024, -95.712891),
                    zoom: 7, // smaller number --> zoom out
                    mapTypeId: google.maps.MapTypeId.TERRAIN,

                    // removing all map controls
                    disableDefaultUI: true,

                    // prevents map from being dragged
                    draggable: false,

                    // disabling all keyboard shortcuts
                    keyboardShortcuts: false,

                    disableDoubleClickZoom: true,

                    // do not clear the map div
                    noClear: true
                };
            console.log($('#us3').get(0));
		   	eventBus.$on('shown', function(){
		   	  	$(document).ready(function(){
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
				});
			});
		});
	</script>
	<script>

	</script>
@endsection