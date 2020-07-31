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
                    <h3 class="box-title"> Edit Package</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-12">
                        {!! Form::model($package,['method'=>'PUT','route'=>['package.update',$package->id], 'class' =>'form col-md-12']) !!}
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><u>Title</u> : {{ $package->title }}</h4>
                                    <br>
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label col-md-4"> Word Selection :</label>
                                    <div class="col-md-8">
                                        <input type="checkbox" name="word_selection[]" value="300">300 Words<br>
                                        <input type="checkbox" name="word_selection[]" value="400">400 Words<br>
                                        <input type="checkbox" name="word_selection[]" value="500">500 Words<br>
                                        <input type="checkbox" name="word_selection[]" value="600">600 Words<br>
                                        <input type="checkbox" name="word_selection[]" value="700">700 Words<br>
                                        <input type="checkbox" name="word_selection[]" value="800">800 Words<br>
                                        <input type="checkbox" name="word_selection[]" value="900">900 Words<br>
                                        <input type="checkbox" name="word_selection[]" value="1000">1000 Words<br>
                                        <input type="checkbox" name="word_selection[]" value="1200">1200 Words<br>
                                        <input type="checkbox" name="word_selection[]" value="1500">1500 Words<br>
                                        <input type="checkbox" name="word_selection[]" value="1700">1700 Words<br>
                                        <input type="checkbox" name="word_selection[]" value="2000">2000 Words<br>
                                        <input type="checkbox" name="word_selection[]" value="3000">3000 Words<br>
                                        <input type="checkbox" name="word_selection[]" value="4000">4000 Words<br>
                                        <input type="checkbox" name="word_selection[]" value="5000">5000 Words<br>
                                        <input type="checkbox" name="word_selection[]" value=" ">**Not Supported<br>
                                        <br>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label col-md-4"> Required Fields :</label>
                                    <div class="col-md-8">
                                        <input type="checkbox" name="additional_fields[]" value="type_style">Writing Style<br>
                                        <input type="checkbox" name="additional_fields[]" value="type_of_press_release">Type of Press Release<br>
                                        <input type="checkbox" name="additional_fields[]" value="quotes">Quotes to Include<br>
                                        <input type="checkbox" name="additional_fields[]" value="reference_url">Reference(URLs)<br>
                                        <input type="checkbox" name="additional_fields[]" value=" ">**Not Supported<br>
                                        <br>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    {!! Form::submit('Submit', ['class'=>'btn btn-success pull-right']) !!}
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



