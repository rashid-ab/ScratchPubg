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
<section id="main-content" >
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-4" >
            </div>
            <div class="col-sm-4" >
                <section class="panel" style="width:674px;margin-left: -77px;">
                    <header class="panel-heading">

                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                        @endif
                        
                        @if(Session::has('Duplicate_email'))
                        <div class="alert alert-danger">
                            {{ Session::get('Duplicate_email') }}
                        </div>
                        @endif
                        
                        
                        
                        Add Season Episode
                        <div class="btn-holder" style="float: right;">
                            <!--  <a href="{{ url('newcustomer') }}"><button type="button" class="btn btn-danger">Add New</button></a> -->
                        </div>
                    </header>
                    <div class="panel-body">
                        <!--         <form role="form"> -->
                        <form role="form" method="post" action="{{url('add_season_episode')}}" 
                            class="add_word" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control"
                                        name="episode_title" placeholder="Title" required >
                                    </div>
                                    <div class="form-group">
                                        <label>Season</label>
                                        <select class="form-control"
                                        name="season_id" placeholder="Season Name" required >
                                            <option >Select</option>
                                            @foreach ($seasons as $season)
                                                <option value="{{ $season->id }}">{{$season->season_name }}</option>    
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label> Season No </label>
                                        <select class="form-control"
                                        name="season_no_s" placeholder="Season No" required >
                                            <option >Select</option>
                                            @foreach ($season_nos as $season_no)
                                                <option value="{{ $season_no->id }}">{{$season_no->season_no }}</option>    
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label>Duration</label>
                                        <select class="form-control" name="episode_duration" required >
                                            <option>Select</option>
                                            @for($i=0; $i<=350; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea type="text" class="form-control"
                                        name="episode_description" placeholder="Description" rows="3" style="height:150px;" required ></textarea>
                                    </div>
                                   
                                     <div class="form-group">
                                        <label>Trailer Link</label>
                                        <input type="text" class="form-control"
                                        name="episode_link_trailor" placeholder="Trailor Link" required >
                                    </div>
                                    <div class="form-group">
                                        <label>Episode Link</label>
                                        <input type="text" class="form-control"
                                        name="episode_link" placeholder="Episode Link" required >
                                    </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success " style="float: right;margin-right: 14px;">Save</button>
                                </div>
                            </div>
                           </form>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>
@endsection