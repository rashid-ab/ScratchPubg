<?php

namespace App\Http\Controllers;
use App\Common;
use App\FavoriteWord;
use App\Payment;
use App\User;
use App\Word;
use App\Slider;
use App\Season;
use App\Film;
use App\Category;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller {

	/*======================  SIGN UP  =====================*/
	public function signup(Request $request){
	    $rem_token=str_random(8);
	    $random=str_random(7);
	    
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
            'phone'=>$random,
            'password'=>Hash::make($request->password),
            'age'=>$request->age,
            'geneder'=>$request->geneder,
            'rem_token'=>$rem_token,
            ]);
	    }
	    if($request->phone){
	        $phone=User::where('phone',$request->phone)->first();
	    if(!is_null($phone)){
	        return response()->json(['status' => "400",
			'description' => "number is already exist",
			'message' => "failure", 'data' => '']);
	    }
        $user=User::create([
            'name'=>$request->name,
            'email'=>$random,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
            'age'=>$request->age,
            'geneder'=>$request->geneder,
            'rem_token'=>$rem_token,
            ]);
	    }
	    $users=User::where('id',$user->id)->first();
        return response()->json(['status' => "200",
			'description' => "signup",
			'message' => "success", 'data' => $users]);
    }
	
	/*======================  LOGIN  =====================*/
	public function login(Request $request){
	$randon_token=str_random(8);
	if($request->email){
	if(!Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
	    return response()->json(['status' => "400",
			'description' => "No User Exist",
			'message' => "failure", 'data' => '']);
	}
	
	else{
	    $id=User::where('email',$request->email)->first();
	    DB::table('reme_tokens')->insert([
	        'user_id'=>$id->id,
	        'reme_token'=>$randon_token,
	        ]);
	        $data=User::join('reme_tokens','reme_tokens.user_id','=','users.id')->select('users.id','users.name','users.email','users.age','users.gender','users.image','users.subscription','users.start_date','users.end_date','users.category','reme_tokens.reme_token')->where('users.id',$id->id)->first();
	       return response()->json(['status' => "200",
			'description' => "login",
			'message' => "success", 'data' => $data]);
	}
	}  
	if($request->phone){
	    	if(!Auth::attempt(['phone'=>$request->phone,'password'=>$request->password])){
	    return response()->json(['status' => "400",
			'description' => "No User Exist",
			'message' => "failure", 'data' => '']);
	}
	
	else{
	     $id=User::where('phone',$request->phone)->first();
	    DB::table('reme_tokens')->insert([
	        'user_id'=>$id->id,
	        'reme_token'=>$randon_token,
	        ]);
	         $data=User::join('reme_tokens','reme_tokens.user_id','=','users.id')->select('users.id','users.name','users.phone','users.age','users.gender','users.image','users.subscription','users.start_date','users.end_date','users.category','reme_tokens.reme_token')->where('users.id',$id->id)->first();
	       return response()->json(['status' => "200",
			'description' => "login",
			'message' => "success", 'data' => $data]);
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
	
	
	/*======================  CATEGORIES  =====================*/
    public function get_categories(){
        $categories=Category::get();
        $array=array();
        $datas=array();
        foreach($categories as $category){
            $season=Season::where('category_id',$category->id)->select('id','season_name','image')->get();
            $film=Film::where('category_id',$category->id)->select('id','film_title','film_file')->get();
            $data=Category::join('seasons','seasons.category_id','=','categories.id')
        ->join('films','films.category_id','=','categories.id')
        ->select('seasons.category_id','categories.category_name','seasons.id as season_id','seasons.image','seasons.season_name','films.film_title','films.id as film_id','films.film_file')->where('categories.id',$category->id)->orderBy('categories.id','DESC')->get();
        $array[]=array([
                'category_id'=>$category->id,
                'category_name'=>$category->category_name,
                ]);
            
        foreach($data as $dat){
            
                $datas[]=array([
                    'id'=>$dat->season_id,
                    'name'=>$dat->season_name,
                    'image'=>$dat->image,
                    'id'=>$dat->film_id,
                    'name'=>$dat->film_title,
                    'id'=>$dat->film_file,
                    ]);
        }
        return $datas;
          $array1=array_push($array,$datas);
        }
        return response()->json(['status' => "200",
			'description' => "all categories",
			'message' => "success", 'data' => $array1]);
    }
    
    /*======================  SEASONS  =====================*/
    
    public function get_seasons(Request $request){
        
        $seasons=DB::table('seasons')->
        where('category_id',$request->category_id)->
        get();
        
        return response()->json(['status' => "200",
			'description' => "all seasons",
			'message' => "success", 'data' => $seasons]);
    }
    
    /*======================  SLIDERS  =====================*/
    
    public function get_slider(){
        
        $seasons=Slider::orderBy('id','DESC')->get();
        return response()->json(['status' => "200",
			'description' => "all seasons",
			'message' => "success", 'data' => $seasons]);
    }
}
