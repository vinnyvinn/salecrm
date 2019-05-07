@extends('layouts.app')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">Fill Lead Questionnaire</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('leads.index')}}">Leads</a></li>
                        <li class="breadcrumb-item"><a href="{{route('leads.view',$lead->id)}}">{{$lead->name}}</a></li>
                        <li class="breadcrumb-item">Fill Lead Questionnaire</li>
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
                                <form action="{{ url('store-lead/'.$lead->id.'/questionnaire') }}" method="post">
                                    {{csrf_field()}}
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Fill Questionnaire For {{ ucwords($lead->name) }}</h5>
                                        </div>
                                        <div class="card-block">
                                            <div class="form-group form-row">
                                                <div class="col-md-12">
                                                    <label>Select Questionnaire</label>
                                                    <select name="" id="" onchange="questionnaireSelected(this)" class="form-control">
                                                        <option value="">Select Questionnaire</option>
                                                        @foreach($questionnaires as $questionnaire)
                                                            <option value="{{ $questionnaire }}">{{ ucwords($questionnaire->title) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row" id="questions" style="margin-top: 8px !important;">
                                                        <div class="col-12 text-center">
                                                            @component('component.blank')
                                                                No Questionnaire Selected
                                                            @endcomponent
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="lead_id" value="{{ $lead->id }}">
                                                    <input type="hidden" id="questionnaire_id" name="questionnaire_id">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn float-right mr-1 btn-sm btn-primary" type="submit">Save</button>
                                            <button onclick="reload()" class="btn float-right mr-1 btn-sm btn-warning" type="button">Reset</button>
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
                function questionnaireSelected(questionnaire) {

                    var selectedQuestionnaire = JSON.parse($(questionnaire).val());

                    $('#questionnaire_id').val(selectedQuestionnaire.id);

                    var content = '';

                    var questions = JSON.parse(selectedQuestionnaire.questions);

                    $.each(questions, function (index, value) {
                        content = content + '<div class="col-7">' +
                            '<input type="hidden" name="question[]" value="'+value.question+'">' +
                            '<input type="hidden" name="weight[]" value="'+value.weight+'">' +
                            '<div class="form-group row">' +
                            '<label class="col-sm-12 col-form-label">'+value.question+'</label>' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-2">' +
                            '<div class="form-group row">' +
                            '<label class="col-sm-12 csol-form-label">Weight : '+value.weight+'</label>' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-3">' +
                            '<div class="form-group row">' +
                            '<label class="col-sm-6 col-form-label">Answer</label>' +
                            '<div class="col-sm-6">' +
                            '<input type="number" class="form-control" required max="'+parseInt(value.weight)+'" min="0" name="ans[]" id="ans" placeholder="Ans">' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    });

                    $('#questions').empty().append(content);

                }questionnaire_id

                function reload() {
                    window.location.reload()
                }
            </script>
@endsection
