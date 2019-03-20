@extends('layouts.app')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">Team</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('team.index')}}">Team</a></li>
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
                            <form action="{{ route('team.store') }}" method="post">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Create Team</h5>
                                        <a href="{{ route('team.index') }}" class="btn-primary btn pull-right" style="float:right">View Teams</a>
                                    </div>
                                    <div class="card-block">
                                        {{  csrf_field() }}
                                        <div class="form-group form-row">
                                            <div class="col-md-6">
                                                <label>Full Name</label>
                                                <input value="{{ old('name') }}" required type="text" class="form-control" name="name">
                                                @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label>Email</label>
                                                <input value="{{ old('email') }}" required type="email" class="form-control" name="email">
                                                @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label>Job Title</label>
                                                <input value="{{ old('job_title') }}" required type="text" class="form-control" name="job_title">
                                                @if ($errors->has('job_title'))
                                                    <span class="text-danger">{{ $errors->first('job_title') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label>Employee ID/NO</label>
                                                <input value="{{ old('employee_id') }}" required type="text" class="form-control" name="employee_id">
                                                @if ($errors->has('employee_id'))
                                                    <span class="text-danger">{{ $errors->first('employee_id') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label>Phone NO</label>
                                                <input value="{{ old('phone_no') }}" required type="text" class="form-control" name="phone_no">
                                                @if ($errors->has('phone_no'))
                                                    <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label>Password</label>
                                                <input value="{{ old('password') }}" required type="text" class="form-control" name="password">
                                                @if ($errors->has('password'))
                                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                                @endif
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('#datatable').DataTable();
        });
    </script>
@endsection