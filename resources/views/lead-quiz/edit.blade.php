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
                        <li class="breadcrumb-item"><a href="{{route('qualification-questions.index')}}">Lead Questionnaire</a></li>
                        <li class="breadcrumb-item">Edit {{$questionnaire->title}}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="row">
                            <div class="col-12">
                                <form action="{{ route('qualification-questions.update', $questionnaire->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Edit Questionnaire</h5>
                                        </div>
                                        <div class="card-block">
                                            <div class="form-group form-row">
                                                <div class="col-md-12">
                                                    <label>Questionnaire Title</label>
                                                    <input type="text" value="{{ $questionnaire->title }}" class="form-control" required name="title">
                                                </div>
                                                <div class="col-12">
                                                    <hr>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row" id="questions">
                                                        @foreach(json_decode($questionnaire->questions) as $question)
                                                            <div class="count-me col-md-10 {{ $loop->iteration }}">
                                                                <label>Question</label>
                                                                <input type="text" value="{{ $question->question }}" class="form-control" required name="quiz[]">
                                                            </div>
                                                            <div class="col-md-2 {{ $loop->iteration }}">
                                                                <label>Question Weight <span onclick="deleteQuiz('{{ $loop->iteration }}')"><i class="fas fa-minus-circle" style="color: red"></i></span></label>
                                                                <input type="number" value="{{ $question->weight }}" class="form-control" required name="weight[]">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <button type="button" onclick="addQuestion()" class="btn btn-primary btn-outline btn-icon pull-right"> <i class="fas fa-plus"></i> </button>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn float-right mr-1 btn-sm btn-primary" type="submit">Update</button>
                                            <a href="{{ url()->previous() }}" class="btn float-right mr-1 btn-sm btn-warning" type="button">Cancel</a>
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
                function addQuestion() {

                    var totalQuiz = parseInt($('.count-me').length + 1);

                    $('#questions').append('<div class="count-me col-md-10 ' + totalQuiz +'">' +
                        '<label>Question</label>' +
                        '<input type="text" class="form-control" required name="quiz[]">' +
                        '</div>\n' +
                        '<div class="col-md-2 ' + totalQuiz +'">' +
                        '<label>Question Weight <span onclick="deleteQuiz('+totalQuiz+')"><i class="fas fa-minus-circle" style="color: red"></i></span></label>' +
                        '<input type="number" class="form-control" required name="weight[]">' +
                        '</div>');
                }

                function deleteQuiz(quiz) {
                    $('.'+quiz).remove();
                }


            </script>
@endsection