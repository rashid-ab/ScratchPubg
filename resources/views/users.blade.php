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

                            All Users

                            @if(Session::has('message'))

                                <div class="alert-box success">

                                    <h2>{{ Session::get('message') }}</h2>

                                </div>

                            @endif



                            <div class="btn-holder" style="float: right;">

                           <!--  <a href="{{ url('newcustomer') }}"><button type="button" class="btn btn-danger">Add New</button></a> -->

                            </div>

                        </header>

              <div class="panel-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>PUBG ID</th>
                <th>Coins</th>
                <th>UC</th>
                <th>Redeem UC</th>
                <th>Current Status</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                  @foreach ($users as $user)
                    <tr>

                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->pubg_id }}</td>
                        <td>{{ $user->coins }}</td>
                        <td>{{ $user->uc }}</td>
                        <td class="redeem_uc{{ $user->id }}">{{ $user->redeem_uc }}</td>
                        <td class="status{{ $user->id }}">{{ $user->status }}</td>
                            {{--  @if($user->email!="2k9140@gmail.com")  --}}
                            <td><div class="btn-group">
                              <button type="button" id="redeem_button{{$user->id}}" onclick="redeem({{$user->id}},{{$user->redeem_uc}})" class="btn {{$user->status== "1" ? "btn-danger": "btn-success"}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{$user->status==1?"Action":"OK"}}
                              </button>
                              
                            </div

                         </td>
                         {{--  @endif  --}}
                    </tr>
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
    function redeem(id,uc){
      if($.trim($('#redeem_button'+id).text())!="OK"){
            $('#dynamic-table').DataTable().destroy();
            $.ajax({
                type: "POST",
                url: "{{url('redeem')}}",
                data:{id:id,uc:uc},
                success: function(data) {
                  if(data.message=="success"){
                    $('#redeem_button'+id).removeClass('btn btn-danger')
                    $('#redeem_button'+id).addClass('btn btn-success')
                    $('#redeem_button'+id).text('OK')
                    $('.redeem_uc'+id).text('0')
                    $('.status'+id).text('0')
                    $('#dynamic-table').DataTable({
                      order: [[6, 'desc']]
                      });
                  }
                  },error: function(data){

                  }
            });
          }
    };

</script>
@endsection





