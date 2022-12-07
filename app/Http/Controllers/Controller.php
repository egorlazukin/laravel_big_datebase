<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public function get_token($id, $token_admin)
	{
		header('Content-Type: application/json; charset=utf-8');
		$get_token = \App\models_token_get::get_token($id, $token_admin);		
		return json_encode($get_token);
	}
	
	public function get_count_records($token)
	{
		header('Content-Type: application/json; charset=utf-8');
		$get_token = \App\models_token_get::get_count_records($token);	
		return json_encode($get_token);
	}
	
	public function insert_records($token, Request $request)
	{
		header('Content-Type: application/json; charset=utf-8');
		$get_token = \App\model_insert::insert_records($token, $request);	
		return json_encode($get_token);
	}
	
	public function get_records($token, $limit = 100, $offset = 0)
	{
		header('Content-Type: application/json; charset=utf-8');
		$get_token = \App\models_token_get::get_records($token, $limit, $offset);	
		return json_encode($get_token);
	}
	
	public function get_records_private($token, $id_base, $limit, $offset)
	{
		header('Content-Type: application/json; charset=utf-8');
		$get_token = \App\models_token_get::get_records_private($token, $limit, $offset, $id_base);	
		return json_encode($get_token);
	}
	
	public function insert_records_private($token, Request $request, $id_base)
	{
		header('Content-Type: application/json; charset=utf-8');
		$get_token = \App\model_insert::insert_records_private($token, $request, $id_base);	
		return json_encode($get_token);
	}
	
	public function Create_New_Table($token, Request $request)
	{
		header('Content-Type: application/json; charset=utf-8');
		$get_token = \App\models_token_get::Create_New_Table($token, $request);	
		return json_encode($get_token);
	}
}
