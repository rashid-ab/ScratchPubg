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

                            All Events
                           

                            <div class="btn-holder" style="float: right;">

                           <!--  <a href="{{ url('newcustomer') }}"><button type="button" class="btn btn-danger">Add New</button></a> -->

                            </div>

                        </header>

                        <div class="panel-body">

                            <div class="adv-table">

                                <table  class="display table table-bordered table-striped">

                                    <thead>

                                    <tr>
                                        <th>Titleeeee</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Vanue</th>  
                                        <th>Created by</th>
                                        <th>Repoted by</th>
                                        <th>Repoted date</th>
                                        <th>Total Jonings</th>                                      
                                        <th>Actions</th>
                                    </tr>

                                    </thead>

                                    <tbody>
                                      
                                    @foreach ($events as $event)
                                    <tr>
                                        <td>{{ $event->title }}</td>
                                        <td>{{$event->name}}</td>
                                        <td>{{ $event->event_datetime }}</td>
                                        <td>{{ $event->venue }}</td>
                                        <td>{{$event->f_name}}</td>
                                        <td>&nbsp;&nbsp;</td>
                                        <td>&nbsp;&nbsp;</td>
                                        <td>{{$event->total_joins}}</td>
                                          <td>
                                            <div class="icon_wraper">                      
                                                <a href="{{url('get_eventdetails')}}/{{$event->event_id}}" class="user_details"><button>
                                                    <i class="fas fa-eye"></i>
                                                </button></a>
                                            </div>
                                        </td>
                                     
                                    </tr>

                                    @endforeach 

                                    </tbody>



                                </table>

                                 <?php echo $events->render(); ?>

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





