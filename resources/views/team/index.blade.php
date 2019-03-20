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
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Teams</h5> <a href="{{ url('team/create') }}" class="btn-primary btn pull-right" style="float:right">Add Team</a>
                                </div>
                                <div class="card-block">
                                    <table class="table table-sm" id="datables">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone No</th>
                                                <th>Job Title</th>
                                                <th>Employee ID/NO</th>
                                                <th class="text-right">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($teams as $team)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ ucwords($team->user->name) }}</td>
                                                    <td>{{ ucwords($team->user->email) }}</td>
                                                    <td>{{ ucwords($team->phone_no) }}</td>
                                                    <td>{{ ucwords($team->job_title) }}</td>
                                                    <td>{{ ucwords($team->employee_id) }}</td>
                                                    <td>
                                                        <button class="btn btn-primary btn-xs float-right" data-toggle="modal" data-target="#large-Modal{{ $team->id }}">Edit</button>
                                                        <button style="margin-right: 8px" class="btn btn-danger btn-xs float-right" data-toggle="modal" data-target="#delete">Delete</button>
                                                        <a href="{{ url('target/'.$team->user->id) }}" style="margin-right: 8px" class="btn btn-success btn-xs float-right">Target</a>

                                                        <div class="modal fade" id="large-Modal{{ $team->id }}" tabindex="-1" role="dialog">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit {{ ucwords($team->user->name) }}</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('team.update', $team->id) }}" method="post">
                                                                            <div class="card">
                                                                                <div class="card-block">
                                                                                    {{  csrf_field() }}
                                                                                    {{ method_field('put') }}
                                                                                    <div class="form-group form-row">
                                                                                        <div class="col-md-6">
                                                                                            <label>Full Name</label>
                                                                                            <input value="{{ $team->user->name }}" required type="text" class="form-control" name="name">
                                                                                            @if ($errors->has('name'))
                                                                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <label>Email</label>
                                                                                            <input value="{{ $team->user->email }}" required type="email" class="form-control" name="email">
                                                                                            @if ($errors->has('email'))
                                                                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <label>Job Title</label>
                                                                                            <input value="{{ $team->job_title }}" required type="text" class="form-control" name="job_title">
                                                                                            @if ($errors->has('job_title'))
                                                                                                <span class="text-danger">{{ $errors->first('job_title') }}</span>
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <label>Employee ID/NO</label>
                                                                                            <input value="{{ $team->employee_id }}" required type="text" class="form-control" name="employee_id">
                                                                                            @if ($errors->has('employee_id'))
                                                                                                <span class="text-danger">{{ $errors->first('employee_id') }}</span>
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <label>Phone NO</label>
                                                                                            <input  value="{{ $team->phone_no }}" required type="text" class="form-control" name="phone_no">
                                                                                            @if ($errors->has('phone_no'))
                                                                                                <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <label>Password</label>
                                                                                            <input type="text" class="form-control" required name="password">
                                                                                            @if ($errors->has('password'))
                                                                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card-footer">
                                                                                    <button class="btn float-right mr-1 btn-sm btn-primary" type="submit">Update</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
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