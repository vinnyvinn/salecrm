@extends('layouts.app')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">{{$company->name}}</h4>
                        <button class="btn btn-primary waves-effect waves-light btn-xs float-right" data-toggle="modal" data-target="#default-Modal-co">Add Contact Person</button>
                        @include('_partials.company._modal')
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('companies.index')}}">Companies</a></li>
                        <li class="breadcrumb-item">{{$company->name}}</li>
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
                            <div class="card">
                                <div class="card-header">
                                    <h5>{{$company->name}}<span>{{$company->company_type}}</span></h5>
                                    <a href="{{ route('companies.edit',$company->id) }}" class="btn btn-sm btn-primary float-right">Edit Company</a>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-hover m-b-0 without-header">
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-inline-block align-middle">

                                                            <div class="d-inline-block">
                                                                <h6>Email</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td align="right">
                                                        <div class="d-inline-block align-middle">

                                                            <div class="d-inline-block">
                                                                <p class="text-right">{{ $company->email }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-inline-block align-middle">

                                                            <div class="d-inline-block">
                                                                <h6>Telephone</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td align="right">
                                                        <div class="d-inline-block align-middle">

                                                            <div class="d-inline-block">
                                                                <p class="text-right">{{ $company->telephone }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-inline-block align-middle">

                                                            <div class="d-inline-block">
                                                                <h6>Phone No</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td align="right">
                                                        <div class="d-inline-block align-middle">

                                                            <div class="d-inline-block">
                                                                <p class="text-rigt">{{ ucwords($company->phone) }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>

                                                    <td>
                                                        <div class="d-inline-block align-middle">

                                                            <div class="d-inline-block">
                                                                <h6>KRA Pin</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td align="right">
                                                        <div class="d-inline-block align-middle">

                                                            <div class="d-inline-block">
                                                                <p class="text-right">{{ $company->kra_pin }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-inline-block align-middle">

                                                            <div class="d-inline-block">
                                                                <h6>Address 1</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td align="right">
                                                        <div class="d-inline-block align-middle">

                                                            <div class="d-inline-block">
                                                                <p class="text-rigt">{{ ucwords($company->addresss_1) }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-inline-block align-middle">

                                                            <div class="d-inline-block">
                                                                <h6>Address 2</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td align="right">
                                                        <div class="d-inline-block align-middle">

                                                            <div class="d-inline-block">
                                                                <p class="text-right">{{ $company->address_2 }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>
                                            <div class="offset-2 map_wrap">
                                                <h6>Location</h6>
                                                <p>{{$company->location}}</p>
                                                <div id="map" style="width: 600px; height: 300px"></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Opportunities</h5>
                                </div>
                                <div class="card-">
                                    <table class="table table-striped table-responsive" id="datatable">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Job Title</th>
                                            <th>Description</th>
                                            <th>Address</th>
                                            <th>Country</th>
                                            <th>City</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($company->contactPerson as $key => $contact)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $contact->title }} {{ $contact->name }}
                                                @if($contact->primary_contact === 'Yes')
                                                   ( <span class=" text-info">primary</span>)
                                                @endif
                                                </td>
                                                <td>{{ $contact->email }}</td>
                                                <td>{{ $contact->phone }}</td>
                                                <td>{{ $contact->job_title }}</td>
                                                <td>{{ $contact->description }}</td>
                                                <td>{{ $contact->address_1 }}</td>
                                                <td>{{ $contact->country }}</td>
                                                <td>{{ $contact->city }}</td>
                                                <td>
                                                    <button class="btn btn-primary waves-effect waves-light btn-xs float-right" data-toggle="modal" data-target="#default-Modal-co{{$contact->id}}"><i class="fa fa-edit"></i> </button>
                                                    @include('_partials.company._modal-2')
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
@section('js')
    <script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyDB5rEKmWBsmryGshIwUP3iNOAlv3ys7AA&libraries=places'></script>
    <script type="text/javascript">
        var myLatLng = new google.maps.LatLng({{{$company->lat}}}, {{{$company->lng}}});
        var myOptions = {
            zoom: 15,
            center: myLatLng ,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map"), myOptions);
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: '{{{$company->name}}}'
        });
    </script>
@endsection