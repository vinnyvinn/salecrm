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
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Targets</h5> <a href="{{ url('create-target') }}" class="btn-primary btn pull-right" style="float:right">Add Target</a>
                                </div>
                                <div class="card-block">
                                    <table class="table table-sm" id="datables">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Employee</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Expect Lead</th>
                                            <th>Expect Revenue</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($targets as $target)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ ucwords($target->user->name) }}</td>
                                                <td>{{ \Carbon\Carbon::parse($target->start_date)->format('d-M-y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($target->end_date)->format('d-M-y') }}</td>
                                                <td>{{ $target->total_leads }}</td>
                                                <td>{{ number_format($target->revenue,2) }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-xs float-right" data-toggle="modal" data-target="#large-Modal{{ $target->id }}">Edit</button>
                                                    <button style="margin-right: 8px" class="btn btn-danger btn-xs float-right" data-toggle="modal" data-target="#delete">Delete</button>

                                                    <div class="modal fade" id="large-Modal{{ $target->id }}" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit {{ ucwords($target->user->name) }} Target</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ url('target/store') }}" method="post">
                                                                        <div class="card">
                                                                            <div class="card-block">
                                                                                {{  csrf_field() }}
                                                                                <div class="form-group form-row">
                                                                                    <div class="col-md-12">
                                                                                        <label>Select Employee</label>
                                                                                        <select name="user_id" id="user_id" class="form-control">
                                                                                            <option value="">Select Employee</option>
                                                                                            @foreach($teams as  $team)
                                                                                                <option {{ $team->user->id == $target->user_id ? 'selected' : '' }} value="{{ $team->id }}">{{ ucwords($team->user->name) }} ~ {{ strtoupper($team->employee_id) }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label for="start_date">Start Date</label>
                                                                                        <input type="text" value="{{ $target->start_date }}" name="start_date" id="start_date" class="form-control datepicker" readonly required>
                                                                                        @if($errors->has('start_date'))
                                                                                            <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label for="end_date">End Date</label>
                                                                                        <input type="text" value="{{ $target->start_date }}"  name="end_date" id="end_date" class="form-control datepicker" readonly required>
                                                                                        @if($errors->has('end_date'))
                                                                                            <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label>Expect Leads</label>
                                                                                        <input  value="{{ $target->total_leads }}"  required type="number" class="form-control" name="total_leads">
                                                                                        @if ($errors->has('total_leads'))
                                                                                            <span class="text-danger">{{ $errors->first('total_leads') }}</span>
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label>Expect Revenue</label>
                                                                                        <input value="{{ $target->revenue }}" required type="number" class="form-control" name="revenue">
                                                                                        @if ($errors->has('revenue'))
                                                                                            <span class="text-danger">{{ $errors->first('revenue') }}</span>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-footer">
                                                                                <button class="btn float-right mr-1 btn-sm btn-primary" type="submit">Update</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="delete" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-center">Are You Sure</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form id="quiz-form" action="" method="post">
                                                                    <div class="modal-body">
                                                                        <h4 class="text-center" style="color: red"><i class="fas fa-exclamation-circle fa-4x"></i></h4>
                                                                        <h6 class="text-center">{{ strtoupper('Once deleted, you will not be able to recover it!') }}</h6>
                                                                        {{csrf_field()}}
                                                                        {{method_field('delete')}}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-danger waves-effect waves-light ">Delete</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

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
            post-url="{{ url('prospects/companies/add') }}"></company-selector>
@endsection