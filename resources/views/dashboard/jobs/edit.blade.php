@extends('dashboard.master')

@section('content-header')
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> Job Details</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        {!! Form::model($job,['method'=>'PATCH','route'=>['jobs.update',$job->id], 'class' =>'form']) !!}
                        <div class="col-md-12">
                            <div class="row job-detail-list">
                                <div class="col-md-12">
                                    <h4 style="color: cornflowerblue"><u>Title</u> : {{ $job->packages->title }}</h4>
                                    
                                </div>

                                <div class="col-md-12">
                                    <p><u>Word Count</u> : {{ $job->total_words or 'N/A' }} words</p>
                                    
                                </div>

                                <div class="col-md-12">
                                    <p><u>Post Directly to My Account</u> : {{ $job->direct_posting or 'N/A' }}</p>
                                    
                                </div>

                                <div class="col-md-12">
                                    <p><u>Quantity</u> : {{ $job->quantity or 'N/A' }}</p>
                                    
                                </div>

                                <div class="col-md-12">
                                    <p><u>Topic</u> : {{ $job->topic or 'N/A' }}</p>
                                    
                                </div>

                                <div class="col-md-12">
                                    <p><u>Typing Style</u> : {{ $job->type_style or 'N/A' }}</p>
                                    
                                </div>

                                <div class="col-md-12">
                                    <p><u>Type of Press Release</u> : {{ $job->type_of_press_release or 'N/A' }}</p>
                                    
                                </div>

                                <div class="col-md-12">
                                    <p><u>Quotes to Include</u> : {{ $job->quotes or 'N/A' }}</p>
                                    
                                </div>

                                <div class="col-md-12">
                                    <p><u>Types of Posts</u> : {{ $job->types_of_posts or 'N/A' }}</p>
                                    
                                </div>

                                <div class="col-md-12">
                                    <p><u>Target Audience</u> : {{ $job->target_audience or 'N/A' }}</p>
                                    
                                </div>

                                <div class="col-md-12">
                                    <p><u>Reference(URLs)</u> : {{ $job->reference_url or 'N/A' }}</p>
                                    
                                </div>

                                <div class="col-md-12">
                                    <p><u>SEO Keywords</u> : {{ $job->seo_keywords or 'N/A' }}</p>
                                    
                                </div>

                                <div class="col-md-12">
                                    <p><u>Order Details</u> : {{ $job->order_details or 'N/A' }}</p>
                                    
                                </div>
                                
                                 @if($job->attachment != '')
                                   <div class="col-md-12">
                                   <?php $array = explode('/',$job->attachment); $key = count($array)-1;  ?>
                                        <p><u>Attachment</u> : <a href="{{ url($job->attachment)}}" download><?php echo $array[$key]; ?></a></p>
                                        
                                   </div>
                                   @endif

                               <!-- <div class="col-md-12">
                                    <p><u>Price</u> : {{ $job->price or 'N/A' }}</p>
                                    <br>
                                </div>-->


                                <div class="col-md-8 hidden">
                                    Order Id: {!! Form::number('order_id', $job->id,['class'=>'form-control']) !!}
                                </div>

                                <div class="col-md-8 hidden">
                                    Order Placed By :{!! Form::number('order_placed_by', $job->order_placed_by,['class'=>'form-control']) !!}
                                </div>


                                <div class="col-md-12">
                                    {!! Form::submit('Assign To Me', ['class'=>'btn btn-lg btn-success pull-right margint-20 blue-main-btn']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@stop



