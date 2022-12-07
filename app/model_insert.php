<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class model_insert extends Model
{
	public static function insert_records_private($token, $request, $id_base)
    {
		//$token - токен пользователя для новой записи
		//$request - запрос
		try
		{
			$private_key_id = models_token_get::get_token_id($token);
			$name_param_get_col1 = 'col1';
			$name_param_get_col2 = 'col2';
			$name_param_get_col3 = 'col3';
			$name_param_get_col4 = 'col4';
			$name_param_get_col5 = 'col5';
			
			$key_pass = $request['key_pass'];
			
			$col1 = $request[$name_param_get_col1];
			$col2 = $request[$name_param_get_col2];
			$col3 = $request[$name_param_get_col3];
			$col4 = $request[$name_param_get_col4];
			$col5 = $request[$name_param_get_col5];
			
			/*
			if($key_pass != "")
			{
				//пользователь решил шифровать свои данные
				$col1 = security::insert_no_security_text($col1, $key_pass)
				$col2 = security::insert_no_security_text($col2, $key_pass)
				$col3 = security::insert_no_security_text($col3, $key_pass)
				$col4 = security::insert_no_security_text($col4, $key_pass)
				$col5 = security::insert_no_security_text($col5, $key_pass)
			}
			*/
			
			$inserts = DB::table('user_base_'.$id_base)->insert(
				[
					'user_column_1' => $col1, 
					'user_column_2' => $col2, 
					'user_column_3' => $col3, 
					'user_column_4' => $col4, 
					'user_column_5' => $col5, 
					'private_key_id' => $private_key_id[0]['id'], 
				]
			);
			$arr[] = ["return"=>$inserts];
			return $arr;
		}
		catch(\Illuminate\Database\QueryException $e)
		{
			$arr = ["error" => "you do not have access to this database"];
			return $arr;
		}
    }
	
    public static function insert_records($token, $request)
    {
		//$token - токен пользователя для новой записи
		//$request - запрос
		$private_key_id = models_token_get::get_token_id($token);
		$name_param_get_col1 = 'col1';
		$name_param_get_col2 = 'col2';
		$name_param_get_col3 = 'col3';
		$name_param_get_col4 = 'col4';
		$name_param_get_col5 = 'col5';
		$key_pass = $request['key_pass'];
		
		$col1 = $request[$name_param_get_col1];
		$col2 = $request[$name_param_get_col2];
		$col3 = $request[$name_param_get_col3];
		$col4 = $request[$name_param_get_col4];
		$col5 = $request[$name_param_get_col5];
		if($key_pass != "")
		{
			//пользователь решил шифровать свои данные
			
			//$col1 = security::insert_no_security_text($col1, $key_pass);
			//$col2 = security::insert_no_security_text($col2, $key_pass);
			//$col3 = security::insert_no_security_text($col3, $key_pass);
			//$col4 = security::insert_no_security_text($col4, $key_pass);
			//$col5 = security::insert_no_security_text($col5, $key_pass);
		}
		if(isset($private_key_id[0]))
		{
			$inserts = DB::table('user_base')->insert(
				[
					'user_column_1' => $col1, 
					'user_column_2' => $col2, 
					'user_column_3' => $col3, 
					'user_column_4' => $col4, 
					'user_column_5' => $col5, 
					'private_key_id' => $private_key_id[0]['id'], 
				]
			);
			$arr[] = ["return"=>$inserts];
			return $arr;
		}
		else
		{
			$arr = ["error" => "you do not have access to this database"];
			return $arr;
		}
    }
}
