@extends('layouts.app')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-review_type">
                        <h4 class="m-b-10">{{$lead->name}}</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('leads.index')}}">Leads</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::previous()}}">{{$lead->name}}</a></li>
                        <li class="breadcrumb-item">Review</li>
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
                            <form action="{{ route('reviews.store') }}" method="post">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Make Review</h5>
                                        {{--<a href="{{ URL::previous() }}" class="pull-right btn-primary btn mr-4 btn-xs" style="float:right">Back</a>--}}
                                    </div>
                                    <div class="card-block">

                                        {{  csrf_field() }}
                                        <div class="form-group mb-0 form-row">
                                            <div class="col-md-6">
                                                <label class="float-label d-block {{$errors->has('review_type') ?'has-error': ''}} ">  {{ $errors->has('review_type') ? $errors->first('review_type') : 'Review Type' }}</label>
                                                <div class="input-group-append">
                                                    <select name="review_type" class="form-control" required>
                                                        <option value="">Select Type</option>
                                                    @if(!$lead->reviews->where('review_type',config('sales-constants.legal'))->first() or !$lead->reviews->where('review_type',config('sales-constants.financial'))->first())
                                                    @if(!$lead->reviews->where('review_type',config('sales-constants.legal'))->first())
                                                        <option value="{{config('sales-constants.legal')}}">Legal</option>
                                                    @endif
                                                    @if(!$lead->reviews->where('review_type',config('sales-constants.financial'))->first())
                                                        <option value="{{config('sales-constants.financial')}}">Financial</option>
                                                    @endif
                                                @else
                                                        <option value="{{config('sales-constants.general')}}">General</option>
                                                @endif
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <label class="float-label d-block {{$errors->has('confirmed') ?'has-error': ''}} ">  {{ $errors->has('confirmed') ? $errors->first('confirmed') : 'Confirm' }}</label>
                                                <div class="input-group-append">
                                                    <select name="confirmed" class="form-control" required>
                                                        <option value="">Qualify</option>
                                                        <option value="1">Qualified</option>
                                                        <option value="0">Not Qualified</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="form-group mb-0 form-row">
                                            <div class="col-md-12">
                                                <label class="float-label d-block {{$errors->has('comment') ?'has-error': ''}} ">  {{ $errors->has('comment') ? $errors->first('comment') : 'Comment' }}</label>
                                                <textarea name="comment" id="comment" class="form-control" cols="30" rows="5" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input name="lead_id" type="hidden" value="{{$lead->id}}" required>
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