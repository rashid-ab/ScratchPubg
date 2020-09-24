<?php 
$url = URL::to("/");
// echo $url;
//  die;
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
       <link href="<?php echo $url;?>/dist/bootstrap_4/css/bootstrap.min.css" rel="stylesheet">

    <title>Just Chill</title>
    <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700');
    body{
        font-family: 'Roboto', sans-serif;
    }
        .event_d_block ul.ih_blocks li {
            border-bottom: solid 2px #eee;
            padding: 8px 0;
            color:#5B5B5B;
        }
        .event_d_block ul.ih_blocks li:last-child{
            border:none;
        }
        .multimedia_wraper {
            position: relative;
        }
        .multimedia_wraper div.media {
            position: absolute;
            bottom: 0;
            padding: 8px 15px;
            background: #e4dadade;
            width: 100%;
        }
        @media only screen and (max-width: 480px){
            ul.dwn_app li{
            width:100%;
            margin:0;
            text-align:center;
            }
            ul.dwn_app li:last-child{
                margin:8px 0 0;
            }
        }
        .btn_app{
            background: transparent;
            border-color: #fff;
            color:#ffff;
        }
        .head_app{
            background:#5AD4BE;
        }
        
    </style>
  </head>
  <body>
    <div class="col-md-8 mx-md-auto px-0">
            <div class="head_app clearfix p-3">
                <div class="float-left">
                    <img src="<?php echo $url;?>/dist/img/public_site/logo.png" alt="logo" width="90">
                    <b>Just Chill</b>
                </div>
                <div class="float-right d-md-none d-lg-none d-sm-block">
                    <a href="justchill://{{$event->event_id }}" class="btn mt-4 btn_app">Open in App</a>
                </div>
            </div>
        <div class="row mx-0">
            <div class="col-md-6 col-sm-12 col-12 p-0">
                <div class="multimedia_wraper">
                    @if($event->event_category == 1)
                    <img src="{{ $event->event_file }}" alt="just-chill" width="100%" style="max-height: 503px;">
                    @else
                    <video width="100%" style="max-height: 503px;" controls>
                      <source src="{{ $event->event_file }}" type="video/mp4">
                    </video>
                    @endif
                        
                    
                    <div class="media d-md-none d-sm-none">
                      @if($user->picture != "")
                        <img class="mr-3 rounded-circle" src="{{ $user->picture }}" alt="Generic placeholder image" width="60">  
                        @else
                        <img class="mr-3 rounded-circle" src="<?php echo $url;?>/dist/img/public_site/img_avatar.png" alt="Generic placeholder image" width="60">
                        @endif
                      <div class="media-body">
                        <h5 class="mt-0">{{ $user->f_name }}</h5>
                        {{ $user->country }}
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-12">
                <div class="content_wraper row pl-4 pt-4">
                    <div class="media d-none d-md-flex d-sm-flex">
                        @if($user->picture != "")
                        <img class="mr-3 rounded-circle" src="{{ $user->picture }}" alt="Generic placeholder image" width="60">  
                        @else
                        <img class="mr-3 rounded-circle" src="<?php echo $url;?>/dist/img/public_site/img_avatar.png" alt="Generic placeholder image" width="60">
                        @endif
                      
                      <div class="media-body">
                        <h5 class="mt-0">{{ $user->f_name }}</h5>
                        {{ $user->country }}
                      </div>
                    </div>
                    <div class="event_d_block mt-5">
                        <h3>Event Details</h3>
                        <ul class="list-unstyled ih_blocks">
                            <li>
                              <div class="media">
                                <img src="<?php echo $url;?>/dist/img/public_site/partynameicon.png" alt="partynameicon" class="mr-3" width="35">
                                <div class="media-body">
                                  <p class="m-0">{{$event->title }}</p>      
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="media">
                                <img src="<?php echo $url;?>/dist/img/public_site/locationicon.png" alt="locationicon" class="mr-3 ml-2 mt-2" width="24">
                                <div class="media-body">
                                  <p class="m-0">{{$location->results['0']->formatted_address}}
                                  </p>      
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="media">
                                <img src="<?php echo $url;?>/dist/img/public_site/dateicon.png" alt="dateicon" class="mr-3 ml-2 mt-0" width="25">
                                <div class="media-body">
                                  <p class="m-0">
                                  <?php 
                                    $timestamp = strtotime($event->utc_start_datetime);
                                    echo $new_date_format = date('M-d-Y', $timestamp);
                                  ?>

                                  to 

                                  <?php 
                                    $timestamp = strtotime($event->utc_end_datetime);
                                    echo $new_date_format = date('M-d-Y', $timestamp);
                                  ?>
                              </p>      
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="media">
                                <img src="<?php echo $url;?>/dist/img/public_site/timeicon.png" alt="timeicon" class="mr-3 ml-2 mt-0" width="25">
                                <div class="media-body">
                                  <p class="m-0">
                                  <?php 
                                    $timestamp = strtotime($event->utc_start_datetime);
                                    echo $new_date_format = date('h:i A', $timestamp);
                                  ?> 

                                    to 

                                  <?php 
                                    $timestamp = strtotime($event->utc_end_datetime);
                                    echo $new_date_format = date('h:i A', $timestamp);
                                  ?> 
                                </p>      
                                </div>
                              </div>
                            </li>
                        </ul>
                        <h5 class="mb-4 text-center">Create your own events</h5>
                        <ul class="list-inline dwn_app">
                            <li class="list-inline-item">
                                <img src="<?php echo $url;?>/dist/img/public_site/buttonAppstore.png" alt="buttonAppstore" width="180">
                            </li>
                            <li class="list-inline-item">
                                <img src="<?php echo $url;?>/dist/img/public_site/buttonGoogle.png" alt="buttonGoogle" width="180">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="<?php echo $url;?>/dist/bootstrap_4/js/bootstrap.min.js"></script>
  </body>
</html>