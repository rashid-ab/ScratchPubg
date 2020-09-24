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
            </div>
        <div class="row mx-0">
           
            <div class="col-md-6 col-sm-12 col-12">
                <div class="content_wraper row pl-4 pt-4">

                    <div class="event_d_block mt-5">
                        <h3>Event Details</h3>
                        <ul class="list-unstyled ih_blocks">
                            <li>
                              <div class="media">
                                <div class="media-body">
                                  <p class="m-0">Event does not exist.</p>      
                                </div>
                              </div>
                            </li>

                        </ul>
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