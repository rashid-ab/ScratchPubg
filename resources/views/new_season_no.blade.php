@extends('layouts.app')
@section('content')
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
                        
                        
                        
                        Add Season No
                        <div class="btn-holder" style="float: right;">
                            <!--  <a href="{{ url('newcustomer') }}"><button type="button" class="btn btn-danger">Add New</button></a> -->
                        </div>
                    </header>
                    <div class="panel-body">
                        <!--         <form role="form"> -->
                        <form role="form" method="post"
                            class="add_word" enctype="multipart/form-data" action="{{ url('/') }}/new_season_no">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                           
                                    <div class="form-group">
                                        <label>Season</label>
                                        <select class="form-control"
                                        name="season_id" required >
                                            <option >Select</option>
                                            @foreach ($seasons as $season)
                                                <option value="{{ $season->id }}">{{$season->season_name }}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                
                                    <div class="form-group">
                                        <label>Season No</label>
                                        <input type="text" class="form-control" name="season_no" placeholder="Season No" />
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