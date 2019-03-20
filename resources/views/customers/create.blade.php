@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('dashable/bower_components/jquery.steps/css/jquery.steps.css')}}">
    <link rel="stylesheet" href="{{asset('dashable/assets/css/pages.css')}}">
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
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>{{ $prospect->lead->name }}</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                <div class="col-md-12">
                                    <div id="wizard">
                                        <section>
                                            <form class="wizard-form" id="example-advanced-form" action="{{route('customer.store',$prospect->id)}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <h6> Bank Information </h6>
                                                {{--basic-forms--}}
                                                <fieldset>
                                                <div class="form-group form-row">
                                                    <div class="col-md-6">
                                                        <label for="userName-2" class="block">Bank Name *</label>
                                                        <input id="userName-2" name="bank_name" type="text" class="required form-control" value="{{old('bank_name')}}">
                                                        @if ($errors->has('bank_name'))
                                                            <span class="text-danger form-text">{{ $errors->first('bank_name') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="userName-2" class="block">Bank Address *</label>
                                                        <input id="userName-2" name="bank_address" type="text" class="required form-control" value="{{old('bank_address')}}">
                                                        @if ($errors->has('bank_address'))
                                                            <span class="text-danger form-text">{{ $errors->first('bank_address') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="userName-2" class="block">Telephone  *</label>
                                                        <input id="userName-2" name="bank_telephone" type="text" class="required form-control" value="{{old('bank_telephone')}}">
                                                        @if ($errors->has('bank_telephone'))
                                                            <span class="text-danger form-text">{{ $errors->first('bank_telephone') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="userName-2" class="block">Bank Branch *</label>
                                                        <input id="userName-2" name="bank_branch" type="text" class="required form-control" value="{{old('bank_branch')}}">
                                                        @if ($errors->has('bank_branch'))
                                                            <span class="text-danger form-text">{{ $errors->first('bank_branch') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="userName-2" class="block">Bank Code *</label>
                                                        <input id="userName-2" name="bank_code" type="text" class="required form-control" value="{{old('bank_code')}}">
                                                        @if ($errors->has('bank_code'))
                                                            <span class="text-danger form-text">{{ $errors->first('bank_code') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="userName-2" class="block">Swiftcode *</label>
                                                        <input id="userName-2" name="swiftcode" type="text" class="required form-control" value="{{old('swiftcode')}}">
                                                        @if ($errors->has('swiftcode'))
                                                            <span class="text-danger form-text">{{ $errors->first('swiftcode') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="userName-2" class="block">Bank Account No *</label>
                                                        <input id="userName-2" name="bank_account_no" type="text" class="required form-control" value="{{old('bank_account_no')}}">
                                                        @if ($errors->has('bank_account_no'))
                                                            <span class="text-danger form-text">{{ $errors->first('bank_account_no') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="userName-2" class="block">Payment Date *</label>
                                                        <input id="date" name="payment_date" type="date" class="required datepicker form-control" value="{{old('payment_date')}}" >
                                                        @if ($errors->has('payment_date'))
                                                            <span class="text-danger form-text">{{ $errors->first('payment_date') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="userName-2" class="block">Payment Mode *</label>
                                                        <select id="date" name="payment_mode[]" t class="required form-control"multiple >
                                                            <option value="">Select Method</option>
                                                            <option>EFT</option>
                                                            <option>RTDS</option>
                                                            <option>Bankers Cheque</option>
                                                            <option>Direct Deposit</option>
                                                        </select>
                                                        @if ($errors->has('payment_mode'))
                                                            <span class="text-danger form-text">{{ $errors->first('payment_mode') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="userName-2" class="block"> Currency *</label>
                                                        <Select id="date" name="currency" class="required form-control" >
                                                            <option value="">Select Currency</option>
                                                            <option>KSH</option>
                                                            <option>USD</option>
                                                        </Select>
                                                        @if ($errors->has('currency'))
                                                            <span class="text-danger form-text">{{ $errors->first('currency') }}</span>
                                                        @endif
                                                        <br>
                                                    </div>
                                                    <hr>
                                                    <div class="col-md-6">
                                                    </div>
                                                    <h5>Customer Assigned To</h5>
                                                    <div class="col-md-6">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Assigned to</label>
                                                        <select name="assigned_to" id="assigned_to" class="form-control" required>
                                                            <option value="{{$prospect->assignee?$prospect->assignee->id:''}}">{{$prospect->assignee?$prospect->assignee->name:'Select Assignee'}}</option>
                                                            @foreach ($system_users as $user)
                                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('assigned_to'))
                                                            <span class="text-danger form-text">{{ $errors->first('assigned_to') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                </fieldset>
                                                <h3> Business References </h3>
                                                <fieldset>
                                                <div class="form-group form-row">
                                                <div class="col-md-6">
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Company Name *</label>
                                                        <input id="date" name="co_name_1" type="text" class="required form-control" value="{{old('co_name_1')}}" >
                                                        @if ($errors->has('co_name_1'))
                                                            <span class="text-danger form-text">{{ $errors->first('co_name_1') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Contact Name *</label>
                                                        <input id="date" name="co_contact_name_1" type="text" class="required form-control" value="{{old('co_contact_name_1')}}" >
                                                        @if ($errors->has('co_contact_name_1'))
                                                            <span class="text-danger form-text">{{ $errors->first('co_contact_name_1') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Address *</label>
                                                        <input id="date" name="co_address_1" type="text" class="required form-control" value="{{old('co_address_1')}}" >
                                                        @if ($errors->has('co_address_1'))
                                                            <span class="text-danger form-text">{{ $errors->first('co_address_1') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> City *</label>
                                                        <input id="date" name="co_city_1" type="text" class="required form-control" value="{{old('co_city_1')}}" >
                                                        @if ($errors->has('co_city_1'))
                                                            <span class="text-danger form-text">{{ $errors->first('co_city_1') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Postcode *</label>
                                                        <input id="date" name="co_postcode_1" type="text" class="required form-control" value="{{old('co_postcode_1')}}" >
                                                        @if ($errors->has('co_postcode_1'))
                                                            <span class="text-danger form-text">{{ $errors->first('co_postcode_1') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Phone *</label>
                                                        <input id="date" name="co_phone_1" type="text" class="required form-control" value="{{old('co_phone_1')}}" >
                                                        @if ($errors->has('co_phone_1'))
                                                            <span class="text-danger form-text">{{ $errors->first('co_phone_1') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Email *</label>
                                                        <input id="date" name="co_email_1" type="email" class="required form-control" value="{{old('co_email_1')}}" >
                                                        @if ($errors->has('co_email_1'))
                                                            <span class="text-danger form-text">{{ $errors->first('co_email_1') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Comment *</label>
                                                        <textarea id="date" name="co_comment_1" type="text" class="required form-control" value="{{old('co_comment_1')}}" >{{old('co_comment_1')}}</textarea>
                                                        @if ($errors->has('co_comment_1'))
                                                            <span class="text-danger form-text">{{ $errors->first('co_comment_1') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Company Name </label>
                                                        <input id="date" name="co_name_2" type="text" class=" form-control" value="{{old('co_name_2')}}" >
                                                        @if ($errors->has('co_name_2'))
                                                            <span class="text-danger form-text">{{ $errors->first('co_name_2') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Contact Name </label>
                                                        <input id="date" name="co_contact_name_2" type="text" class=" form-control" value="{{old('co_contact_name_2')}}" >
                                                        @if ($errors->has('co_contact_name_2'))
                                                            <span class="text-danger form-text">{{ $errors->first('co_contact_name_2') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Address </label>
                                                        <input id="date" name="co_address_2" type="text" class=" form-control" value="{{old('co_address_2')}}" >
                                                        @if ($errors->has('co_address_2'))
                                                            <span class="text-danger form-text">{{ $errors->first('co_address_2') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> City </label>
                                                        <input id="date" name="co_city_2" type="text" class=" form-control" value="{{old('co_city_2')}}" >
                                                        @if ($errors->has('co_city_2'))
                                                            <span class="text-danger form-text">{{ $errors->first('co_city_2') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Postcode </label>
                                                        <input id="date" name="co_postcode_2" type="text" class=" form-control" value="{{old('co_postcode_2')}}" >
                                                        @if ($errors->has('co_postcode_2'))
                                                            <span class="text-danger form-text">{{ $errors->first('co_postcode_2') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Phone </label>
                                                        <input id="date" name="co_phone_2" type="text" class=" form-control" value="{{old('co_phone_2')}}" >
                                                        @if ($errors->has('co_phone_2'))
                                                            <span class="text-danger form-text">{{ $errors->first('co_phone_2') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Email </label>
                                                        <input id="date" name="co_email_2" type="email" class=" form-control" value="{{old('co_email_2')}}" >
                                                        @if ($errors->has('co_email_2'))
                                                            <span class="text-danger form-text">{{ $errors->first('co_email_2') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Comment </label>
                                                        <textarea id="date" name="co_comment_2" type="text" class=" form-control" value="{{old('co_comment_2')}}" >{{old('co_comment_2')}}</textarea>
                                                        @if ($errors->has('co_comment_2'))
                                                            <span class="text-danger form-text">{{ $errors->first('co_comment_2') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                </div>
                                                </fieldset>
                                                <h3> Agreement </h3>
                                                <fieldset>
                                                <div class="form-group form-row">
                                                    {{--<div class="col-md-12">--}}
                                                        {{--<ol class="border-info">--}}
                                                            {{--<li>Any claims arising from invoices must be made within Three (3) working days on receipt of invoice.</li>--}}
                                                            {{--<li>By submiting this application, you authorize Express Shipping and Logistics EAbLTD to make inquiries into the banking and business/ trade references that you have supplied.</li>--}}
                                                            {{--<li>Trading Terms and Conditions apply as per applicable contracts of engagement.</li>--}}
                                                        {{--</ol>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-md-12">--}}
                                                        {{--<div class="custom-control custom-checkbox">--}}
                                                            {{--<input type="checkbox" class="custom-control-input form-control required" id="checkbox-signin" name="terms">--}}
                                                            {{--<label class="custom-control-label" for="checkbox-signin"> Accept the Terms and Conditions</label>--}}
                                                            {{--@if ($errors->has('terms'))--}}
                                                                {{--<span class="text-danger form-text">{{ $errors->first('terms') }}</span>--}}
                                                            {{--@endif--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}

                                                    <div class="col-md-12">
                                                        <h5>Upload A Copy of</h5><br>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="userName-2" class="block"> PIN Certificate </label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input id="date" name="pin_cert" type="file" class="required form-control" value="{{old('pin_cert')}}" >
                                                        @if ($errors->has('pin_cert'))
                                                            <span class="text-danger form-text">{{ $errors->first('pin_cert') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="userName-2" class="block"> VAT Certificate </label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input id="date" name="vat_cert" type="file" class="required form-control" value="{{old('vat_cert')}}" >
                                                        @if ($errors->has('vat_cert'))
                                                            <span class="text-danger form-text">{{ $errors->first('vat_cert') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="userName-2" class="block"> Company Registration Certificate </label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input id="date" name="co_reg_cert" type="file" class="required form-control" value="{{old('co_reg_cert')}}" >
                                                        @if ($errors->has('co_reg_cert'))
                                                            <span class="text-danger form-text">{{ $errors->first('co_reg_cert') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="userName-2" class="block"> ID of Representative(s)  </label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input id="date" name="rep_id_file" type="file" class="required form-control" value="{{old('rep_id_file')}}" >
                                                        @if ($errors->has('rep_id_file'))
                                                            <span class="text-danger form-text">{{ $errors->first('rep_id_file') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="userName-2" class="block"> List of Directors (CR 12 Form) </label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input id="date" name="directors_list" type="file" class="required form-control" value="{{old('directors_list')}}" >
                                                        @if ($errors->has('directors_list'))
                                                            <span class="text-danger form-text">{{ $errors->first('directors_list') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="userName-2" class="block"> Office utility_bill Location - Utility Bill </label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input id="date" name="utility_bill" type="file" class="required form-control" value="{{old('utility_bill')}}" >
                                                        @if ($errors->has('utility_bill'))
                                                            <span class="text-danger form-text">{{ $errors->first('utility_bill') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                </fieldset>
                                                <h3> Financial Information </h3>
                                                <fieldset>
                                                <div class="form-group form-row">
                                                <div class="col-md-6">
                                                    <div class="col-md-12">
                                                        <h5> Finacial Year 1 (Last 1 Year) </h5>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Annual Turnover *</label>
                                                        <input id="datee" name="total_turnover_1" type="text" class="required form-control" value="{{old('total_turnover_1')}}" >
                                                        @if ($errors->has('total_turnover_1'))
                                                            <span class="text-danger form-text">{{ $errors->first('total_turnover_1') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Total Assets *</label>
                                                        <input id="datee" name="total_assets_1" type="text" class="required form-control" value="{{old('total_assets_1')}}" >
                                                        @if ($errors->has('total_assets_1'))
                                                            <span class="text-danger form-text">{{ $errors->first('total_assets_1') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Current Assets *</label>
                                                        <input id="datee" name="current_assets_1" type="text" class="required form-control" value="{{old('current_assets_1')}}" >
                                                        @if ($errors->has('current_assets_1'))
                                                            <span class="text-danger form-text">{{ $errors->first('current_assets_1') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Total Liabilities *</label>
                                                        <input id="datee" name="total_liabilities_1" type="text" class="required form-control" value="{{old('total_liabilities_1')}}" >
                                                        @if ($errors->has('total_liabilities_1'))
                                                            <span class="text-danger form-text">{{ $errors->first('total_liabilities_1') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Current Liabilities *</label>
                                                        <input id="datee" name="current_liabilities_1" type="text" class="required form-control" value="{{old('current_liabilities_1')}}" >
                                                        @if ($errors->has('current_liabilities_1'))
                                                            <span class="text-danger form-text">{{ $errors->first('current_liabilities_1') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Profits before Taxes *</label>
                                                        <input id="datee" name="profit_before_taxes_1" type="text" class="required form-control" value="{{old('profit_before_taxes_1')}}" >
                                                        @if ($errors->has('profit_before_taxes_1'))
                                                            <span class="text-danger form-text">{{ $errors->first('profit_before_taxes_1') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Profits after Taxes *</label>
                                                        <input id="datee" name="profit_after_taxes_1" type="text" class="required form-control" value="{{old('profit_after_taxes_1')}}" >
                                                        @if ($errors->has('profit_after_taxes_1'))
                                                            <span class="text-danger form-text">{{ $errors->first('profit_after_taxes_1') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="col-md-12">
                                                        <h5> Finacial Year 2 (Last 2 Years) </h5>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Annual Turnover *</label>
                                                        <input id="datee" name="total_turnover_2" type="text" class=" form-control" value="{{old('total_turnover_2')}}" >
                                                        @if ($errors->has('total_turnover_2'))
                                                            <span class="text-danger form-text">{{ $errors->first('total_turnover_2') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Total Assets *</label>
                                                        <input id="datee" name="total_assets_2" type="text" class=" form-control" value="{{old('total_assets_2')}}" >
                                                        @if ($errors->has('total_assets_2'))
                                                            <span class="text-danger form-text">{{ $errors->first('total_assets_2') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Current Assets *</label>
                                                        <input id="datee" name="current_assets_2" type="text" class=" form-control" value="{{old('current_assets_2')}}" >
                                                        @if ($errors->has('current_assets_2'))
                                                            <span class="text-danger form-text">{{ $errors->first('current_assets_2') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Total Liabilities *</label>
                                                        <input id="datee" name="total_liabilities_2" type="text" class=" form-control" value="{{old('total_liabilities_2')}}" >
                                                        @if ($errors->has('total_liabilities_2'))
                                                            <span class="text-danger form-text">{{ $errors->first('total_liabilities_2') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Current Liabilities *</label>
                                                        <input id="datee" name="current_liabilities_2" type="text" class=" form-control" value="{{old('current_liabilities_2')}}" >
                                                        @if ($errors->has('current_liabilities_2'))
                                                            <span class="text-danger form-text">{{ $errors->first('current_liabilities_2') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Profits before Taxes *</label>
                                                        <input id="datee" name="profit_before_taxes_2" type="text" class=" form-control" value="{{old('profit_before_taxes_2')}}" >
                                                        @if ($errors->has('profit_before_taxes_2'))
                                                            <span class="text-danger form-text">{{ $errors->first('profit_before_taxes_2') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="userName-2" class="block"> Profits after Taxes *</label>
                                                        <input id="datee" name="profit_after_taxes_2" type="text" class=" form-control" value="{{old('profit_after_taxes_2')}}" >
                                                        @if ($errors->has('profit_after_taxes_2'))
                                                            <span class="text-danger form-text">{{ $errors->first('profit_after_taxes_2') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                </div>
                                                </fieldset>
                                                <h3>Customer Checklist</h3>
                                                <fieldset>
                                                    <div class="form-group form-row">
                                                        <div class="col-md-6">
                                                            <label for="userName-2" class="block">Service Agreement Contract *</label>
                                                            <input id="date" name="service_agreement" type="file" class="required form-control" value="{{old('service_agreement')}}" >
                                                            @if ($errors->has('service_agreement'))
                                                                <span class="text-danger form-text">{{ $errors->first('service_agreement') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="userName-2" class="block">Service Level Agreement  *</label>
                                                            <input id="date" name="service_level" type="file" class="required form-control" value="{{old('service_level')}}" >
                                                            @if ($errors->has('service_level'))
                                                                <span class="text-danger form-text">{{ $errors->first('service_level') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="userName-2" class="block">Competitors - Share Of Wallet (SOW) *</label>
                                                            <input id="userName-2" name="share_of_wallet" type="text" class="required form-control" value="{{old('share_of_wallet')}}">
                                                            @if ($errors->has('share_of_wallet'))
                                                                <span class="text-danger form-text">{{ $errors->first('share_of_wallet') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="userName-2" class="block">Relationship Contact Level *</label>
                                                            <select id="date" name="payment_mode[]" t class="required form-control" >
                                                                <option value="">Select Relationship Contact Level</option>
                                                                <option>Knows Account Manager Only 0-1 yr
                                                                </option>
                                                                <option>Account Manager, S&M Manager, Finance Manager 1-2 yrs
                                                                </option>
                                                                <option>Account Manager, S&M Manager, Finance Manager, Operations Manager
                                                                 2-3 yrs</option>
                                                                <option>Account Manager, S&M Manager, Finance Manager, Operations Manager and MD
                                                                 3-5 yrs</option>
                                                                <option>Account Manager, S&M Manager, Finance Manager, Operations Manager, MD and Director
                                                                 5 yrs+</option>
                                                            </select>
                                                            @if ($errors->has('bank_code'))
                                                                <span class="text-danger form-text">{{ $errors->first('bank_code') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="userName-2" class="block">Bank Branch *</label>
                                                            <input id="userName-2" name="bank_branch" type="text" class="required form-control" value="{{old('bank_branch')}}">
                                                            @if ($errors->has('bank_branch'))
                                                                <span class="text-danger form-text">{{ $errors->first('bank_branch') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="userName-2" class="block">Swiftcode *</label>
                                                            <input id="userName-2" name="swiftcode" type="text" class="required form-control" value="{{old('swiftcode')}}">
                                                            @if ($errors->has('swiftcode'))
                                                                <span class="text-danger form-text">{{ $errors->first('swiftcode') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="userName-2" class="block">Bank Account No *</label>
                                                            <input id="userName-2" name="bank_account_no" type="text" class="required form-control" value="{{old('bank_account_no')}}">
                                                            @if ($errors->has('bank_account_no'))
                                                                <span class="text-danger form-text">{{ $errors->first('bank_account_no') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="userName-2" class="block">Payment Date *</label>
                                                            <input id="date" name="payment_date" type="date" class="required datepicker form-control" value="{{old('payment_date')}}" >
                                                            @if ($errors->has('payment_date'))
                                                                <span class="text-danger form-text">{{ $errors->first('payment_date') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="userName-2" class="block">Payment Mode *</label>
                                                            <select id="date" name="payment_mode[]" t class="required form-control"multiple >
                                                                <option value="">Select Method</option>
                                                                <option>EFT</option>
                                                                <option>RTDS</option>
                                                                <option>Bankers Cheque</option>
                                                                <option>Direct Deposit</option>
                                                            </select>
                                                            @if ($errors->has('payment_mode'))
                                                                <span class="text-danger form-text">{{ $errors->first('payment_mode') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="userName-2" class="block"> Currency *</label>
                                                            <Select id="date" name="currency" class="required form-control" >
                                                                <option value="">Select Currency</option>
                                                                <option>KSH</option>
                                                                <option>USD</option>
                                                            </Select>
                                                            @if ($errors->has('currency'))
                                                                <span class="text-danger form-text">{{ $errors->first('currency') }}</span>
                                                            @endif
                                                            <br>
                                                        </div>
                                                        <hr>
                                                        <div class="col-md-6">
                                                        </div>
                                                        <h5>Customer Assigned To</h5>
                                                        <div class="col-md-6">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Assigned to</label>
                                                            <select name="assigned_to" id="assigned_to" class="form-control" required>
                                                                <option value="{{$prospect->assignee?$prospect->assignee->id:''}}">{{$prospect->assignee?$prospect->assignee->name:'Select Assignee'}}</option>
                                                                @foreach ($system_users as $user)
                                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('assigned_to'))
                                                                <span class="text-danger form-text">{{ $errors->first('assigned_to') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </section>
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
        </div>
@endsection
@section('js')
    <script type="text/javascript" src="{{asset('dashable/bower_components/jquery.steps/js/jquery.steps.js')}}"></script>
    <script type="text/javascript" src="{{asset('dashable/bower_components/jquery-validation/js/jquery.validate.js')}}"></script>
    <script type="text/javascript" src="{{asset('dashable/assets/pages/form-validation/validate.js')}}"></script>
    <script type="text/javascript" src="{{asset('dashable/assets/pages/forms-wizard-validation/form-wizard.js')}}"></script>
    @endsection