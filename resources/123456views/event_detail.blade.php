@extends('layouts.app')



@section('content')



<style type="text/css">

	

	.overlay{

    opacity:0.8;

    background-color:#ccc;

    position:fixed;

    width:100%;

    height:100%;

    top:0px;

    left:0px;

    z-index:1000;

    display: none;



}

.overlay img {

    position: relative;

    z-index: 99999;

    left: 48%;

    right: -40%;

    top: 40%;

    width: 5%;

}



</style>

    <section id="main-content">

        <section class="wrapper">

            <!-- page start-->

            <div class="row">

                <div class="col-sm-12">

                    <section class="panel">

                        <header class="panel-heading">

                            Event Detail
                           

                            <div class="btn-holder" style="float: right;">

                           <!--  <a href="{{ url('newcustomer') }}"><button type="button" class="btn btn-danger">Add New</button></a> -->

                            </div>

                        </header>

                        <div class="panel-body">

                            <div class="adv-table">

                                
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <span><b>Event Title:</b> {{ $event->title }}</span>
                                        </div>
                                        <div class="form-group">
                                            <span><b>Event Type:</b> {{ $event->name }}</span>
                                        </div>
                                        <div class="form-group">
                                            <span><b>Created at:</b> {{ $event->event_datetime }}</span>
                                        </div>
                                        <div class="form-group">
                                            <span><b>Created by:</b> {{ $event->f_name }} {{ $event->l_name }}</span>
                                        </div>

                                        
                                        <div class="form-group">
                                            <span><b>No of Comments:</b> {{ $count_event_comments->comment_counter }}</span>
                                        </div>
                                        <div class="form-group">
                                            <span><b>No of likes:</b> {{ $count_event_liked->liked_counter }}</span>
                                        </div><div class="form-group">
                                            <span><b>No of Attended:</b> {{ $count_event_planed->planed_counter }}</span>
                                        </div>
                                        
                                        <?php if($event->event_category == 1){ ?>
                                        <img src="{{$event->event_file}}" width="200" height="200">
                                        <?php }else{ ?>
                                        
                                        <video width="400" controls>
                                          <source src="{{$event->event_file}}" >
                                        </video>
                                        
                                        <?php } ?>
                                    </div>
                                    <div class="clearfix"></div>
                            </div>

                        </div>

                    </section>

                </div>

            </div>



            <!-- page end-->

        </section>

    </section>

    <!--dynamic table initialization -->    



    <div class="overlay"><img src="{{url('assets/img')}}/spiner.gif"></div>

<div class="modal fade" id="myModalview" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">User Information</h4>
        </div>
        <div class="modal-body">
        <!-- Left-aligned -->
        <div class="media">
          
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<script type="text/javascript">
    $(function(){
        $(".user_details").click(function(){
            $.ajax({
                type: "GET",
                url: "{{url('get_eventdetails')}}/"+$(this).attr("id"),                          
                success: function(data) {                    
                   $(".media").html(data);

                  },error: function(data){
                  
                  }
            });
          
        });
    });

</script>
@endsection





