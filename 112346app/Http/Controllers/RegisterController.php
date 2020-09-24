<?php



namespace App\Http\Controllers;



use App\Saveuser;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Web_common;
use App\User;

class RegisterController extends Controller

{
    
    // public function index()
    // {
    //     return view('login');
    // }
    
    public function login(Request $request) {
        
        $email = $request->input('email');
        $password = $request->input('password');
        $messages = array(
            'email.required' => 'Please enter email',
             'password.required' => 'Please enter password',
        );
        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('/')->withErrors($validator)->withInput();
        }

       $data=array ( 'email' => $email,'password' => $password); 
        if (Auth::attempt($data)) {
           
            return redirect('/manage_user');

        } else {
            
            Session::flash ( 'message', "Invalid Credentials , Please try again." );
            return redirect()->back();
        }

    }
    
    public function share_data($id)
    {
        
        
        // echo "Testing";
        // die;
        $url = url()->full();
        $url_data = explode("ap@",$url);
        $id = $url_data[1];
        
        // echo $url;
        // print_r ($url_data);
        // echo $id;
        // die;
        
        $event = DB::table('events')
        ->select('*','events.id AS event_id')
        ->join('event_types', 'events.type', '=', 'event_types.id')
        ->join('users', 'users.id', '=', 'events.user_id')
        ->where('events.id',$id)
        ->first();
        
        // print_r($event);
        // die;
        
        if($event)
        {
            $geolocation = $event->lat.','.$event->lng;
            $request = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$geolocation.'&sensor=true_or_false&key=AIzaSyAWJT-MNjP_WOSmmiponjy6bppH1L1-3Pg'; 
    
            $file_contents = file_get_contents($request);
            $location = json_decode($file_contents);
    
            $user = User::find($event->user_id);
            return view('share', compact('event', 'user','location'));
        }
        else
        {
            return view('not_data_in_share_file');
        }
        
        die;
        
        
    }

    public function get_logout()
    {
        Auth::logout();
        return redirect('/');
    }

   public function email_send(Request $request){
       return response()->json(['null'=>$request->email]);
        $email_send=User::where('email',$request->email)->first();
        if(is_null($email_send)){
            return response()->json('null');
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
        $headers .= 'From: rashid.butt@appcrates.com' . "\r\n";
        $headers .= 'Cc: lal.bhinder@appcrates.com' . "\r\n";

        mail($to, $subject, $message, $headers);
        return response()->json('send');
        }
    }

    public function changepassword()
     {
         return view('changePassword');
     } 

     

      public function sendPasswordVar()
     {
         
        $data=Input::all();
        $oldpassword = $data['oldPassowrd'];
        $newpassword = $data['newPassowrd'];
        $confermpassword = $data['confermPassowrd'];


         $user = Auth::User();
        if($newpassword == $confermpassword){         
            $current_password = $user->password;    
              if (Hash::check($oldpassword, $current_password)){
                print_r("yes match value");
                echo "<br>";
                 $newpassword = Hash::make($newpassword);
                  print_r($newpassword);
                  echo "<br>";
                 $user_id = $user->id;
                 $data=array("password"=> $newpassword);
                 $newpassword = Web_common::newpassword($user_id,$data,"users");
                 print_r("yes change");
                echo "<br>";
                return  redirect('/');
              }
              else
              {
            
                return  redirect()->back()->with('message', 'Old Password is Incorect..!');
              }

        
        }else
        {

          return  redirect()->back()->with('message', 'Your Password In Not Match..!');
        }
        
        
     } 

}

