<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Illuminate\Foundation\Console\Presets\React;
use Illuminate\Http\Request;
// use Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
class ApiController extends Controller {

	/*======================  SIGN UP  =====================*/
	public function signup(Request $request){
	    if($request->email){
	        $email=User::where('email',$request->email)->first();
	    if(!is_null($email)){
	        return response()->json(['status' => "400",
			'description' => "email already exist",
			'message' => "failure", 'data' => '']);
	    }
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            ]);
            return response()->json(['status' => "200",
			'description' => "Sign up successfully!",
			'message' => "success", 'data' => '']);
	    }
    }

    /*======================  CHANGE PASSWORD  =====================*/
	public function change_password(Request $request){
	    $user=User::where('email',$request->email)->update([
            'password'=>Hash::make($request->password),
            ]);
            return response()->json(['status' => "200",
			'description' => "Sign up successfully!",
			'message' => "success", 'data' => 'CHange Password Successfully!']);
	    }
	
	/*======================  LOGIN  =====================*/
	public function login(Request $request){
	if($request->email){
	if(!Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
	    return response()->json(['status' => "400",
			'description' => "No User Exist",
			'message' => "failure", 'data' => '']);
	}
	
	else{
	    $user=User::where('email',$request->email)->first();
	    return 	response()->json(['status' => "200",
				'description' => "login",
				'message' => "success", 'data' => $user]);
	}
	}  
	}
	
	
	/*======================  LOGOUT  =====================*/
		public function logout(Request $request){
		    $logout=DB::table('reme_tokens')->where('reme_token',$request->reme_token)->delete();
		    return response()->json(['status' => "200",
			'description' => "logout",
			'message' => "success", 'data' => 'logout successfully']);
		    
		}
        /*======================  Silver Coins =====================*/
        public function silver_coins(Request $request){
            $user=User::where('email',$request->email)->first();
            $latestcoins = $user->coins+$request->coins;
            $latesttotalcoins = $user->total_coins+$request->coins;
            $limit=$user->silver_limit-1;
            $coins=User::where('email',$request->email)->update([
                'coins' => $latestcoins,
                'total_coins' => $latesttotalcoins,
                'silver_limit' => $limit,
            ]);
            if ($coins) {
                return response()->json(['status' => "200",
                'description' => "win Coins",
                'message' => "success", 'coins' => $latestcoins,'limit'=>$limit]);
            }
        }
        /*======================  Golden Coins  =====================*/
        public function golden_coins(Request $request){
            $user=User::where('email',$request->email)->first();
            $latestcoins = $user->coins+$request->coins;
            $latesttotalcoins = $user->total_coins+$request->coins;
            $limit=$user->golden_limit-1;
            $coins=User::where('email',$request->email)->update([
                'coins' => $latestcoins,
                'total_coins' => $latesttotalcoins,
                'golden_limit' => $limit,
            ]);
            if ($coins) {
                return response()->json(['status' => "200",
                'description' => "win Coins",
                'message' => "success", 'coins' => $latestcoins,'limit'=>$limit]);
            }
        }
        /*======================  Platinum Coins  =====================*/
        public function platinum_coins(Request $request){
            $user=User::where('email',$request->email)->first();
            $latestcoins = $user->coins+$request->coins;
            $latesttotalcoins = $user->total_coins+$request->coins;
            $limit=$user->platinum_limit-1;
            $coins=User::where('email',$request->email)->update([
                'coins' => $latestcoins,
                'total_coins' => $latesttotalcoins,
                'platinum_limit' => $limit,
            ]);
            if ($coins) {
                return response()->json(['status' => "200",
                'description' => "win Coins",
                'message' => "success", 'coins' => $latestcoins,'limit'=>$limit]);
            }
        }

        /*======================  Get User  =====================*/

        public function getUser(Request $request){
            $user=User::where('email',$request->email)->first();
                return response()->json(['status' => "200",
                'description' => "User",
                'message' => "success", 'data' => $user]);
        }

        /*======================  Get Token  =====================*/

        public function tokenupdate(Request $request){
            
            $tokenupdate=User::where('email',$request->email)->update([
                'device_token' => $request->device_token,
            ]);
            
            if ($tokenupdate) {
                return response()->json(['status' => "200",
                'description' => "Token",
                'message' => "success", 'data' => $request->device_token]);
            }
        }


        /*======================  Send Mail  =====================*/

        public function send_mail(Request $request){
            $email_send=User::where('email',$request->email)->first();
            if(is_null($email_send)){
                return response()->json(['status' => "200",
                'description' => "Forget Password",
                'message' => "success", 'data' => "No User for this Email!"]);
            }
            else{
                $hashed_random_password = str_random(8);
                $email_submit=User::where('id',$email_send->id)->update([
                'password'=>Hash::make($hashed_random_password),
            ]);
    
            $to      = $request->email;
             $subject = "Password Reset";
    
            $message = "
            <html>
                <head>
                    <title>HTML email</title>
                </head>
                <body>
                    <h2>Your New Password!</h2>
                    <h1 style=color:#f50000>$hashed_random_password</h1>
                </body>
            </html>
            ";
    
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
            // More headers
            $headers .= 'From: scratchouc@gmail.com' . "\r\n";
            mail($to, $subject, $message, $headers);
                return response()->json(['status' => "200",
                'description' => "Forget Password",
                'message' => "success", 'data' => "Password sent to your Email!"]);
            }
        }

        /*======================  Redeem  =====================*/

        public function redeem(Request $request){
            
            $tokenupdate=User::where('email',$request->email)->update([
                'pubg_id' => $request->pubg_id,
                'redeem_uc' => $request->redeem_uc,
                'uc' => $request->uc,
                'coins' => $request->coins,
            ]);
            
            if ($tokenupdate) {
                return response()->json(['status' => "200",
                'description' => "Token",
                'message' => "success", 'data' => $request->device_token]);
            }
        }

}
