<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Illuminate\Foundation\Console\Presets\React;
use Illuminate\Http\Request;
// use Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            $actualcoins=User::where('email',$request->email)->first();
            $latestcoins = $actualcoins->coins+$request->coins;
            $latesttotalcoins = $actualcoins->total_coins+$request->coins;
            $coins=User::where('email',$request->email)->update([
                'coins' => $latestcoins,
                'total_coins' => $latesttotalcoins,
                'silver_limit' => $actualcoins->silver_limit-1,
            ]);
            if ($coins) {
                return response()->json(['status' => "200",
                'description' => "win Coins",
                'message' => "success", 'data' => $latestcoins]);
            }
        }
        /*======================  Golden Coins  =====================*/
        public function golden_coins(Request $request){
            $actualcoins=User::where('email',$request->email)->first();
            $latestcoins = $actualcoins->coins+$request->coins;
            $latesttotalcoins = $actualcoins->total_coins+$request->coins;
            $coins=User::where('email',$request->email)->update([
                'coins' => $latestcoins,
                'total_coins' => $latesttotalcoins,
                'golden_limit' => $actualcoins->golden_limit-1,
            ]);
            if ($coins) {
                return response()->json(['status' => "200",
                'description' => "win Coins",
                'message' => "success", 'data' => $latestcoins]);
            }
        }
        /*======================  Platinum Coins  =====================*/
        public function platinum_coins(Request $request){
            $actualcoins=User::where('email',$request->email)->first();
            $latestcoins = $actualcoins->coins+$request->coins;
            $latesttotalcoins = $actualcoins->total_coins+$request->coins;
            $coins=User::where('email',$request->email)->update([
                'coins' => $latestcoins,
                'total_coins' => $latesttotalcoins,
                'platinum_limit' => $actualcoins->platinum_limit-1,
            ]);
            if ($coins) {
                return response()->json(['status' => "200",
                'description' => "win Coins",
                'message' => "success", 'data' => $latestcoins]);
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
}
