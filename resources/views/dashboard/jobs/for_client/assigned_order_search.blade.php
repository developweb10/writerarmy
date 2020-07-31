<div class="col-md-12">
    <div class="row">
        <div class="portlet-body form">
            {{ Form::open( array(
              'method' => 'POST',
              'class'=> 'form-horizontal',
              'role' => 'form',
              'url'=> 'assignedOrders'
              )
             ) }}

            <div class="form-body">
                <div class="col-md-8">
                    <label class="col-md-4" style="color: #2ca02c"> Search By Status :</label>
                    <div class="col-md-8">
                        <select class="form-control" name="status">
                            <option value="">Select</option>
                            {{--<option value="screening">Screening</option>--}}
                            <option value="writing">Writing</option>
                            <option value="draft_ready">Draft Ready</option>
                            <option value="revision">Revision</option>
                            <option value="final_ready">Final Ready</option>
                            <option value="order_accepted">Order Accepted</option>
                        </select>
                        <br>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="col-md-12">
                        <button class="btn btn-success pull-right" type="submit">Search</button>
                    </div>
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>
    <br>
</div>


@section('scripts')

@endsection