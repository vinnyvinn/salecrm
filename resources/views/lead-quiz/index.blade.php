@extends('layouts.app')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">Lead Questionnaire</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Questionnaires</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="row">
                            <div class="col-xl-3 col-lg-12 push-xl-9">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-header-text">Questionnaires</h5>
                                    </div>
                                    <div class="card-block">
                                        <ul>
                                            <li>
                                                <a href="{{ route('qualification-questions.create') }}" class="btn btn-success btn-block">Add Questionnaire</a>
                                            </li>
                                        </ul>
                                        <hr>
                                        <ul class="pcoded-item pcoded-left-item">
                                            @foreach($questionnaires as $questionnaire)
                                                <li style="margin-top: 8px !important; margin-bottom: 8px !important;" onclick="showDetail({{ $questionnaire->questions }},{{ $questionnaire }})">
                                                    <button class="waves-effect waves-dark btn btn-primary btn-block">
                                                        <span class="pcoded-micon">{{ $loop->iteration  }}.</span>
                                                        <span class="pcoded-mtext">{{ucwords($questionnaire->title) }}</span>
                                                    </button>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-9 col-lg-12 pull-xl-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-header-text" id="quiz_title">Questionnaire Title</h5>
                                    </div>
                                    <div class="card-block" id="quiz_cont">
                                            @component('component.blank')
                                                No Questionnaire Selected
                                            @endcomponent
                                    </div>
                                    <div class="card-footer" id="quiz-foot">

                                    </div>
                                </div>
                                <div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
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
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('js')
            <script type="text/javascript">
                function showDetail(details, questionnaire) {
                    $('#quiz_title').empty().append('Questionnaire: ' + questionnaire.title);

                    $('#quiz-form').attr('action','{{ url('qualification-questions/') }}'+'/'+questionnaire.id);

                    $('#quiz-foot').empty().append('<div class="pull-right"><button style="margin-right: 8px !important;" id="quiz-danger"' +
                        ' class="btn waves-effect btn-sm pull-left waves-light btn-danger" data-toggle="modal" data-target="#default-Modal">' +
                        '<i class="fas fa-trash"></i></button> ' +
                        '<a href="'+'{{ url("qualification-questions/") }}'+'/'+questionnaire.id+'/edit" id="quiz-edit" class="btn waves-effect btn-sm waves-light btn-primary">' +
                        '<i class="fas fa-edit"></i></a></div>');

                    var total = 0;

                    var content = '<table class="table table-stripped">' +
                        '<thead>' +
                        '<tr>' +
                        '<th>#</th>' +
                        '<th>Question</th>' +
                        '<th class="text-right">Question Weight</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';
                    $.each(details, function (index, value) {
                        content = content + '<tr><td>'+ parseInt(index + 1) + '</td><td>' + value.question + '</td>' +
                                '<td class="text-right">'+ value.weight + '</td></tr>';
                        total = parseInt(total + parseInt(value.weight));
                    });

                    $('#quiz_cont').empty().append(content + '</tbody>' +
                            '<tfoot><tr><td colspan="2" class="text-left"><b>Total Weight </b></td><td class="text-right">'+total+'</td></tr></tfoot>'+
                        '</table>');
                }
            </script>
@endsection