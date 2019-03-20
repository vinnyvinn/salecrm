@extends('layouts.app')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">Add Customer</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('customer.index')}}">Customers</a></li>
                        <li class="breadcrumb-item">Add Customer</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>{{ $prospect->lead->name }}</h5>
                                    </div>
                                    <div class="card-block">

                                        <p class="">{{ $prospect->lead->description }}</p>
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table table-hover m-b-0 without-header">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="d-inline-block align-middle">

                                                                <div class="d-inline-block">
                                                                    <h6>job title/position</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td align="right">
                                                            <div class="d-inline-block align-middle">

                                                                <div class="d-inline-block">
                                                                    <p style="text-align: right;">{{ $prospect->lead->job_title }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-inline-block align-middle">

                                                                <div class="d-inline-block">
                                                                    <h6>Assigned to</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td align="right">
                                                            <div class="d-inline-block align-middle">

                                                                <div class="d-inline-block">
                                                                    <p style="text-align: right;">{{ $prospect->assignee->name }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer amount-close-card">
                                        <h5 class="sub-title">Prospect Progress <strong>{{ round(($prospect->stage/3)*100) }}%</strong></h5>
                                        <div class="progress ">
                                            <div class="progress-bar bg-c-blue" style="width:{{ ($prospect->stage/3)*100 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <form action="{{ route('customer.store', $prospect->id) }}" method="post">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Create Customer</h5>
                                        </div>
                                        <div class="card-block">
                                            {{  csrf_field() }}
                                            <input type="hidden" name="prospect_id" value="{{ $prospect->id }}" required>
                                            <div class="form-group form-row">
                                                <div class="col-md-6">
                                                    <label>Company</label>
                                                    <select name="company" id="company" class="form-control" required>
                                                        <option value="{{ $prospect->company ? $prospect->company->id:'' }}">{{ $prospect->company ? $prospect->company->name:'Select Company' }}</option>
                                                        <option value="">None</option>
                                                        @foreach ($companies as $company)
                                                            <option value="{{ $company->id }}" {{ old('company') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('company'))
                                                        <span class="text-danger form-text">{{ $errors->first('company') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Estimated value of customer</label>
                                                    <input class="form-control" min="0" type="number" name="estimated_value" id="estimated_value" value="{{old('estimated_value',$prospect->estimate_amount)}}" required>
                                                    @if ($errors->has('estimated_value'))
                                                        <span class="form-text text-danger">{{ $errors->first('estimated_value') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <div class="col-md-6">
                                                    <label>Deadline</label>
                                                    <input id="date" name="deadline" type="text" class="form-control datepicker" value="{{ old('deadline') }}" required placeholder="Deadline" readonly>
                                                    @if ($errors->has('deadline'))
                                                        <span class="text-danger form-text">{{ $errors->first('deadline') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Assigned to</label>
                                                    <select name="assigned_to" id="assigned_to" class="form-control" required>
                                                        <option value="{{$prospect->assignee?$prospect->assignee->id:''}}">{{$prospect->assignee?$prospect->assignee->name:'Select Assignee'}}</option>
                                                        @foreach ($system_users as $user)
                                                            <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id || $prospect->lead->assignee_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('assigned_to'))
                                                        <span class="text-danger form-text">{{ $errors->first('assigned_to') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Comments</label>
                                                <textarea name="comments" id="comments" cols="20" rows="5" class="form-control" required></textarea>
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