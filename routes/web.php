<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/api/get_private_key_admin/{id}/{token_admin}','Controller@get_token');//передать в параметрах id и token_admin

Route::get('/api/get_count_record/{token}', 'Controller@get_count_records');		//передать в параметрах токен

Route::get('/api/insert_records/{token}/', 'Controller@insert_records');	//передать в GET-параметрах col1...col5, key_pass


Route::get('/api/get_records/{token}/{limit}/{offset}', 'Controller@get_records');	//передать в параметрах token/limit/offset

Route::get('/api/get_records_private/{token}/{id_base}/{limit}/{offset}/', 'Controller@get_records_private');	//передать в параметрах token/id_base/limit/offset

Route::get('/api/insert_records_private/{token}/{id_base}', 'Controller@insert_records_private'); //передать в параметрах token/id_base/ в GET-параметрах col1...col5

Route::get('/api/create_new_table/{token}/', 'Controller@Create_New_Table');	//передать в параметрах token, а после в GET параметрах передать название столбцов