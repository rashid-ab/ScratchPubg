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
                        
                        
                        
                        Edit Season
                        <div class="btn-holder" style="float: right;">
                            <!--  <a href="{{ url('newcustomer') }}"><button type="button" class="btn btn-danger">Add New</button></a> -->
                        </div>
                    </header>
                    <div class="panel-body">
                        <!--         <form role="form"> -->
                        <form role="form"  action="{{ url('update_season') }}" method="post"
                            class="add_word" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $season->id }}">
                            
                           
                                   <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control"
                                        name="season_name" placeholder="Name" value="{{ $season->season_name }}" required >
                                    </div>
                                    <div class="form-group">
                                        <label>Maker Name</label>
                                        <input type="text" class="form-control"
                                        name="maker_name" placeholder="Maker Name" value="{{ $season->maker_name }}" required >
                                    </div>
                                    <div class="form-group">
                                        <label>Maker Email</label>
                                        <input type="text" class="form-control"
                                        name="maker_email" placeholder="Name" value="{{ $season->maker_email }}" required >
                                    </div>

                                    <div class="form-group">
                                        <label>Genre Name</label>
                                        <select class="form-control"
                                        name="category_id" placeholder="Category Name" required >
                                        <option value="{{ $categorys->id }}">{{ $categorys->category_name }}</option>
                                        @foreach ($categories as $category)
                                        @if($category->category_name != $categorys->category_name)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endif
                                        @endforeach
                                        </select>
                                    </div>
                                
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea type="text" class="form-control"
                                        name="description" placeholder="Description" rows="3" style="height:150px;" value="" required >
                                        {{ $season->description }}
                                        </textarea>
                                    </div>
                               
                                    <div class="form-group">
                                        <label>Image</label>
                                        <img src="{{ $season->image }}" style="width:100px" />
                                        <input type="file" class="form-control email_verify"
                                        name="image" placeholder="Image"  >
                                    </div>
                                    <div class="form-group">
                                        <label>Trailor Link</label>
                                        <input type="text" class="form-control email_verify"
                                        name="trailer_link" value="{{$season->trailer_link}}" placeholder="Trailor Link"  >
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
$('.fa').click(function(){
$('.related_row').append(
'<div class="row relate_row" style="width: 800px;">'+
    
    '<div class="col-sm-3">'+
        '<div class="form-group">'+
            '<label>Word in English</label>'+
            '<input type="text" class="form-control"'+
            'name="related_word_in_english[]"  >'+
        '</div>'+
    '</div>'+
    '<div class="col-sm-3">'+
        '<div class="form-group">'+
            '<label>Word in Arabic</label>'+
            '<input type="text" class="form-control"'+
            'name="related_word_in_arabic[]"  >'+
        '</div>'+
    '</div>'+
    '<div class="col-sm-3">'+
        '<div class="form-group">'+
            '<label>Sentence</label>'+
            '<input type="text" class="form-control email_verify"'+
            'name="related_sentence[]"  >'+
        '</div>'+
        
    '</div>'+
    '<div class="col-sm-3" style="width: 11%;margin: 0px;padding: 0px;">'+
        '<div class="form-group">'+
            '<label style="visibility: hidden;width: 67px">Sentence</label>'+
            '<i class="far fa-trash-alt text-danger" style="font-size: 25px;margin-left:5px;">'+
            '</i>'+
        '</div>'+
    '</div>'+
'</div>'
);
$('.far').click(function(){
// return alert('asd');
var rows = $('.relate_row').length;
if(rows==1){
return alert(rows);
}
$(this).parents('.relate_row').remove().hide(500);
});
});
$('.far').click(function(){
// return alert('asd');
var rows = $('.relate_row').length;
if(rows==1){
return $('.sentence,.word_in_arabic,.word_in_english').val('');
}
$(this).parents('.relate_row').remove().hide(500);
});
});
</script>
@endsection