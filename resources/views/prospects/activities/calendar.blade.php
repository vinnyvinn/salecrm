@extends('layouts.app')
@section('content')
	<div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-review_type">
                        <h4 class="m-b-10">{{ $prospect->lead->name }} calendar</h4>
                    </div>
                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('prospects.index')}}">Prospects</a></li>
                        <li class="breadcrumb-item"><a href="{{route('prospects.show', $prospect)}}"> {{ $prospect->lead ? $prospect->lead->name : ''}}</a></li>
                        <li class="breadcrumb-item">Calendar</li>
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
									Calendar <a href="{{ url()->previous() }}" class="btn float-right btn-sm btn-primary">Back</a>
								</div>
								<div class="card-body">
									<div id="calendar">
									
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
	<script src="{{ asset('dashable/bower_components/moment/js/moment.min.js') }}"></script>
	<script src="{{ asset('dashable/bower_components/fullcalendar/js/fullcalendar.min.js') }}"></script>
	<script type="text/javascript">
        var events = [];
        $.ajax({
            'url': '{{ url('prospects/activities/events?prospect_id='. $prospect->id) }}',
            success: function(response) {
                console.log(events = response.data);
                 $('#calendar').fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay,listMonth'
                        },
                        defaultDate: '{{ Carbon\Carbon::now()->format('Y-m-d') }}',
                        navLinks: true, // can click day/week names to navigate views
                        businessHours: true, // display business hours
                        editable: true,
                        droppable: true, // this allows things to be dropped onto the calendar
                        drop: function() {
                            // is the "remove after drop" checkbox checked?
                            if ($('#checkbox2').is(':checked')) {
                                // if so, remove the element from the "Draggable Events" list
                                $(this).remove();
                            }
                        },
                        events: events,
                     dayClick: function(e) {
                         // $('.datepicker').datepicker()
                         var date_input=$('.datepicker'); //our date input has the name "date"
                         var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                         var options={
                             format: 'mm/dd/yyyy',
                             container: container,
                             todayHighlight: true,
                             autoclose: true
                         };
                         date_input.datepicker('destroy');
                         date_input.datepicker('update', e._d);
                         date_input.datepicker(options);
                         $('#large-Modal').modal('show');
                     },
                     eventClick(e) {
                         $.ajax({
                             url:'{{ url('activity') }}/' + e.id,
                             success: function(response) {
                                 $('#activityModal #title').text(response.title);
                                 $('#activityModal #description').text(response.description);
                                 $('#activityModal #type').text(response.type);
                                 $('#activityModal #date').text(response.start);
                                 // $('#activityModal #title').text(response.data.title);
                             }
                         });
                         $('#activityModal').modal('show');
                     },
                    })
            }
        });
		$(function() {
			// $('#external-events .fc-event').each(function() {

	  //       // store data so the calendar knows to render an event upon drop
	  //       $(this).data('event', {
	  //           title: $.trim($(this).text()), // use the element's text as the event title
	  //           stick: true // maintain when user navigates (see docs on the renderEvent method)
	  //       });

	  //       // make the event draggable using jQuery UI
	  //       $(this).draggable({
	  //           zIndex: 999,
	  //           revert: true, // will cause the event to go back to its
	  //           revertDuration: 0 //  original position after the drag
	  //       });
	  //   });
		});
	</script>
@endsection
@section('modals')
    <div class="modal fade" id="large-Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('activity.store') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="col-12">
                            <div class="form-group form-row">
                                <div class="col-6" style="margin-top: 16px">
                                    <label for="title">Task</label>
                                    <input type="text" required name="title" class="form-control">
                                </div>
                                <div class="col-6" style="margin-top: 16px">
                                    <label for="type">Type</label>
                                    <select onchange="selectRelated(this)" required name="type" id="type"
                                            class="form-control">
                                        <option value="">Select</option>
                                        <option value="call">Call</option>
                                        <option value="email">Email</option>
                                        <option value="meeting">Meeting</option>
                                        <option value="todo">To-Do</option>
                                    </select>
                                </div>
                                <div class="col-12" style="margin-top: 16px">
                                    <label for="description">Description</label>
                                    <textarea name="description" required id="description" cols="30" rows="3"
                                              class="form-control"></textarea>
                                </div>
                                {{--<div class="col-6" style="margin-top: 16px">--}}
                                {{--<label for="date">Reminder Date</label>--}}
                                {{--<input type="text" name="date" required class="form-control datepicker">--}}
                                {{--</div>--}}
                                <div class="col-6" style="margin-top: 16px">
                                    <label for="deadline">Deadline</label>
                                    <input type="text" readonly name="deadline" required class="form-control datepicker">
                                </div>
                                <div class="col-6" style="margin-top: 16px">
                                    <label for="assignee_id">Assign To</label>
                                    <select name="assignee_id" required id="assignee_id"
                                            class="form-control">
                                        <option value="">Select</option>
                                        @foreach(\App\User::all() as $item)
                                            <option value="{{ $item->id }}">{{ ucwords($item->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6" style="margin-top: 16px">
                                    <label for="cost">Budget</label>
                                    <input type="number" name="cost" required class="form-control">
                                </div>
                                <input type="hidden" id="related" name="related" value="{{ $prospect->id }}">
                                <input type="hidden" id="associate" name="associate" value="prospect">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light ">Add Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="activityModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-0">
                    <table class="table table-sm table-striped">
                        <tbody>
                        <tr>
                            <th>Title</th>
                            <td id="title"></td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td id="date"></td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td id="type"></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td id="description"></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td id="description"></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('dashable/bower_components/fullcalendar/css/fullcalendar.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('dashable/bower_components/fullcalendar/css/fullcalendar.print.css') }}" media='print'>
@endsection