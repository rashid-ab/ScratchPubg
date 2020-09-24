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
                        
                        
                        
                        Text To Voice
                        <div class="btn-holder" style="float: right;">
                            <!--  <a href="{{ url('newcustomer') }}"><button type="button" class="btn btn-danger">Add New</button></a> -->
                        </div>
                    </header>
                    <div class="panel-body">
                        <!--         <form role="form"> -->
                                   <div class="form-group">
                                        <label>Select Voice</label>
                                        <select name="" id="voiceList" class="form-control">
                                            
                                        </select>
                                    </div>

                                   <div class="form-group">
                                        <label>Type Word</label>
                                        <input type="text" id="txtInput" class="form-control"
                                        name="word_in_english" required >
                                    </div>
                                     <div class="form-group">
                            <button type="submit" class="btn btn-success speech" id="btnSpeak" style="float: right;margin-right: 14px;">Click</button>
                            </div>
                                </div>
                              
                       
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
var voiceList=document.querySelector('#voiceList');
var txtInput=document.querySelector('#txtInput');
var btnSpeak=document.querySelector('#btnSpeak');

var tts = window.speechSynthesis;
var voices = [];
GetVoices();

if (speechSynthesis!== undefined){
    speechSynthesis.onvoiceschanged=GetVoices;
}

btnSpeak.addEventListener('click',()=>{
    var toSpeak =  new SpeechSynthesisUtterance(txtInput.value);
    var selectedVoiceName=voiceList.selectedOptions[0].getAttribute('data-name');
    voices.forEach((voice)=>{
        if (voice.name===selectedVoiceName){
            toSpeak.voice=voice;
        }

    });
    tts.speak(toSpeak);
});
function GetVoices(){
    voices=tts.getVoices();
    voiceList.innerHTML='';
    voices.forEach((voice)=>{
    var listItem=document.createElement('option');
    listItem.textContent=voice.name;
    listItem.setAttribute('data-lang',voice.lang);
    listItem.setAttribute('data-name',voice.name);
    voiceList.appendChild(listItem);

    });
    voiceList.selectedIndex=0;
}
</script>
@endsection