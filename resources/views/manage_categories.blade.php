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

                            All Genre

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

                            <a href="{{ url('new_category') }}"><button type="button" class="btn btn-danger">Add Genre</button></a>

                            </div>

                        </header>
                    
              <div class="panel-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                <th style="text-align:center">ID</th>
                <th style="text-align:center">Genre Name</th>
                <th style="text-align:center">Description</th>
                <th style="text-align:center">Image</th>
                <th style="text-align:center">Status</th>
                <th style="text-align:center">Actions</th>
              </tr>
              </thead>
              <tbody>
                  @foreach ($categories as $category)
                
                    <tr>
                
                        <td style="text-align:center">{{ $category->id }}</td>

                        <td style="text-align:center">{{ $category->category_name	 }}</td>
                        
                        <td style="text-align:center">{{ $category->description }}</td>                                       
                
                        <td style="text-align:center"><img src="{{ $category->image}}" class="img-circle" style="width: 100px" /></td>
                
                         <td style="text-align:center">
                         <?php if($category->status == 1)
                         {
                             echo "Enable Genre";
                         }
                         elseif($category->status == 0)
                         {
                             echo "Disable Genre";
                         }
                         ?>
                         <td style="text-align:center">
                            <div class="icon_wraper">
                                
                                
                                <a href="{{url('/edit_category/'.$category->id)}}" data-toggle="tooltip" title="Edit Genre"><button><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                                @if($category->status==1)
                                <a href="{{url('/block_category/'.$category->id)}}" class="delete_user" data-toggle="tooltip" title="Disable Genre"><button><i class="fas fa-user-slash"></i></button></a>
                                @elseif($category->status==0)
                                <a href="{{url('/unblock_category/'.$category->id)}}" class="delete_user" data-toggle="tooltip" title="Enable Genre"><button><i class="fas fa-user-alt"></i></button></a>
                                @endif  
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





