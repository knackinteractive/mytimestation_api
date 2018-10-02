<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');

    Route::get('user', 'ApiController@getAuthUser');

    Route::get('products', 'ProductController@index');
    Route::get('products/{id}', 'ProductController@show');
    Route::post('products', 'ProductController@store');
    Route::put('products/{id}', 'ProductController@update');
    Route::delete('products/{id}', 'ProductController@destroy');

    Route::post('tsuser','WebuserController@store');
    Route::post('tsuser/login','WebuserController@login');
    Route::post('tsuser/update','WebuserController@updateAccountSetting');
    Route::get('tsuser/getbyid','WebuserController@getById');
    
    Route::post('employee','EmployeeController@store');
    Route::get('employee/getall','EmployeeController@getAllEmployees');
    Route::get('employee/getbyid','EmployeeController@getEmployeeById');
    Route::get('employee/getbydeptid','EmployeeController@getEmployeeByDeptId');
    Route::get('employee/getbydeptidprimary','EmployeeController@getEmployeeByDeptIdPrimary');
    Route::post('employee/edit','EmployeeController@editEmployee');
    Route::get('employee/getempcountbydeptid','EmployeeController@getCountOfEmployeesbyDeptId');
    Route::get('employee/getempcountbydeptidprimary','EmployeeController@getCountOfPrimaryEmployeesbyDeptId');
    Route::get('employee/getempincountbydeptid','EmployeeController@getCountOfInEmployeesbyDeptId');
    Route::get('employee/getempoutcountbydeptid','EmployeeController@getCountOfOutEmployeesbyDeptId');
    Route::get('employee/filtermembership','EmployeeController@filterMembership');
    Route::get('employee/updatehourlyratebyemp','EmployeeController@updateHourlyRateByEmpArray');
    Route::get('employee/updatehourlyratebydept','EmployeeController@updateHourlyRateByDepartmentArray');

    Route::get('employee/search','EmployeeController@searchEmployee');

    Route::post('department','DepartmentController@store');
    Route::post('department/edit','DepartmentController@editDepartment');
    Route::get('department/search','DepartmentController@searchDepartment');
    Route::get('department/getall','DepartmentController@getAllDepartments');
    Route::get('department/getbyid','DepartmentController@getDepartmentById');


    Route::post('admin','AdminController@store');
    Route::get('admin/getall','AdminController@getAllAdmins');
    
});
