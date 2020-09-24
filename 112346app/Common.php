<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Common extends Model
{ 
    /*====================== MIND MAPING  =====================*/

      public static function search_data_single($select,$where,$table)
    {
       return DB::table($table)->select($select)->WhereRaw($where)->first();
    }

        public static function insert_data($data_array,$table_name)
    {
        return DB::table($table_name)->insertGetId($data_array);      
    }

       public static function update_data($id,$data_array,$table_name)
    {
        return DB::table($table_name)->where('id', $id)->update($data_array);
    }

      public static function data_by_with($where,$table)
    {
         return DB::table($table)->where($where)->first();
    }

     public static function create_password($user_id,$length=6) {
        
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $final_string=$randomString.time();

        $data=array(
            "password"=>md5($final_string)
        );
        Common::update_data($user_id,$data,"users");
         return $final_string;
    }

     /*====================== MIND MAPING  =====================*/
  

}




