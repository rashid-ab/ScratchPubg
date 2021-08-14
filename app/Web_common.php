<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Web_common extends Model
{




    public static function get_data($table_name)
    {
	   	return $positions = DB::table($table_name)
	   	 ->orderBy('id', 'DESC')
	    ->paginate(20);
	}

	public static function update_data($id,$data_array,$table_name)
    {
        return DB::table($table_name)->where('id', $id)->update($data_array);
    }

    public static function single_data($id,$table_name)
    {
        return DB::table($table_name)->where('id', $id)->first();
    }


/********************************** Zaid ****************************************/

    public static function delete_event($id,$data_array,$table_name)
    {
        return DB::table($table_name)->where('id', $id)->update($data_array);
    }
   

	  public static function newpassword($id,$data_array,$table_name)
    {
        return DB::table($table_name)->where('id', $id)->update($data_array);
    }
	
	

}
