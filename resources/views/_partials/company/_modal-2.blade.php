<div class="modal fade" id="default-Modal-co{{$contact->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Contact Person</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('contact-person.update',$contact->id)}}">
                <div class="modal-body">
                    {{  csrf_field() }}
                    @method('put')
                    <div class="form-group form-row">

                        <div class="col-md-6">
                            <label>Job Title/Position</label>
                            <input type="text" class="form-control" name="job_title" value="{{ old('job_title',$contact->job_title) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="float-label d-block">Title <span class="ml-5">Name</span> {{ $errors->has('title') ? $errors->first('title') : '' }}</label>
                            <div class="input-group mb-0">
                                <div class="input-group-append">
                                    <select name="title" class="form-control">
                                        <option value="{{$contact->title}}">{{ucwords($contact->title)}}</option>
                                        <option value="mr" {{ old('title') == 'mr' ? 'selected' : '' }}>Mr.</option>
                                        <option value="mrs" {{ old('title') == 'mrs' ? 'selected' : '' }}>Mrs.</option>
                                        <option value="miss" {{ old('title') == 'miss' ? 'selected' : '' }}>Miss</option>
                                    </select>
                                </div>
                                <input type="text" class="form-control" placeholder="Full Name" name="name" value="{{  old('name',$contact->name) }}">
                            </div>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="col-md-6">
                            <label for="email">Email</label>
                            <input type="text" value="{{ old('email',$contact->email) }}" class="form-control" name="email" required>
                            @if ($errors->has('email'))
                                {{ $errors->first('email') }}
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label>Phone</label>
                            <input type="text" value="{{ old('phone',$contact->phone) }}" class="form-control" name="phone" required>
                            @if ($errors->has('phone'))
                                {{ $errors->first('phone') }}
                            @endif
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="col-md-6">
                            <label>Address 1</label>
                            <input type="text" value="{{ old('address_1',$contact->address_1) }}" class="form-control" name="address_1" required>
                            @if ($errors->has('address_1'))
                                <span class="text-danger">{{ $errors->first('address_1') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label>Select Primary Contact</label>
                            <select class="form-control" name="primary_contact" required>
                                @if($company->contactPerson and $company->contactPerson->where('primary_contact','Yes')->first())
                                    @if($company->contactPerson->where('primary_contact','Yes')->first()->id == $contact->id)
                                        <option>Yes</option>
                                    @endif
                                @else
                                    <option>Yes</option>
                                @endif
                                <option>No</option>
                            </select>
                            @if ($errors->has('primary_contact'))
                                <span class="text-danger">{{ $errors->first('primary_contact') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="col-md-6">
                            <label>Country</label>
                            <select name="country" class="form-control" id="country" required>
                                <option >{{$contact->country}}</option>
                                @include('_partials.country')
                            </select>
                            @if ($errors->has('country'))
                                <span class="text-danger">{{ $errors->first('country') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label>City</label>
                            <input type="text" name="city" id="city" value="{{ old('city',$contact->city) }}" class="form-control" required>
                            @if ($errors->has('city'))
                                <span class="text-danger">{{ $errors->first('city') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-12">
                            <label>Description</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="5">{{  old('description',$contact->description) }}</textarea>
                        </div>
                    </div>
                    <input type="hidden" name="company_id" value="{{$company->id}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button class="btn btn-warning btn-xs waves-effect waves-light "> Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>