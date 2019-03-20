<div class="modal fade" id="default-Modal{{$review->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ucwords($review->review_type)}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Comment:</h6>
                <p class="m-b-0"> {{$review->comment}}</p>
                <br>
                <h6>Status Confirmation:
                    <button class="btn {{$review->confirmed == true ?'btn-success':'btn-danger'}} waves-effect waves-light btn-xs"><i class="fa {{$review->confirmed == true ?'fa-check':'fa-times'}}"></i> </button></h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                @if($lead->stage != config('sales-constants.post-lead'))
                    <a href="{{route('reviews.edit',$review->id)}}" class="btn btn-warning waves-effect waves-light ">Edit Review</a>
                @endif
            </div>
        </div>
    </div>
</div>