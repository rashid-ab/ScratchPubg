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

                            All Films

                            @if(Session::has('message'))

                                <div class="alert-box success">

                                    <h2>{{ Session::get('message') }}</h2>

                                </div>

                            @endif



                            <div class="btn-holder" style="float: right;">

                            <a href="{{ url('new_film') }}"><button type="button" class="btn btn-danger">Add Film</button></a>

                            </div>

                        </header>

              <div class="panel-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                <th>ID</th>
                <th>Film Title</th>
                <th>Genre</th>
                <th>Film Maker</th>
                <th>Film Maker Email</th>
                <th>Cover Image</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Trailer Link</th>
                <th>Film File Link</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($films as $film)

                <tr>
                  <td>{{ $film->id }}</td>
                  <td>{{ $film->film_title }}</td>
                  <td>{{ $film->category_name }}</td>
                  <td>{{ $film->film_maker }}</td>
                  <td>{{ $film->film_maker_email }}</td>

                  <td style="text-align:center"><img src="{{ $film->film_file }}" class="img-circle" style="width: 100px" /></td>

                  <td>{{ $film->film_description }}</td>
                  <td>{{ $film->film_duration }}</td>
                  <td>{{ $film->film_trailer_link }}</td>
                  <td>{{ $film->film_file_link }}</td>
                  <td style="text-align:center">
                            <div class="icon_wraper"> 
                                
                                <a href="{{url('/edit_film/'. $film->id )}}" data-toggle="tooltip" title="Edit Film"><button><i class="fa fa-pencil" aria-hidden="true"></i></button></a>

                                <a href="{{url('/delete_film/'. $film->id )}}" class="delete_user" data-toggle="tooltip" title="Delete Film"><button><i class="fas fa-trash"></i></button></a>
                              </div>
                            
                    </td>    
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
    $(function(){
        $(".user_details").click(function(){
            $.ajax({
                type: "GET",
                url: "{{url('get_details')}}/"+$(this).attr("id"),
                success: function(data) {
                    $(".media").html(data);
                  },error: function(data){

                  }
            });

        });
    });

</script>
@endsection





