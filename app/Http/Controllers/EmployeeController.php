<?php

namespace App\Http\Controllers;

use DB;
use App\Employee;
use App\EmployeeSecondaryDepts;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'department' => 'required'
        ]);
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->dept_id = $request->department;
        if($request->has('emp_id')){
            $employee->emp_id = $request->emp_id;
        }
        if($request->has('title')){
            $employee->title = $request->title;
        }
        if($request->has('hourly_rate')){
            $employee->hourly_rate = $request->hourly_rate;
        }
        if($request->has('four_digit_pin')){
            $employee->four_digit_pin = $request->four_digit_pin;
        }
        if($request->has('is_notifications')){
            $employee->is_notifications = $request->is_notifications;
        }
        if($request->has('is_noti_email')){
            $employee->is_noti_email = $request->is_noti_email;
        }
        if($request->has('check_in_noti')){
            $employee->check_in_noti = $request->check_in_noti;
        }
        if($request->has('check_out_noti')){
            $employee->check_out_noti = $request->check_out_noti;
        }
        if($request->has('email')){
            $employee->email = $request->email;
        }
        if($request->has('password')){
            $employee->password = $request->password;
        }
        if($request->has('perm_is_login_to_timestamp_app')){
            $employee->perm_is_login_to_timestamp_app = $request->perm_is_login_to_timestamp_app;
        }
        if($request->has('perm_is_allow_other_employees')){
            $employee->perm_is_allow_other_employees = $request->perm_is_allow_other_employees;
        }
        if($request->has('perm_is_login_to_timestation_site')){
            $employee->perm_is_login_to_timestation_site = $request->perm_is_login_to_timestation_site;
        }
        if($request->has('perm_is_create_time_entries')){
            $employee->perm_is_create_time_entries = $request->perm_is_create_time_entries;
        }
        if($request->has('perm_is_edit_time_entries')){
            $employee->perm_is_edit_time_entries = $request->perm_is_edit_time_entries;
        }
        if($request->has('perm_is_punch_in_out')){
            $employee->perm_is_punch_in_out = $request->perm_is_punch_in_out;
        }
        if($request->has('perm_is_run_reports')){
            $employee->perm_is_run_reports = $request->perm_is_run_reports;
        }
        if($request->has('perm_is_view_gps_location_information')){
            $employee->perm_is_view_gps_location_information = $request->perm_is_view_gps_location_information;
        }
        if($request->has('perm_is_view_pay_information')){
            $employee->perm_is_view_pay_information = $request->perm_is_view_pay_information;
        }
        
        $employee->created_by = $request->webuser_id;
        if($employee->save()){
            return response()->json([
                'success' => true,
                'result' => $employee
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Unable to store Employee'
            ]);
        }
        // $input = $request->except('token');
        
        // $keys = array_keys($input);
        // $q = "";
        // $i=0;
        // foreach($input as $param){
        //     $q = $q.'"'.$keys[$i].'"'.":".'"'.$param.'"'.',';
        //     $i++;
        // }
        // $qq = rtrim($q,",");
        // return $qq;

            

        
        
        /*$employee = new Employee();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        if ($this->user->products()->save($product))
            return response()->json([
                'success' => true,
                'product' => $product
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product could not be added'
            ], 500);
            */
    }
    public function getAllEmployees(Request $request){
        $webuserid = $request->webuserid;
        $results = DB::select('select * from employee where created_by=?',[$webuserid]);
        if(count($results) > 0){
            return response()->json([
                'success' => true,
                'result' => $results
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Employee does not exist!'
            ], 500);
        }

    }
    public function getEmployeeById(Request $request){
        $id = $request->id;
        $webuserid = $request->webuserid;
        $results = DB::select('select * from employee where id=? and created_by=?',[$id,$webuserid]);
        if(count($results) > 0){
            return response()->json([
                'success' => true,
                'result' => $results
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Employee does not exist!'
            ], 500);
        }

    }

    public function getEmployeeByDeptId(Request $request){
        $id = $request->id;
        $webuserid = $request->webuserid;
        $results = DB::select('select * from employee where dept_id=? and created_by=?',[$id,$webuserid]);
        if(count($results) > 0){
            return response()->json([
                'success' => true,
                'result' => $results
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user do not exist!'
            ], 500);
        }

    }

    public function getEmployeeByDeptIdPrimary(Request $request){
        $id = $request->id;
        $webuserid = $request->webuserid;
        $results = DB::select('select * from employee where created_by=? and id in(select emp_id from emp_dept where dept_id=? and is_primary=1)',[$webuserid,$id]);
        //$results = DB::select('select * from employee where dept_id=? and ',[$id]);
        
        if(count($results) > 0){
            return response()->json([
                'success' => true,
                'result' => $results
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user do not exist!'
            ], 500);
        }

    }
    public function editEmployee(Request $request){
        $emp_id = $request->id;
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->dept_id = $request->department;
        if($request->has('emp_id')){
            $employee->emp_id = $request->emp_id;
        }
        if($request->has('title')){
            $employee->title = $request->title;
        }
        if($request->has('hourly_rate')){
            $employee->hourly_rate = $request->hourly_rate;
        }
        if($request->has('four_digit_pin')){
            $employee->four_digit_pin = $request->four_digit_pin;
        }
        if($request->has('is_notifications')){
            $employee->is_notifications = $request->is_notifications;
            DB::update('update employee set is_notifications = 1 where id=?', [$emp_id]);
        }else{
            DB::update('update employee set is_notifications = 0 where id=?', [$emp_id]);
        }
        if($request->has('is_noti_email')){
            $employee->is_noti_email = $request->is_noti_email;
            DB::update('update employee set is_noti_email = ? where id=?', [$employee->is_noti_email,$emp_id]);
        }
        if($request->has('check_in_noti')){
            $employee->check_in_noti = $request->check_in_noti;
            DB::update('update employee set check_in_noti = 1 where id=?', [$emp_id]);
        }else{
            DB::update('update employee set check_in_noti = 0 where id=?', [$emp_id]);
        }
        if($request->has('check_out_noti')){
            $employee->check_out_noti = $request->check_out_noti;
            DB::update('update employee set check_out_noti = 1 where id=?', [$emp_id]);
        }else{
            DB::update('update employee set check_out_noti = 0 where id=?', [$emp_id]);
        }
        if($request->has('email')){
            $employee->email = $request->email;
        }
        if($request->has('password')){
            $employee->password = $request->password;
        }
        if($request->has('perm_is_login_to_timestamp_app')){
            $employee->perm_is_login_to_timestamp_app = $request->perm_is_login_to_timestamp_app;
            DB::update('update employee set perm_is_login_to_timestamp_app = 1 where id=?', [$emp_id]);
        
        }else{
            DB::update('update employee set perm_is_login_to_timestamp_app = 0 where id=?', [$emp_id]);
        }
        if($request->has('perm_is_allow_other_employees')){
            $employee->perm_is_allow_other_employees = $request->perm_is_allow_other_employees;
            DB::update('update employee set perm_is_allow_other_employees = 1 where id=?', [$emp_id]);
        
        }else{
            DB::update('update employee set perm_is_allow_other_employees = 0 where id=?', [$emp_id]);
        }
        if($request->has('perm_is_login_to_timestation_site')){
            $employee->perm_is_login_to_timestation_site = $request->perm_is_login_to_timestation_site;
            DB::update('update employee set perm_is_login_to_timestation_site = 1 where id=?', [$emp_id]);
        
        }else{
            DB::update('update employee set perm_is_login_to_timestation_site = 0 where id=?', [$emp_id]);
        
        }
        if($request->has('perm_is_create_time_entries')){
            $employee->perm_is_create_time_entries = $request->perm_is_create_time_entries;
            DB::update('update employee set perm_is_create_time_entries = 1 where id=?', [$emp_id]);
        }else{
            DB::update('update employee set perm_is_create_time_entries = 0 where id=?', [$emp_id]);
        }

        if($request->has('perm_is_edit_time_entries')){
            $employee->perm_is_edit_time_entries = $request->perm_is_edit_time_entries;
            DB::update('update employee set perm_is_edit_time_entries = 1 where id=?', [$emp_id]);
        
        }else{
            DB::update('update employee set perm_is_edit_time_entries = 0 where id=?', [$emp_id]);
        }
        if($request->has('perm_is_punch_in_out')){
            $employee->perm_is_punch_in_out = $request->perm_is_punch_in_out;
            DB::update('update employee set perm_is_punch_in_out = 1 where id=?', [$emp_id]);
        
        }else{
            DB::update('update employee set perm_is_punch_in_out = 0 where id=?', [$emp_id]);
        }
        if($request->has('perm_is_run_reports')){
            $employee->perm_is_run_reports = $request->perm_is_run_reports;
            DB::update('update employee set perm_is_run_reports = 1 where id=?', [$emp_id]);
        
        }else{
            DB::update('update employee set perm_is_run_reports = 0 where id=?', [$emp_id]);
        }
        if($request->has('perm_is_view_gps_location_information')){
            $employee->perm_is_view_gps_location_information = $request->perm_is_view_gps_location_information;
            DB::update('update employee set perm_is_view_gps_location_information = 1 where id=?', [$emp_id]);
        
        }else{
            DB::update('update employee set perm_is_view_gps_location_information = 0 where id=?', [$emp_id]);
        
        }
        if($request->has('perm_is_view_pay_information')){
            $employee->perm_is_view_pay_information = $request->perm_is_view_pay_information;
            DB::update('update employee set perm_is_view_pay_information = 1 where id=?', [$emp_id]);
        
        }else{
            DB::update('update employee set perm_is_view_pay_information = 0 where id=?', [$emp_id]);
        
        }

        DB::update('update employee set name = ?, dept_id=?, emp_id=?, title=?, hourly_rate=?,four_digit_pin=?, email=?, password=? where id=?', 
        [$employee->name,$employee->dept_id,$employee->emp_id,$employee->title,$employee->hourly_rate,$employee->four_digit_pin,$employee->email,$employee->password,$emp_id]);
        return response()->json([
            'success' => true,
            'result' => $employee
        ]);
    }
    public function searchEmployee(Request $request){   
        $name = $request->name;
        $dept_id = $request->dept_id;//0 for all
        $is_show_current_dept=false;

        $webuserid = $request->webuser_id;
        if($request->has('show_current_dept')){
            $is_show_current_dept = true;
        }
        $status = $request->status;//0 for all .. 1 for in .. 2 for out

        $is_show_deleted_emp=false;
        if($request->has('is_show_deleted_emp')){
            $is_show_deleted_emp = true;
        }

        if($name != ""){
            $namekey = "";
            // To find on which base to search
            $chkresults = Employee::where('name', "$name")->where('created_by',"$webuserid")->get();
            $chkresults1 = Employee::where('email', "$name")->where('created_by',"$webuserid")->get();
            $chkresults2 = Employee::where('title', "$name")->where('created_by',"$webuserid")->get();
            $chkresults3 = Employee::where('emp_id', "$name")->where('created_by',"$webuserid")->get();
            if(count($chkresults) > 0){
                $namekey="name";
            }else if(count($chkresults1) > 0){
                $namekey="email";
            }else if(count($chkresults2) > 0){
                $namekey="title";
            }else if(count($chkresults3) > 0){
                $namekey="emp_id";
            }
            
            /*for name*/

            //when all depts are selected .. no limit on dept then
            if($dept_id == 0){
                //when status is not affecting search
                if($status==0){
                    $results = Employee::where("$namekey", "$name")
                                    ->get();
                    if(count($results) > 0){
                        return response()->json([
                            'success' => true,
                            'show_current_dept' => $is_show_current_dept,
                            'is_show_deleted_emp' => $is_show_deleted_emp,
                            'result' => $results
                        ]);
                    }
                    else{
                        return response()->json([
                            'success' => false,
                            'message' => 'Sorry, user do not exist!'
                        ], 500);
                    }
                }//when status must include in query
                else{
                    $results = Employee::where("$namekey", "$name")
                                        ->where('status',"$status")
                                    ->get();
                    if(count($results) > 0){
                        return response()->json([
                            'success' => true,
                            'show_current_dept' => $is_show_current_dept,
                            'is_show_deleted_emp' => $is_show_deleted_emp,
                            'result' => $results
                        ]);
                    }
                    else{
                        return response()->json([
                            'success' => false,
                            'message' => 'Sorry, user do not exist!'
                        ], 500);
                    }    
                }
                
            }//when any dept is selected
            else{
                //when status is not affecting search
                if($status==0){
                    $results = Employee::where("$namekey", "$name")
                                        ->where('dept_id',$dept_id)
                                        ->get();
                    if(count($results) > 0){
                        return response()->json([
                            'success' => true,
                            'show_current_dept' => $is_show_current_dept,
                            'is_show_deleted_emp' => $is_show_deleted_emp,
                            'result' => $results
                        ]);
                    }
                    else{
                        return response()->json([
                            'success' => false,
                            'message' => 'Sorry, user do not exist!'
                        ], 500);
                    }
                }else{
                    $results = Employee::where("$namekey", "$name")
                                        ->where('dept_id',$dept_id)
                                        ->where('status',$status)
                                        ->get();
                    if(count($results) > 0){
                        return response()->json([
                            'success' => true,
                            'show_current_dept' => $is_show_current_dept,
                            'is_show_deleted_emp' => $is_show_deleted_emp,
                            'result' => $results
                        ]);
                    }
                    else{
                        return response()->json([
                            'success' => false,
                            'message' => 'Sorry, user do not exist!'
                        ], 500);
                    }
                }
            }
            /*End for name*/
        }else{
            if($dept_id == 0){
                //when status is not affecting search
                if($status==0){
                    $results = DB::select('select * from employee');
                    if(count($results) > 0){
                        return response()->json([
                            'success' => true,
                            'result' => $results
                        ]);
                    }
                    else{
                        return response()->json([
                            'success' => false,
                            'message' => 'Sorry, user do not exist!'
                        ], 500);
                    }
                }//when status must include in query
                else{
                    $results = Employee::where('status',"$status")
                                    ->get();
                    if(count($results) > 0){
                        return response()->json([
                            'success' => true,
                            'result' => $results
                        ]);
                    }
                    else{
                        return response()->json([
                            'success' => false,
                            'message' => 'Sorry, user do not exist!'
                        ], 500);
                    }    
                }
                
            }//when any dept is selected
            else{
                //when status is not affecting search
                if($status==0){
                    $results = Employee::where('dept_id',$dept_id)
                                        ->get();
                    if(count($results) > 0){
                        return response()->json([
                            'success' => true,
                            'result' => $results
                        ]);
                    }
                    else{
                        return response()->json([
                            'success' => false,
                            'message' => 'Sorry, user do not exist!'
                        ], 500);
                    }
                }else{
                    $results = Employee::where('dept_id',$dept_id)
                                        ->where('status',$status)
                                        ->get();
                    if(count($results) > 0){
                        return response()->json([
                            'success' => true,
                            'result' => $results
                        ]);
                    }
                    else{
                        return response()->json([
                            'success' => false,
                            'message' => 'Sorry, user do not exist!'
                        ], 500);
                    }
                }
            }




        }
    }
    public function getCountOfEmployeesbyDeptId(Request $request){ 
        $dept_id = $request->dept_id;
        $totalcount = 0;
        $results = Employee::where('dept_id',$dept_id)
                                    ->get();
        if(count($results) > 0){
            $totalcount += count($results);
        }

        $results = EmployeeSecondaryDepts::where('dept_id',$dept_id)
                                    ->get();
        if(count($results) > 0){
            $totalcount += count($results);
        }
        return response()->json([
            'success' => true,
            'count' => $totalcount
        ], 200);

    }
    public function getCountOfPrimaryEmployeesbyDeptId(Request $request){ 
        $dept_id = $request->dept_id;
        $totalcount = 0;
        $results = Employee::where('dept_id',$dept_id)
                                    ->where('is_primary','1')
                                    ->get();
        if(count($results) > 0){
            $totalcount += count($results);
        }

        $results = EmployeeSecondaryDepts::where('dept_id',$dept_id)
                                    ->where('is_primary','1')
                                    ->get();
        if(count($results) > 0){
            $totalcount += count($results);
        }
        return response()->json([
            'success' => true,
            'count' => $totalcount
        ], 200);
    }

    public function getCountOfInEmployeesbyDeptId(Request $request){ 
        $dept_id = $request->dept_id;
        $totalcount = 0;
        $results = Employee::where('dept_id',$dept_id)
                                    ->where('status','1')
                                    ->get();
        if(count($results) > 0){
            $totalcount += count($results);
        }

        $results = EmployeeSecondaryDepts::where('dept_id',$dept_id)
                                    ->get();
        if(count($results) > 0){
            $totalcount += count($results);
        }
        return response()->json([
            'success' => true,
            'count' => $totalcount
        ], 200);
    }

    public function getCountOfOutEmployeesbyDeptId(Request $request){ 
        $dept_id = $request->dept_id;
        $totalcount = 0;
        $results = Employee::where('dept_id',$dept_id)
                                    ->where('status','2')
                                    ->get();
        if(count($results) > 0){
            $totalcount += count($results);
        }

        $results = EmployeeSecondaryDepts::where('dept_id',$dept_id)
                                    ->get();
        if(count($results) > 0){
            $totalcount += count($results);
        }
        return response()->json([
            'success' => true,
            'count' => $totalcount
        ], 200);
    }

    public function filterMembership(Request $request){
        $dept_id = $request->dept_id;
        $webuserid = $request->webuser_id;
        //when all depts are selected .. no limit on dept then
        if($dept_id == 0){
            if($request->has('is_primary')){
                $results = Employee::where("is_primary", "1")
                                ->where("created_by",$webuserid)
                                ->get();
                if(count($results) > 0){
                    return response()->json([
                        'success' => true,
                        'result' => $results
                    ]);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Sorry, user do not exist!'
                    ], 500);
                }
            }else{
                $results = DB::select('select * from employee where created_by=?',[$webuserid]);
                if(count($results) > 0){
                    return response()->json([
                        'success' => true,
                        'result' => $results
                    ]);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Sorry, employee do not exist!'
                    ], 500);
                }
            }
            
        }//when any dept is selected
        else{
            if($request->has('is_primary')){
                $results = Employee::where('dept_id', $dept_id)
                                    ->where('is_primary','1')
                                    ->where('created_by',$webuserid)
                                    ->get();
                if(count($results) > 0){
                    return response()->json([
                        'success' => true,
                        'result' => $results
                    ]);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Sorry, employee do not exist!'
                    ], 500);
                }
            }else{
                $results = Employee::where('dept_id', $dept_id)->where('created_by',$webuserid)->get();
                if(count($results) > 0){
                    return response()->json([
                        'success' => true,
                        'result' => $results
                    ]);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Sorry, employee do not exist!'
                    ], 500);
                }
            }
            
        }




    }
    public function updateHourlyRateByEmpArray(Request $request){
        $emp_array = $request->emps;
        $rate_array = $request->rates;
        for($i=0;$i<count($emp_array);$i++){
            $empid = $emp_array[$i];
            $hrate = $rate_array[$i];
            $results = DB::update('update employee set hourly_rate=? where id=?',[$hrate,$empid]);
        }
        return response()->json([
            'success' => true,
            'result' => "records updated"
        ]);
    }

    public function updateHourlyRateByDepartmentArray(Request $request){
        $dept_array = $request->depts;
        $rate_array = $request->rates;
        $emp_id = $request->emp_id;
        for($i=0;$i<count($dept_array);$i++){
            $deptid = $dept_array[$i];
            $hrate = $rate_array[$i];
            $results = DB::update('update employee set hourly_rate=? where dept_id=? and id=?',[$hrate,$deptid,$emp_id]);
        }
        return response()->json([
            'success' => true,
            'result' => "records updated"
        ]);
    }

}
