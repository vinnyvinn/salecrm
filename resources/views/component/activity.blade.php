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
                            <input type="hidden" id="related" name="related" value="{{ $related }}">
                            <input type="hidden" id="associate" name="associate" value="{{ $slot }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <select name="co_sellers[]" id="" class="form-control" multiple>
                            <option value="">Select User</option>
                            @foreach(\App\User::all() as $item)
                                <option value="{{ $item->id }}">{{ ucwords($item->name) }}</option>
                            @endforeach
                        </select>
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