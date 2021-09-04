<?php

namespace App\Http\Controllers;

use App\Mail\ReplyMail;
use App\Web_common;
use Auth;
use DB;
use Hash;
use App\User;
use App\Film;
use App\Season;
use App\SeasonNo;
use App\SeasonEpisode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function get_logout()
    {
        Auth::logout();
        return redirect()->intended('/');
    }

    public function manage_user()
    {
        $user = Web_common::get_data('users');
        return view('users', ['users' => $user]);
    }
    public function manage_notification()
    {
        return view('push_notify');
    }
    public function block_user($id)
    {
        $data = array("status" => '0');
        $record = Web_common::update_data($id, $data, "users");
        return redirect()->intended('/manage_user');
    }

    public function un_block_user($id)
    {
        $data = array("status" => '1');
        $record = Web_common::update_data($id, $data, "users");
        return redirect()->intended('/manage_user');
    }

    public function get_data($id)
    {
        $record = Web_common::single_data($id, "users");

        $html = "";
        $html .= '<div class="media-left">

            <div  class="media-body">
            	<div class="col-sm-6 col-xs-12">
					<div class="form-group">
					<span><b>Name:</b> ' . $record->name . '</span>
					</div>
					<div class="form-group">
					<span><b>Email:</b> ' . $record->email . '</span>
					</div>
					<div class="form-group">
					<span><b>Phone Number:</b> ' . $record->phone . '</span>
					</div>
            	</div>
                </div>
            </div>';
        echo $html;
    }
    public function send_mail($text, $email)
    {
        $data = array('text' => $text, "name" => "hahahaha");
        $to = $email;
        Mail::to($to)->send(new ReplyMail($data));
        echo "Your Msg have been send to user via email";
    }

    /****************** Bilal ******************************************/

    public function send_noti(){
        $User=User::where('device_token','!=','')->get();
        // echo $User;
        foreach($User as $use){
            
            $tokens[] = $use->device_token;
            echo $use->device_token;
            
        }
        $this->send_push_noti('Free UC','You won 60 UC',$tokens);
    }
    public function send_push_noti($title, $body, $tokens)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        //Custom data to be sent with the push
        $data = array(
            'message' => 'here is a message. message',
            'title' => $title,
            'body' => $body,
            'largeIcon' => 'large_icon',
            'some data' => 'Some Data',
            'Another Data' => 'Another Data',
        );
        // echo $data;
        //This array contains, the token and the notification. The 'to' attribute stores the token.
        $arrayToSend = array(
            'registration_ids' => $tokens,
            'notification' => $data,
            'priority' => 'high',
        );

        //Generating JSON encoded string form the above array.
        $json = json_encode($arrayToSend);
        //Setup headers:
        // echo $json;
        $headers = array();
        $headers[] = 'Content-Type: application/json';

        $headers[] = 'Authorization: key= AAAA_i3zE_w:APA91bHLc6FS-w_ZJLiD6l4ga6DDALcmh23ShgGKuW4TstHsjmNaiypaolSBhktLt2xmC77jL_bqJOIj6SCs9W5Uk7AwqR_ndByT7IYH70bQfmBxuzV5Vdgp5iEUa7HgfuF9cuxa1g8r';

        //Setup curl, add headers and post parameters.

        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        //Send the request
        $response = curl_exec($ch);
        // echo $response;
        //Close request
        curl_close($ch);
        // return $response;

        // echo $response;
    }

    /****************** Zaid ******************************************/

    
    public function changepassword()
    {
        return view('changePassword');
    }

    public function sendPasswordVar()
    {
        $data = Input::all();
        $oldpassword = $data['oldPassowrd'];
        $newpassword = $data['newPassowrd'];
        $confermpassword = $data['confermPassowrd'];

        $user = Auth::User();
        if ($newpassword == $confermpassword) {
            $current_password = $user->password;
            if (Hash::check($oldpassword, $current_password)) {
                print_r("yes match value");
                echo "<br>";
                $newpassword = Hash::make($newpassword);
                print_r($newpassword);
                echo "<br>";
                $user_id = $user->id;
                $data = array("password" => $newpassword);
                $newpassword = Web_common::newpassword($user_id, $data, "users");
                print_r("yes change");
                echo "<br>";
                return redirect('/');
            } else {
                return redirect()->back()->with('message', 'Old Password is Incorect..!');
            }
        } else {
            return redirect()->back()->with('message', 'Your Password In Not Match..!');
        }
    }

    public function redeem(Request $request)
    {
        
        $user=User::where('id',$request->id)->update(['redeem_uc'=>0,'status'=>0]);
        $users=User::where('id',$request->id)->first();
        $device_token[] = $users->device_token;
        $this->send_push_noti('Free UC','You won '.$request->uc.' UC',$device_token);
        $data="$request->uc sent to your Account!";
        return response()->json(['status' => "200",
        'description' => "Forget Password",
        'message' => "success", 'data' =>$data]);
    }
}