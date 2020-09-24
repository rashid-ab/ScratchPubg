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

                                <table id="dynamic-table" class="display table table-bordered table-striped">

                                    <thead>

                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Vanue</th>  
                                        <th>Created by</th>
                                        <th>Reported by</th>
                                        <th>Report Type</th>
                                        <th>Reported date</th>

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
                                        <td>{{$event->creater_f_name}}</td>
                                        <td>{{$event->f_name}}</td>
                                        <td>{{$event->report_type}}</td>
                                        <td>{{$event->report_on}}</td>
                                        
                                        <td>{{$event->total_joins}}</td>
                                          <td>
                                            <div class="icon_wraper">
                                                <a id="{{$event->event_id}}" class="user_details" data-toggle="tooltip" 
                                                  title="Reply to Report">
                                                  <button data-toggle="modal" data-target="#myModalview">
                                                    <i class="fas fa-eye"></i>
                                                </button></a>
                                                <input type="hidden" class="email" 
                                                value="{{$event->reporter_email}}" >
                                            </div>
                                            
                                          <!--   <div class="icon_wraper">                      
                                              <button><i class="fas fa-eye"></i></button>
                                            </div> -->
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
<style>
.loader {
  border: 6px solid #f3f3f3;
  border-radius: 50%;
  border-top: 6px solid #3498db;
  width: 30px;
  height: 30px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
  margin: 2px 15px 0 0;
  display: none;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.btn-green{
    background: lightgreen;
    color: #fff;
}
</style>
<div class="modal fade" id="myModalview" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reply to Reporter</h4>
        </div>
        <div class="modal-body">
        <!-- Left-aligned -->
        <div class="media">
          <form>
              <textarea class="form-control" name="reply" id="reply"></textarea>
              <input type="hidden" id="receiver_email" name="receiver_email">
          </form>
        </div>
        </div>
        <div class="modal-footer">
            <div class="pull-right">
                <input class="btn btn-green" value="Reply the report" type="submit" id="send_mail">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            <div class="loader pull-right"></div>
        </div>
      </div>
      
    </div>
  </div>
<script type="text/javascript">
    $(function(){
        $(".user_details").click(function(){
            $("#receiver_email").val($(this).next('.email').val());
            // $.ajax({
            //     type: "GET",
            //     url: "{{url('get_eventdetails')}}/"+$(this).attr("id"),                          
            //     success: function(data) {                    
            //        $(".media").html(data);

            //       },error: function(data){
                  
            //       }
            // });
          
        });
        $("#send_mail").click(function(){
            $(".loader").css("display", "block");
            
            $.ajax({
                type: "GET",
                url: "{{url('send_mail')}}/"+$("#reply").val()+"/"+$("#receiver_email").val(),                          
                success: function(data) {                    
                   
                   $(".loader").css("display", "none");
                   alert(data);
                   $('#myModalview').modal('toggle');
                  },error: function(data){
                  
                  }
            });
            return false;
        });
    });

</script>
@endsection





