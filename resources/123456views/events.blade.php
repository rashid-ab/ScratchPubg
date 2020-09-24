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
.custom_tabs a {
    display: inline-block;
    padding: 4px 11px;
    border: solid 1px;
}

.custom_tabs {
    display: inline-block;
}


</style>

   <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                <div class="col-sm-12">
              <section class="panel">
            
             <header class="panel-heading">

                            All Users

                            @if(Session::has('message'))

                                <div class="alert-box success">

                                    <h2>{{ Session::get('message') }}</h2>

                                </div>

                            @endif

                            @if (session('alert'))
                                <div class="alert alert-success">
                                    {{ session('alert') }}
                                </div>
                            @endif

                           

                            <div class="btn-holder" style="float: right;">

                           <!--  <a href="{{ url('newcustomer') }}"><button type="button" class="btn btn-danger">Add New</button></a> -->

                            </div>

                        </header>

               

              <div class="panel-body">
              <div class="adv-table">
              <div class="custom_tabs">
                 <a href="{{url('manage_events')}}/{{1}}" >Image</a>
                <a href="{{url('manage_events')}}/{{2}}" >Video</a>
              </div>
              <table class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
                <th>Sr</th>
                <th>Title</th>
                <th>Type</th>
                <th>Date</th>
                <th>Created by</th>
                <th>Actions</th>
              </thead>
              <tbody>
                  <?php $i = 1; ?>
                  @foreach ($events as $event)
                <tr>
                    <td><?php echo $i; ?></td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->event_datetime }}</td>
                    <td>{{ $event->f_name }} {{ $event->l_name }}</td>
                      <td>
                        <div class="icon_wraper"> 

                            <a href="{{url('get_eventdetails')}}/{{$event->event_id}}" class="user_details" data-toggle="tooltip" title="Event Detail"><button>
                                <i class="fas fa-eye"></i>
                            </button></a>
                            <a id="" href="{{url('delete_event')}}/{{$event->event_id}}" class="deleleEvent" class="delete_user" data-toggle="tooltip" title="Delete Event">
                              <button>
                              <i class="fas fa-trash"></i></button></a>


                        </div>
                    </td>
                 
                </tr>
<?php $i++; ?>
                @endforeach 
              
              </tbody>
              </table>
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

    $(function(){
         $(".deleleEvent").click(function(){
            return confirm("Do you want to delete this ?");
        });
    });



        
    

</script>
@endsection