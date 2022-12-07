<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class models_token_get extends Model
{
	
	//далее модели для управления бекендом и связи с БД
	public static function get_token($id, $adm_token)
    {
		//$id - пользовательский ID
		//$adm_token - токен админа
		$adm_key = DB::table('private_key_admin')
			->select('id') 
			-> where('key_1', '=', $adm_token) 
			->get();
		$adm_key = json_decode(json_encode($adm_key), true);
		
		if(empty($adm_key))
		{
			return null;
		}
		$users = DB::table('private_key') 
			->select('id', 'private_key_hash') 
			->where('user_id', '=', $id)
			->get();
		return $users;
	}
	
	public static function get_count_records($token)
    {
		//$token - токен пользователя для высчитывания количества записей
		$private_key_id = models_token_get::get_token_id($token);
		$users = DB::table('user_base')
			-> select()
			-> where('user_base.private_key_id', '=', $private_key_id)
			-> count();
		$arr[] = ["count" => $users];
		return $arr;
    }
	
	
	
	public static function get_records($token, $limit = 100, $offset = 0)
    {
		//$token - токен пользователя для высчитывания количества записей
		$private_key_id = models_token_get::get_token_id($token);
		
		$arr = DB::table('user_base')
			-> select('user_column_1', 'user_column_2', 'user_column_3', 'user_column_4', 'user_column_5')
			-> where('user_base.private_key_id', '=', $private_key_id)
			-> limit($limit)
			-> offset($offset)
			-> get();
		
		return $arr;
    }
	
	public static function get_records_private($token, $limit = 100, $offset = 0, $id_base)
    {
		//$token - токен пользователя для высчитывания количества записей
		try
		{
			$private_key_id = models_token_get::get_token_id($token);
			
			$arr = DB::table('user_base_'.$id_base)
				-> select('user_column_1', 'user_column_2', 'user_column_3', 'user_column_4', 'user_column_5')
				-> where('private_key_id', '=', $private_key_id)
				-> limit($limit)
				-> offset($offset)
				-> get();
			
			return $arr;
		}
		catch(\Illuminate\Database\QueryException $e)
		{
			$arr = ["error" => "you do not have access to this database"];
			return $arr;
		}
    }
	
	//Модели для управления базой
	public static function get_token_id($token)
	{
		$private_key = DB::table('private_key')
			->select('id') 
			-> where('private_key_hash', '=', $token) 
			->get();
		$private_key_id = json_decode(json_encode($private_key), true);
		return $private_key_id;
	}
	public static function Create_New_Table($token, $request)
	{
		try
		{
			$arr = "";
			foreach($_GET as $value)
			{
				$arr = $arr."`".$value."` TEXT COLLATE utf8mb4_unicode_ci DEFAULT NULL,";				
			}
			$rd_name = rand(1000, 9999);
			DB::insert('CREATE TABLE `z9_user_base_'.$rd_name.'` (
			`id` bigint(20) UNSIGNED NOT NULL,
			'.$arr.'
			`private_key_id` bigint(20) UNSIGNED DEFAULT NULL,
			`created_at` timestamp NULL DEFAULT NULL,
			`updated_at` timestamp NULL DEFAULT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			$arr = ["error" => "null", "id_database"=>$rd_name];
			return $arr;
		}
		catch(\Illuminate\Database\QueryException $e)
		{
			$arr = ["error" => "you do not have access to this database"];
			return $arr;
		}
	}
}