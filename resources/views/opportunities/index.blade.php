@extends("layouts.app")
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">Opportunities</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('customer.index')}}">Opportunities</a></li>
                        <li class="breadcrumb-item">All Opportunities</li>
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
                                    <h5>All Opportunities</h5>
                                    <modal-trigger
                                        modal-name="opportunity-filter" inline-template>
                                        <button class="btn pull-right btn-xs btn-success" @click="showModal">Filter</button>
                                    </modal-trigger>
                                </div>
                                <div class="card-block">
                                    @if (count($opportunities) > 0)
                                        <table class="table table-sm" id="datatables">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Opportunity Value</th>
                                                    <th>Probability</th>
                                                    <th>Target Value</th>
                                                    <th>Deadline</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($opportunities as $key => $opportunity)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td><a href="{{  route('opportunities.show', $opportunity->id) }}">{{ $opportunity->title }}</a></td>
                                                    <td>{{ number_format($opportunity->opportunity_value) }}</td>
                                                    <td>{{ number_format($opportunity->probability) }}%</td>
                                                    <td>
                                                        {{ number_format($opportunity->target_value) }}
                                                    </td>
                                                    <td>
                                                        {{date('M j, Y',strtotime($opportunity->deadline))}}
                                                    </td>
                                                    <td align="right">
                                                        <modal-trigger
                                                                modal-name="status-picker"
                                                                :row-data="{{ json_encode($opportunity)}}"
                                                                inline-template>
                                                            <button class="btn btn-xs btn-primary" @click="showModal">change status</button>
                                                        </modal-trigger>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        @component('component.blank')
                                            No Customer Record
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
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#datatables').DataTable();
        });
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
@section('modals')
    <opportunity-filter
            post-url="{{ url('opportunities') }}"
            :statuses="{{ json_encode(config('sales-constants.prospect-statuses')) }}"></opportunity-filter>
    <status-picker
            post-url="{{ url('opportunity/status/set') }}"
            :statuses="{{ json_encode(config('sales-constants.prospect-statuses')) }}">
    </status-picker>
@endsection