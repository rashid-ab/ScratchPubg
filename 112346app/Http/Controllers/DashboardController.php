<?php

namespace App\Http\Controllers;

use App\Mail\ReplyMail;
use App\Web_common;
use Auth;
use DB;
use Hash;
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

    public function manage_events($event_category)
    {
        // echo $event_category;
        // die;
        if ($event_category == 1 || $event_category == 2) {
            $events = Web_common::get_events($event_category);
            return view('events', ['events' => $events]);
        } else {
            return view('terms');
        }
    }

    public function get_eventdetails($id)
    {
        $count_event_comments = Web_common::count_event_comments($id);
        $count_event_planed = Web_common::count_event_planed($id);
        $count_event_liked = Web_common::count_event_liked($id);
        $record = Web_common::get_event_detail($id);

        // 	$data = array('detail' => $record,
        // 	              'count_event_comments' => $count_event_comments,
        //                   'count_event_planed' => $count_event_planed,
        //                   'count_event_liked' => $count_event_liked,
        //                     );

        // 	print_r($record);
        // 	die;

        return view('event_detail', ['event' => $record, 'count_event_comments' => $count_event_comments, 'count_event_planed' => $count_event_planed, 'count_event_liked' => $count_event_liked]);
    }

    public function reported_events()
    {
        $events = Web_common::get_reported_events();
        return view('reported_events', ['events' => $events]);
    }
    public function privacy()
    {
        return view('privacy');
    }

    public function terms()
    {
        return view('terms');
    }
    public function send_mail($text, $email)
    {
        $data = array('text' => $text, "name" => "hahahaha");
        $to = $email;
        Mail::to($to)->send(new ReplyMail($data));
        echo "Your Msg have been send to user via email";
    }

    /****************** Bilal ******************************************/

    

    public function send_push_noti($title, $body, $tokens)
    {

        // echo $title;
        // print_r($tokens);
        // die;

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
            'smallIcon' => 'small_icon',
            'some data' => 'Some Data',
            'Another Data' => 'Another Data',
        );

        //This array contains, the token and the notification. The 'to' attribute stores the token.
        $arrayToSend = array(
            'registration_ids' => $tokens,
            'notification' => $data,
            'priority' => 'high',
        );

        //Generating JSON encoded string form the above array.
        $json = json_encode($arrayToSend);
        //Setup headers:
        $headers = array();
        $headers[] = 'Content-Type: application/json';

        $headers[] = 'Authorization: key= AIzaSyCTN7By31ZXru_2TOlLJZhahpDXAhy5vN0';

        //Setup curl, add headers and post parameters.

        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        //Send the request
        $response = curl_exec($ch);

        //Close request
        curl_close($ch);
        return $response;

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

    public function manage_categories()
    {
        $categories = DB::table('categories')->where('delete_status',1)->get();
        return view('manage_categories', ['categories' => $categories]);
    }
    public function block_category($id)
    {
        $data = array("status" => '0');
        $record = Web_common::update_data($id, $data, "categories");
        return redirect()->intended('/manage_categories');
    }

    public function un_block_category($id)
    {
        $data = array("status" => '1');
        $record = Web_common::update_data($id, $data, "categories");
        return redirect()->intended('/manage_categories');
    }

    public function new_category()
    {
        return view('new_category');
    }
    public function add_category(Request $request)
    {
        if ($request->hasfile('image')) {
            $file=$request->file('image');
            $file_name=time().$file->getClientOriginalName();
            $destination=app()->basePath('public/images');
            $file->move($destination, $file_name);
        }
        $new_category = DB::table('categories')->insert([
            'category_name' => $request->category_name,
            'description' => $request->description,
            'image' => url('/').'/public/images/'.$file_name,
            'status' => 1,
        ]);
        
        return redirect('/new_category')->with('success', 'New Category Added Successfully');
    }


    public function edit_category($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        return view('edit_category', compact('category'));
    }

    public function update_category(Request $request)
    {
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $destination = app()->basePath('public/images');
            $file->move($destination, $file_name);

            $update_category = DB::table('categories')->where('id', $request->id)->update([
                'category_name' => $request->category_name,
                'description' => $request->description,
                'image' => url('/') . '/public/images/' . $file_name,
                'status' => $request->status,
            ]);
        } else {
            $category= DB::table('categories')->where('id', $request->id)->first();
            $update_category = DB::table('categories')->where('id', $request->id)->update([
                'category_name' => $request->category_name,
                'description' => $request->description,
                'image' => $category->image,
                'status' => $request->status,
            ]);
        }
        
        return redirect('/manage_categories')->with('update', 'Updated Successfully');
    }


    public function manage_seasons()
    {
        $seasons = DB::table('seasons')->
        join('categories','seasons.category_id','=','categories.id')->
        select('seasons.*','categories.category_name')->
        where('seasons.delete_status',1)->
        get();
        
        return view('manage_seasons', ['seasons' => $seasons]);
    }
    public function block_season($id)
    {
        $data = array("status" => '0');
        $record = Web_common::update_data($id, $data, "seasons");
        return redirect()->intended('/manage_seasons');
    }

    public function un_block_season($id)
    {
        $data = array("status" => '1');
        $record = Web_common::update_data($id, $data, "seasons");
        return redirect()->intended('/manage_seasons');
    }
    
    public function delete_season($id)
    {
        DB::table('seasons')->where('id',$id)->update(['delete_status'=>0]);
        return redirect()->intended('/manage_seasons');
    }
    public function delete_category($id)
    {
        DB::table('categories')->where('id',$id)->update(['delete_status'=>0]);
        return redirect()->intended('/manage_categories');
    }

    public function new_season()
    {
        $categories=Web_common::get_data('categories');
        return view('new_season',compact('categories'));
    }
    public function add_season(Request $request)
    {
       if ($request->hasfile('image')) {
            $file=$request->file('image');
            $file_name=time().$file->getClientOriginalName();
            $destination=app()->basePath('public/images');
            $file->move($destination, $file_name);
        }
        $new_category = DB::table('seasons')->insert([
            'season_name' => $request->season_name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'maker_name' => $request->maker_name,
            'maker_email' => $request->maker_email,
            'trailer_link' => $request->trailer_link,
            'image' => url('/').'/public/images/'.$file_name,
            'status' => 1,
        ]);
        
        return redirect('/new_season')->with('success', 'New Season Added Successfully');
    }
    
    public function edit_season($id)
    {
        $season = DB::table('seasons')->where('id', $id)->first();
        $categorys=DB::table('categories')->where('id',$season->category_id)->first();
        $categories=DB::table('categories')->get();
        return view('edit_season', compact('season','categorys','categories'));
    }

    public function update_season(Request $request)
    {
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $destination = app()->basePath('public/images');
            $file->move($destination, $file_name);

            $update_category = DB::table('seasons')->where('id', $request->id)->update([
            'season_name' => $request->season_name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'maker_name' => $request->maker_name,
            'maker_email' => $request->maker_email,
            'trailer_link' => $request->trailer_link,
            'image' => url('/').'/public/images/'.$file_name,
           ]);
        } else {
            $season = DB::table('seasons')->where('id', $request->id)->first();
            $update_category = DB::table('seasons')->where('id', $request->id)->update([
            'season_name' => $request->season_name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'maker_name' => $request->maker_name,
            'maker_email' => $request->maker_email,
            'trailer_link' => $request->trailer_link,
            'image' => $season->image,
            ]);
        }
        
        return redirect('/manage_seasons')->with('update', 'Updated Successfully');
    }
}