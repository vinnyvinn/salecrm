@extends('layouts.app')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">Target</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('target')}}">Target</a></li>
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
                            <form action="{{ url('target/store') }}" method="post">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Create Target</h5>
                                        <a href="{{ url('target') }}" class="btn-primary btn pull-right" style="float:right">View Targets</a>
                                    </div>
                                    <div class="card-block">
                                        {{  csrf_field() }}
                                        <div class="form-group form-row">
                                            <div class="col-md-6">
                                                <label>Select Employee</label>
                                                <select name="user_id" id="user_id" class="form-control">
                                                    <option value="">Select Employee</option>
                                                    @foreach($teams as  $team)
                                                        <option value="{{ $team->user->id }}">{{ ucwords($team->user->name) }} ~ {{ strtoupper($team->employee_id) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Target Title</label>
                                                <input type="text" name="title" id="title" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="start_date">Start Date</label>
                                                <input type="text" name="start_date" id="start_date" class="form-control datepicker" readonly required>
                                                @if($errors->has('start_date'))
                                                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="end_date">End Date</label>
                                                <input type="text" name="end_date" id="end_date" class="form-control datepicker" readonly required>
                                                @if($errors->has('end_date'))
                                                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label>Expect Leads</label>
                                                <input value="{{ old('total_leads') }}" required type="number" class="form-control" name="total_leads">
                                                @if ($errors->has('total_leads'))
                                                    <span class="text-danger">{{ $errors->first('total_leads') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label>Expect Revenue</label>
                                                <input value="{{ old('revenue') }}" required type="number" class="form-control" name="revenue">
                                                @if ($errors->has('revenue'))
                                                    <span class="text-danger">{{ $errors->first('revenue') }}</span>
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