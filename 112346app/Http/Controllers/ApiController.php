<?php

namespace App\Http\Controllers;
use App\Common;
use App\FavoriteWord;
use App\Payment;
use App\User;
use App\Word;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller {

	/*======================  SIGNUP  =====================*/
	public function sign_up() {
		$input = Input::all();
		$name = Input::get('name');
		$email = Input::get('email');
		$password = Input::get('password');
		$phone = Input::get('phone');
		// $device_token = Input::get('device_token');

		if (empty($name)) {
			return response()->json(['code' => 100, 'data' => 'Name Field is empty.'], 200);
		}
		if (empty($email)) {
			return response()->json(['code' => 100, 'data' => 'Email Field is empty.'], 200);
		}
		if (empty($password)) {
			return response()->json(['code' => 100, 'data' => 'Password Field is empty.'], 200);
		}
		if (empty($phone)) {
			return response()->json(['code' => 100, 'data' => 'Phone Field is empty.'], 200);
		}

		$where = " (email='" . $email . "') AND status = '1' ";
		$select = array('id');
		$check_user = Common::search_data_single($select, $where, 'users');
		if ($check_user) {
			return response()->json(['code' => 100, 'data' => 'This email is already used.'], 200);
		} else {

			$data = array('name' => $name,
				'email' => $email,
				'password' => Hash::make($password),
				'phone' => $phone,
				// 'device_token' => $device_token,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
				'status' => '1',
			);
			$result_id = Common::insert_data($data, "users");
			return response()->json(['code' => 200, 'data' => "Successfully create your account",
				'user_details' => $result_id], 200);
		}
	}

/*======================  LOGIN  =====================*/

	public function login() {

		$input = Input::all();
		$email = Input::get('email');
		$password = Input::get('password');
		// $device_token = Input::get('device_token');

		$user = User::where('email', $email)->first();

		if ((!$user) || (!Hash::check($password, $user->password))) {
			return response()->json(["code" => 100, "Message" => "Email or Password is incorrect."]);
		} else {

			// $data = array('device_token' => $device_token);
			// $result_id = Common::update_data($user->id,$data, "users");

			return response()->json(["code" => 200, "message" => "Logged In", "user" => $user]);
		}

	}

/*======================  CHANGE PASSWORD  =====================*/

	public function change_password() {
		$input = Input::all();
		$old_pass = Input::get('old_pass');
		$new_pass = Input::get('new_pass');
		$user_id = Input::get('user_id');

		$where = array("password" => md5($old_pass), "id" => $user_id);
		// $where = array("password" => Hash::check($old_pass),"id"=>$user_id);
		$result = Common::data_by_with($where, "users");
		if ($result) {

			$data = array("password" => md5($new_pass));
			Common::update_data($result->id, $data, "users");
			return response()->json(['code' => 200, 'data' => 'Password have been changed successfully.'], 200);
		} else {
			return response()->json(['code' => 100, 'data' => 'Old password dose not match.'], 400);
		}

		;
	}

/*======================  FORGET PASSWORD  =====================*/

	public function forget_password() {

		$input = Input::all();
		$email = Input::get('email');

		$where = "email='" . $email . "'";
		$select = array('id', 'name');
		$check_email = Common::search_data_single($select, $where, 'users');
		if ($check_email) {

			$string = Common::create_password($check_email->id);

			// $data = array('password'=>$string, "name" => $check_email->f_name);
			// $to=$email;

			//   print_r($data);
			//   die;

			$subject = "Reset Password";
			$To = $email;
			$strFrom = "muhammad.zaid@appcrates.com";
			$message = "<table width='610' border='0' cellspacing='0' cellpadding='0'>
                <tr>
                  <td style='padding:23px 23px 16px 23px; background:#f5f5f6; font-family: tahoma; width:610px;'>
                    <table width='600' border='0' cellspacing='0' cellpadding='0'>
                      <tr>
                        <td style='height:1px; background-color:#eeeeee'>
                        </td>
                      </tr>
                      <tr>
                        <td style='font-family: tahoma; size:12px; background-color:#FFFFFF;  padding:10'>
                          <div style='font-size: 12px; background:#ffffff;'><br />
                          <p>Your password has been reset successfully. Following is detail of your account<br /><br />
                          <b>Password:</b>&nbsp;&nbsp;" . $string . "<br/ ><br />
                          </p><br />
                          <p><b>Regards,</b><br/>Just Chill App</p></div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>";
			// echo $message;
			// exit;

			//Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1; format=flowed\n";
			// More headers
			$headers .= 'From: <' . $strFrom . '>' . "\r\n";
			$headers .= "Content-Transfer-Encoding: 7bit\n";
			$headers .= "X-Mailer: php/" . phpversion();

			mail($To, $subject, $message, $headers);

			/************************************************/
			//     $content = [
			//    'name'=> 'Umar',
			//    'email'=> 'info@info.com',
			//    'device_type'=> 'Android',
			//    'user_type'=> 'Admin',
			//    'country'=> 'Pakistan',
			// ];

			// Mail::to($to)->send(new SendMail($data));

			/**************************************************/

			// Mail::send('emails.mail', $data, function($message) {
			//       $message->to($to,'Hello')
			//               ->subject('Join App -Reset Password');
			//       $message->from('info@appcrates.com','Appcrates');
			//   });

			return response()->json(['code' => 200, 'data' => "Done"], 200);

		} else {
			return response()->json(['code' => 100, 'data' => "Wrong Email"], 200);
		}
	}

	//  public function logout()
	// {
	//       $input = Input::all();
	//       $user_id = Input::get('user_id');
	//       Auth::logout();
	//       return response()->json(['code' => 200, 'data'=>"Done"], 200);
	// }

/**************************************************************************************************/

/*======================   LIST OF WORDS  =====================*/

	public function list_of_words() {

		$input = Input::all();
		$user_id = Input::get('user_id');
		$listofwords = Word::where('status', '=', '1')->limit(10)->get();
		$listof_fvtWord = DB::table('favorite_words')->where('user_id', '=', $user_id)->limit(10)->get();

		if ($user_id) {

			foreach ($listofwords as $listofword) {
				$listofword = $listofword->setAttribute('Favorite', 0);
				foreach ($listof_fvtWord as $fav_word) {
					if ($fav_word->word_id == $listofword->id) {
						$listofword->Favorite = 1;
					}
				}
			}
			return response()->json(['code' => 200, 'data' => $listofwords], 200);
		} else {

			if (count($listofwords) > 0) {
				foreach ($listofwords as $listofword) {
					$listofword = $listofword->setAttribute('Favorite', 0);
				}
				return response()->json(['code' => 200, 'data' => $listofwords], 200);
			} else {
				return response()->json(['code' => 100, 'data' => 'No Data Found'], 200);
			}

		}

	}

/*======================   LIST OF PAID WORDS  =====================*/

	public function list_of_paid_words() {

		$input = Input::all();
		$user_id = Input::get('user_id');
		$listofpaidwords = Word::where('status', '=', '2')->limit(10)->get();
		$listof_fvtWord = DB::table('favorite_words')->where('user_id', '=', $user_id)->limit(10)->get();

		if ($user_id) {

			foreach ($listofpaidwords as $listofpaidword) {
				$listofpaidword = $listofpaidword->setAttribute('Favorite', 0);
				foreach ($listof_fvtWord as $fav_word) {
					if ($fav_word->word_id == $listofpaidword->id) {
						return 'asd';
						$listofpaidword->Favorite = 1;
					}
				}
			}
			return response()->json(['code' => 200, 'data' => $listofpaidwords], 200);
		} else {
			if (count($listofpaidwords) > 0) {
				foreach ($listofpaidwords as $listofpaidword) {
					$listofpaidword = $listofpaidword->setAttribute('Favorite', 0);
				}
				return response()->json(['code' => 200, 'data' => $listofpaidwords], 200);
			} else {
				return response()->json(['code' => 100, 'data' => 'No Data Found'], 200);
			}

		}

	}

/*======================   FAVORTES WORDS  =====================*/

	public function favorite_a_word() {

		$input = Input::all();
		$user_id = Input::get('user_id');
		$word_id = Input::get('word_id');

		$already_fav = FavoriteWord::where([['user_id', $user_id], ['word_id', $word_id]])->first();

		if ($already_fav) {
			return response()->json(['code' => 100, 'data' => 'Already Favorite Word'], 200);
		} else {

			$data = array(
				'user_id' => $user_id,
				'word_id' => $word_id,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			);
			$result_id = Common::insert_data($data, "favorite_words");
			return response()->json(['code' => 200, 'data' => 'Favorite Word'], 200);
		}

	}

/*======================  UNFAVORTES WORDS  =====================*/

	public function Unfavorite_a_word() {

		$input = Input::all();
		$user_id = Input::get('user_id');
		$word_id = Input::get('word_id');

		$delete_fav = FavoriteWord::where([['user_id', $user_id], ['word_id', $word_id]])->delete();
		if ($delete_fav > 0) {
			return response()->json(['code' => 200, 'data' => 'Favorite Word Remove'], 200);
		} else {
			return response()->json(['code' => 100, 'data' => 'Not Exist Favorite Word'], 200);
		}
	}

/*======================  LIST OF FAVORTES WORDS  =====================*/

	public function list_of_favorite_word() {
		$input = Input::all();
		$user_id = Input::get('user_id');

		$listoffavtwords = DB::table('words as W')
			->join('favorite_words as FW', 'W.id', '=', 'FW.word_id')
			->SELECT('W.id', 'word_in_english', 'word_in_arabic', 'sentence')
			->where('user_id', $user_id)
			->limit(10)
			->get();

		if (count($listoffavtwords) > 0) {
			return response()->json(['code' => 200, 'data' => $listoffavtwords], 200);
		} else {
			return response()->json(['code' => 200, 'data' => $listoffavtwords], 200);
		}

	}

/*======================  SEARCH WORDS  =====================*/

	public function search_word() {
		$input = Input::all();
		$search_word = Input::get('search_word');
		$user_id = Input::get('user_id');
		$listof_search_words = Word::where('word_in_english', 'LIKE', "%{$search_word}%")
			->SELECT('id', 'word_in_english', 'word_in_arabic', 'sentence', 'status')->limit(10)->get();
		$listof_fvtWord = DB::table('favorite_words')->where('user_id', '=', $user_id)->limit(10)->get();

		if ($user_id) {

			foreach ($listof_search_words as $listof_search_word) {
				$listof_search_word = $listof_search_word->setAttribute('Favorite', 0);
				foreach ($listof_fvtWord as $fav_word) {
					if ($fav_word->word_id == $listof_search_word->id) {
						$listof_search_word->Favorite = 1;
					}
				}
			}
			return response()->json(['code' => 200, 'data' => $listof_search_words], 200);

		} else {
			if (count($listof_search_words) > 0) {
				foreach ($listof_search_words as $listof_search_word) {
					$listof_search_word = $listof_search_word->setAttribute('Favorite', 0);
				}
				return response()->json(['code' => 200, 'data' => $listof_search_words], 200);
			} else {
				return response()->json(['code' => 100, 'data' => 'No Data Found'], 200);
			}
		}
	}

/*======================  USER SUBSCRIPTION  =====================*/

	public function user_subscription() {

		$input = Input::all();
		$email = Input::get('email');

		$user_data = User::where('email', $email)->first();

		if ($user_data) {
			$data = array("sub_type" => 1);
			User::where('id', $user_data->id)->Update($data);
			return response()->json(['code' => 200, 'data' => 'Subscription Is Added'], 200);
		} else {
			return response()->json(['code' => 100, 'data' => 'No Data Found'], 200);
		}

	}
	/*======================  UNSUBSCRIPTION  =====================*/

	public function un_subscription() {

		$input = Input::all();
		$email = Input::get('email');

		$user_data = User::where('email', $email)->first();

		if ($user_data) {
			$data = array("sub_type" => 0);
			User::where('id', $user_data->id)->Update($data);
			return response()->json(['code' => 200, 'data' => 'UnSubscription'], 200);
		} else {
			return response()->json(['code' => 100, 'data' => 'No Data Found'], 200);
		}

	}

/*======================  USER PAYMENT  =====================*/

	public function user_payment() {
		$input = Input::all();
		$user_id = Input::get('user_id');
		$total_payment = Input::get('total_payment');

		$data = array("user_id" => $user_id,
			"total_payment" => $total_payment,
		);
		Payment::create($data);
		return response()->json(['code' => 200, 'data' => 'User Payment Is Added'], 200);
	}

/*======================  MIND MAP WORD  =====================*/

	public function mind_map_word() {
		$input = Input::all();
		$mind_word = Input::get('mind_word');

		$listof_mind_words = DB::table('words')->SELECT('id', 'word_in_english', 'word_in_arabic', 'sentence', 'status')->where('word_in_english', 'LIKE', "%{$mind_word}%")->limit(8)->get();
		if (count($listof_mind_words) > 0) {
			return response()->json(['code' => 200, 'data' => $listof_mind_words], 200);
		} else {
			return response()->json(['code' => 100, 'Text' => 'No Data Found', 'data' =>
				$listof_mind_words], 200);
		}

	}

	// <=====================Subscription=========================>

	public function subscription(Request $request) {
		$subscription = DB::table('users')
			->where('id', $request->id)
			->update([
				'sub_type' => $request->sub_type,
			]);

		return response()->json([
			'code' => 200,
			'Text' => 'success',
			'data' => ''], 200);
	}

}
