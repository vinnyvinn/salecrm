@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashable/bower_components/fullcalendar/css/fullcalendar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashable/bower_components/fullcalendar/css/fullcalendar.print.css') }}" media='print'>
@endsection
@section('content')
 <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Dashboard</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
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
                        <div class="col-xl-3 col-md-6">
                            <div class="card o-hidden bg-c-blue web-num-card">
                                <div class="card-block text-white">
                                    <h5 class="m-t-15">Leads</h5>
                                    <h3 class="m-b-15">{{ count(\App\Lead::where('status',config('sales-constants.open'))->get()) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card o-hidden bg-c-red web-num-card">
                                <div class="card-block text-white">
                                    <h5 class="m-t-15">Prospects</h5>
                                    <h3 class="m-b-15">{{ count( \App\Prospect::where('status',config('sales-constants.open'))->get()) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card o-hidden bg-c-green web-num-card">
                                <div class="card-block text-white">
                                    <h5 class="m-t-15">Prospect Projection</h5>
                                    <h3 class="m-b-15">{{ number_format(\App\Prospect::all()->sum('estimate_amount'), 2) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card o-hidden bg-c-yellow web-num-card">
                                <div class="card-block text-white">
                                    <h5 class="m-t-15">Customers</h5>
                                    <h3 class="m-b-15">{{ count( \App\Customer::all()) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Revenue</h5>
                                    <button class="btn btn-primary btn-xs float-right" data-toggle="modal" data-target="#large-Modal">Add Activity</button>
                                </div>
                                <div class="card-block ">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>User Logs</h5>
                                    <div class="card-header-right">
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
                                                                    <div class="col-6" style="margin-top: 16px">
                                                                        <label for="associate">Associate With</label>
                                                                        <select onchange="selectRelated(this)" name="associate" id="associate"
                                                                                class="form-control">
                                                                            <option value="">Select</option>
                                                                            <option value="">None</option>
                                                                            <option value="lead">Lead</option>
                                                                            <option value="prospect">Prospect</option>
                                                                            <option value="customer">Customer</option>
                                                                            <option value="opportunity">Opportunity</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-12" id="related-to" style="margin-top: 16px">

                                                                    </div>
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
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="schedule-block">
                                        @foreach(\App\Activity::all()->sortBy('deadline')->take(5) as $item)
                                        <div class="schedule-list">
                                            {{--<img src="dashable/assets/images/avatar-4.jpg" alt="user image" class="schedule-image">--}}
                                            <h6>{{ ucfirst($item->title) }} added<small class="m-l-10 text-c-blue f-w-700">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small></h6>
                                            <p class="">{{ mb_strimwidth($item->description,0,20) }}</p>
                                        </div>
                                        @endforeach
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
            'url': '{{ url('prospects/activities/events') }}',
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

        function selectRelated(type) {

            var userType = type.value;
            var relatedContent = '<label for="type">Select</label>' +
                '<select required name="related" id="related"' +
                'class="form-control">' +
                '<option value="">Select</option>'+
                '</select>';
            var relateFild = $('#related-to');

            relateFild.empty().append(relatedContent);

            if(userType == "lead"){
                getResponse('{{ url('api/get-leads') }}', 'lead');
            }

            else if(userType == 'prospect'){
                getResponse('{{ url('api/get-prospects') }}', 'prospect');
            }

            else if(userType == 'customer'){
                getResponse('{{ url('api/get-customers') }}', 'customer');
            }

            else if(userType == 'opportunity'){
                getResponse('{{ url('api/get-opportunities') }}', 'opportunity');
            }
            else {
                relateFild.empty();

                return;
            }


        }

        function getResponse(url, type) {
            axios.get(url)
                .then(function (response) {
                    var leads = response.data.msg;

                    if(leads.length < 1){
                        relateFild.empty();

                        return;
                    }

                    if(type == 'lead' || type == 'customer'){
                        $.each(leads, function (index, value) {
                            $('#related').append($('<option>',{
                                value : value.id,
                                text : value.name+' '+(value.company != null ? '~'+ value.company.name : '')
                            }))
                        })
                    }

                    if(type == 'prospect'){
                        $.each(leads, function (index, value) {
                            $('#related').append($('<option>',{
                                value : value.id,
                                text : value.lead.name+' '+(value.company != null ? '~'+ value.company.name : '')
                            }))
                        })
                    }

                    if(type == 'opportunity'){
                        $.each(leads, function (index, value) {
                            $('#related').append($('<option>',{
                                value : value.id,
                                text : value.title+' ~ '+(value.customer != null ? value.customer.name : (value.prospect != null ? value.prospect.lead.name : '') )
                            }))
                        })
                    }
                })
                .catch(function (response) {
                    console.log(response.data);
                });
        }
    </script>
@endsection
