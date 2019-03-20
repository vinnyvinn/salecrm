@extends('layouts.app')
@section('content')
<div class="page-header">
	<div class="page-block">
		<div class="row align-items-center">
			<div class="col-md-12">
				<div class="page-header-title">
					<h4 class="m-b-10">Add Company</h4>
				</div>
				<ul class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="{{ url('/') }}">
							<i class="feather icon-home"></i>
						</a>
					</li>
					<li class="breadcrumb-item"><a href="{{route('companies.index')}}">Companies</a></li>
					<li class="breadcrumb-item">Add Company</li>
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
						<form action="{{ route('companies.store') }}" method="post">
							@if (isset($prospect))
								<input type="hidden" name="prospect_id" value="{{ $prospect->id }}">
							@endif
								@if (isset($lead))
								<input type="hidden" name="lead_id" value="{{ $lead->id }}">
							@endif
							<div class="card">
								<div class="card-header">
									<h5>Create company @if (isset($prospect)) for  {{$prospect->lead->name}} @endif
										@if (isset($lead)) for  {{$lead->name}} @endif</h5>
								</div>
								<div class="card-block">
									
									{{  csrf_field() }}
									<div class="form-group form-row">
										<div class="col-md-6">
										<div class="col-md-12">
											<label>Company Name</label>
											<input value="{{ old('name') }}" type="text" class="form-control" name="name" required>
											@if ($errors->has('name'))
												<span class="text-danger">{{ $errors->first('name') }}</span>
											@endif
										</div>
										<div class="col-md-12">
											<label>Industry/Category</label>
											<select name="company_type" class="form-control" required>
												<option value="">Select Company/Business Type</option>
												<option>Sole Trader</option>
												<option>Partnership</option>
												<option>Limited Liability</option>
												<option>Other</option>
											</select>
											@if ($errors->has('company_type'))
												<span class="text-danger">{{ $errors->first('company_type') }}</span>
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
											<label>Company Email</label>
											<input value="{{ old('email') }}" type="email" class="form-control" name="email" required>
											@if ($errors->has('email'))
												<span class="text-danger">{{ $errors->first('email') }}</span>
											@endif
										</div>
										<div class="col-md-12">
											<label>Company Phone No</label>
											<input value="{{ old('phone') }}" type="text" class="form-control" name="phone" required>
											@if ($errors->has('phone'))
												<span class="text-danger">{{ $errors->first('phone') }}</span>
											@endif
										</div>
										<div class="col-md-12">
											<label> Telephone</label>
											<input value="{{ old('telephone') }}" type="text" class="form-control" name="telephone" >
											@if ($errors->has('telephone'))
												<span class="text-danger">{{ $errors->first('telephone') }}</span>
											@endif
										</div>
										<div class="col-md-12">
											<label>Company Address</label>
											<input value="{{ old('address_1') }}" type="text" class="form-control" name="address_1" required>
											@if ($errors->has('address_1'))
												<span class="text-danger">{{ $errors->first('address_1') }}</span>
											@endif
										</div>
										<div class="col-md-12">
											<label>Company Address 2 (optional)</label>
											<input value="{{ old('address_2') }}" type="text" class="form-control" name="address_2" >
											@if ($errors->has('address_2'))
												<span class="text-danger">{{ $errors->first('address_2') }}</span>
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
											<label>Drag the pin to your Company Location or serch below</label>
											<div class="form-group ">
												<input type="text" class="form-control" value="{{ old('location') }}" name="location" id="us3-address"  required />
											</div>
											<div class="col-md-12 " id="us3" style="width: 600px; height: 400px;"></div>
											<div class="clearfix">&nbsp;</div>
											<div class="m-t-small">
												<div class="col-sm-3">
													<input type="hidden" class="form-control" value="{{ old('lat') }}" name="lat" style="width: 110px" id="us3-lat" required readonly/>
												</div>
												<div class="col-sm-3">
													<input type="hidden" class="form-control" name="lng" value="{{ old('lng') }}" style="width: 110px" id="us3-lon" />
												</div>
											</div>
											<div class="clearfix"></div>
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