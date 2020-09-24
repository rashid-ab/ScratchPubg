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

                            All Season Numbers

                            @if(Session::has('delete'))

                                <div class="alert alert-danger danger">

                                   {{ Session::get('delete') }}

                                </div>

                            @endif
                             @if(Session::has('update'))

                                <div class="alert alert-success success">

                                   {{ Session::get('update') }}

                                </div>

                            @endif
                            <div class="btn-holder" style="float: right;">

                            <a href="{{ url('new_season_no') }}"><button type="button" class="btn btn-danger">Add Season No</button></a>

                            </div>

                        </header>
                    
              <div class="panel-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                <th style="text-align:center">ID</th>
                <th style="text-align:center">Season</th>
                <th style="text-align:center">Season No</th>
                <th style="text-align:center">Actions</th>
              </tr>
              </thead>
              <tbody>
                @foreach($season_nos as $season_no)

                  <tr>
                    <td style="text-align:center">{{$season_no->id}}</td>
                    <td style="text-align:center">{{$season_no->season->season_name}}</td>
                    <td style="text-align:center">{{$season_no->season_no}}</td>
                    <td style="text-align:center">
                      <div class="icon_wraper">
                          
                          
                          <a href="{{url('/edit_season_no/'.$season_no->id)}}" data-toggle="tooltip" title="Edit Season No"><button><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                           <a href="{{url('/delete_season_no/'.$season_no->id)}}" class="delete_user" data-toggle="tooltip" title="Delete Season No"><button><i class="fas fa-trash"></i></button></a>
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
@endsection





