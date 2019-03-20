@extends('layouts.app')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">Activities</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('leads.index')}}">Activities</a></li>

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
                                    <h5>Activities</h5>
                                    <form action="{{ url('activity') }}" id="assignee">
                                        <select name="assignee" id="" class="pull-right" onchange="document.getElementById('assignee').submit()">
                                            <option value="all">Select Assignee</option>
                                            @foreach($assignees as $assignee)
                                                <option value="{{ $assignee->id }}" {{ request()->assignee == $assignee->id ? 'selected' : '' }}>{{ $assignee->name }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                    {{--<a href="{{ url('leads/create') }}" class="btn-primary btn pull-right" style="float:right">Add Lead</a>--}}
                                    {{--<div class="col-12">--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-12">
                                            @if (count($activities))
                                                <div class="table-responsive form-material">
                                                    <table id="simpletable" class="table datatable dt-responsive task-list-table table-striped nowrap">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Title</th>
                                                            <th>Type</th>
                                                            <th>Customer</th>
                                                            <th>Cost</th>
                                                            <th>Deadline</th>
                                                            <th>Assigned To</th>
                                                            <th>Added By</th>
                                                            <th>Status</th>
                                                            {{--<th>Created At</th>--}}
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="task-page">
                                                        @foreach($activities as $activity)
                                                            @if($activity->cancelled == 0 && $activity->completed == 0)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ ucwords($activity->title) }}</td>
                                                                <td>
                                                                    {{--<div class="col-auto p-r-0 icon-btn">--}}
                                                                        {{--<button class="btn waves-effect waves-dark btn-success btn-sm btn-outline-success">--}}
                                                                            {{--{!! $activity->type == 'call' ? '<i class="fas fa-phone-square"></i>' : ( $activity->type == 'email' ? '<i class="fas fa-envelope-open"></i>' : ( $activity->type == 'meeting' ? '<i class="fas fa-users"></i>' : '<i class="fas fa-gavel"></i>' ) ) !!}</button>--}}
                                                                    {{--</div>--}}
                                                                {{--</td>--}}
                                                                    {{ strtoupper($activity->type) }}</td>
                                                                @if($activity->customer_id)
                                                                    <td>{{ ucwords($activity->customer->name)  }}</td>
                                                                @elseif($activity->prospect_id)
                                                                    <td>{{ ucwords($activity->prospect->lead->name)  }}</td>
                                                                @elseif($activity->opportunity_id)
                                                                    <td>{{ ucwords($activity->opportunity->title)  }}</td>
                                                                @elseif($activity->lead_id)
                                                                    <td>{{ ucwords($activity->lead->name)  }}</td>
                                                                @else
                                                                    <td>To-Do</td>
                                                                @endif
                                                                <td>{{ $activity->cost }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($activity->deadline)->format('d M, y') }}</td>
                                                                <td>{{ ucwords($activity->assignee->name) }}</td>
                                                                <td>{{ ucwords($activity->creator->name) }}</td>
                                                                <td>{{ ($activity->cancelled == 0 && $activity->completed == 0) ? 'Active' : ($activity->cancelled == 1 ? 'Cancelled' : ($activity->completed == 1 ? 'Done' : 'Unknown')) }}</td>
{{--                                                                <td>{{ \Carbon\Carbon::parse($activity->created_at)->format('d M, y') }}</td>--}}
                                                                <td>
                                                                    <button style="margin-right: 4px !important;" class="btn waves-effect btn-xs pull-left waves-light btn-primary" data-toggle="modal" data-target="#large-Modal{{ $activity->id }}">
                                                                    Update
                                                                    </button>
                                                                    <div class="modal fade" id="large-Modal{{ $activity->id }}" tabindex="-1" role="dialog">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Update Activity</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form action="{{ route('activity.update', $activity->id) }}" method="post">
                                                                                    @csrf
                                                                                    @method('put')
                                                                                <div class="modal-body">
                                                                                    <div class="col-12">
                                                                                        <div class="form-group">
                                                                                            <label for="note">Notes</label>
                                                                                            <textarea name="note" id="note"
                                                                                                      cols="30"
                                                                                                      rows="10"
                                                                                                      class="form-control"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save Update</button>
                                                                                </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button style="margin-right: 4px !important;" class="btn waves-effect btn-xs pull-left waves-light btn-danger" data-toggle="modal" data-target="#default-delete{{ $activity->id }}">
                                                                    Cancel
                                                                    </button>
                                                                    <div class="modal fade" id="default-delete{{ $activity->id }}" tabindex="-1" role="dialog">
                                                                        <div class="modal-dialog lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title text-center">Are You Sure</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form id="quiz-form" action="{{ route('activity.destroy',$activity->id) }}" method="post">
                                                                                    <div class="modal-body">
                                                                                        <h4 class="text-center" style="color: red"><i class="fas fa-exclamation-circle fa-4x"></i></h4>
                                                                                        <h6 class="text-center">Once deleted, you will not be able to recover it!</h6>
                                                                                        {{csrf_field()}}
                                                                                        @method('delete')
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
                                                            @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                @component('component.blank')
                                                    No Record Found
                                                @endcomponent
                                            @endif
                                        </div>
                                    </div>
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