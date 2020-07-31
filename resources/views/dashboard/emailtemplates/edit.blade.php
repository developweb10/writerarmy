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
                    <h3 class="box-title"> Edit Email Templates</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-12">
                        
                        
                            <div class="row">
                          <form method="post" action="{{ url('/updateTemplate') }}" enctype="multipart/form-data" class="form">
                      {!! csrf_field() !!}
                      <input type="hidden" name="id" value="{{$template->id}}"/>
                                <div class="form-group row">
                                    <label class="control-label col-md-4"> <h4><u>Title</u></h4></label>
                                    <div class="col-md-8">  {{ $template->name }}</div>
                                    </div>
                              
                                  <div class="form-group row">
                                        <label class="control-label col-md-4">Subject:</label>
                                       <div class="col-md-8">
                                       <input type="text"  class="form-control" name="subject" value="{{ $template->subject }}" />
                                    </div>
                                   </div>                      
                                   <div class="form-group row">
                                        <label class="control-label col-md-4">Description:</label>
                                       <div class="col-md-8">
                                       <textarea name="text" class="form-control" id="area1" cols="80" rows="10">{{ $template->text }}</textarea>
                                    </div>
                                   </div>
                                 <div class="form-group row">
                                  <div class="col-md-12">
                                  <div class="emailinfo alert alert-info"> 
								   <ul>
                                   <li> <b>For Comirmation Email:- </b></li> 
                                   <li>
								  <?php echo "Use {{token}} in place of confirmation link.";  ?>
                                  </li>
                                    <li><b> For New User and Welcome Email:-</b> </li>
                                     <li> <?php echo "Use {{username}} in place of user name";  ?></li>
                                     <li> <?php echo "Use {{useremail}} in place of user email";  ?></li>
                                      <li><b> For Order content Email:-</b> </li>
                                       <li> <?php echo "Use {{packagetitle}} in place of user name";  ?></li>
                                    
                                  </ul>
                                  </div>
                                  </div>
                                  
                                 </div>

                                <div class="col-md-12">
                                 
                                  {!! Form::submit('Update', ['class'=>'btn btn-success pull-right blue-main-btn']) !!}
                                </div>
                           </form>
                            </div> 
                      
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

						
@stop



