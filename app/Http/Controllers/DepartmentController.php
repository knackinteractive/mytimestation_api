<?php

namespace App\Http\Controllers;

use DB;
use App\Department;
use App\WebUser;
use App\EmployeeSecondaryDepts;
use App\Employee;
use App\EmpDept;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function editDepartment(Request $request){
        $dept_id = $request->id;
        $webuserid = $request->webuser_id;
        $department = new Department();
        $department->name = $request->name;
        $department->type = $request->dept_type;
        DB::update('update department set name = ?, type=? where id=?', [$department->name,$department->type,$dept_id]);
        $is_exclude_from_rep = 0;
        $department->is_exclude_from_reporting = $is_exclude_from_rep;
        if($request->has('is_exclude_from_rep')){
            $is_exclude_from_rep = 1;
            $department->is_exclude_from_reporting = $is_exclude_from_rep;
            DB::update('update department set is_exclude_from_reporting = 1 where id=?', [$dept_id]);
        
        }else{
            $department->is_exclude_from_reporting = 0;
            DB::update('update department set is_exclude_from_reporting = 0 where id=?', [$dept_id]);
        }
        $is_use_comp_sett = 0;
        $department->is_use_company_setting = $is_use_comp_sett;
        if($request->has('is_use_comp_sett')){
            $is_use_comp_sett = 1;
            $department->is_use_company_setting = $is_use_comp_sett;
            DB::update('update department set is_use_company_setting = 1 where id=?', [$dept_id]);
            $chkresults = WebUser::where('id', "$webuserid")->get();
            if(count($chkresults)>0){
                $department->deduct = WebUser::where('id', "$webuserid")->value('auto_time_deduct');
                $department->hours = WebUser::where('id', "$webuserid")->value('attndnce_every_hours');
                DB::update('update department set deduct = ?, hours=? where id=?', [$department->deduct,$department->hours,$dept_id]);
            }
        }else{
            DB::update('update department set is_use_company_setting = 0 where id=?', [$dept_id]);
            $department->deduct = $request->auto_time_deduct;
            $department->hours = $request->attndnce_every_hours;
            DB::update('update department set deduct = ?, hours=? where id=?', [$department->deduct,$department->hours,$dept_id]);
            
        }
        $is_assign_to_all_emp = 0;
        $department->is_assign_to_all_emp = $is_assign_to_all_emp;
        if($request->has('is_assign_to_all_emp')){
            $is_assign_to_all_emp = 1;
            $department->is_assign_to_all_emp = $is_assign_to_all_emp;
            DB::update('update department set is_assign_to_all_emp = 1 where id=?', [$dept_id]);

            $empArray = DB::select("Select id from Employee where created_by=?",[$webuserid]);
            foreach($empArray as $empp){
                $empidd = $empp->id;
                $empsecdept = new EmployeeSecondaryDepts();
                $empsecdept->emp_id = $empidd;
                $empsecdept->dept_id = $dept_id;
                $empsecdept->is_primary = 1;
                $empsecdept->save();

            }
        }else{
            DB::update('update department set is_assign_to_all_emp = 0 where id=?', [$dept_id]);
            $empArray = DB::select("Select id from Employee where created_by=?",[$webuserid]);
            foreach($empArray as $empp){
                $empidd = $empp->id;
                $empArray = DB::select("DELETE FROM employee_secondary_depts where emp_id=? and dept_id=?",[$empidd,$dept_id]);

            }
        }
        return response()->json([
            'success' => true,
            'result' => $department
        ]);



    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $department = new Department();
        $webuserid = $request->webuser_id;
        $department->name = $request->name;
        $department->type = $request->dept_type;
        $is_exclude_from_rep = 0;
        $department->is_exclude_from_reporting = $is_exclude_from_rep;
        if($request->has('is_exclude_from_rep')){
            $is_exclude_from_rep = 1;
            $department->is_exclude_from_reporting = $is_exclude_from_rep;
        }
        $is_use_comp_sett = 0;
        $department->is_use_company_setting = $is_use_comp_sett;
        if($request->has('is_use_comp_sett')){
            $is_use_comp_sett = 1;
            $department->is_use_company_setting = $is_use_comp_sett;
            $chkresults = WebUser::where('id', "$webuserid")->get();
            if(count($chkresults)>0){
                $department->deduct = WebUser::where('id', "$webuserid")->value('auto_time_deduct');
                $department->hours = WebUser::where('id', "$webuserid")->value('attndnce_every_hours');
            }
        }else{
            $department->deduct = $request->auto_time_deduct;
            $department->hours = $request->attndnce_every_hours;
        }
        $is_assign_to_all_emp = 0;
        $department->is_assign_to_all_emp = $is_assign_to_all_emp;
        if($request->has('is_assign_to_all_emp')){
            $is_assign_to_all_emp = 1;
            $department->is_assign_to_all_emp = $is_assign_to_all_emp;
            
            $maxdeptid = DB::select("select ifnull(max(id),0) as maxid from department");
            $max_id = 0;
            foreach($maxdeptid as $maxid){
                $max_id = $maxid->maxid;
            }
            $max_id+=1;

            $empArray = DB::select("Select id from Employee where created_by=?",[$webuserid]);
            foreach($empArray as $empp){
                $empidd = $empp->id;
                $empsecdept = new EmployeeSecondaryDepts();
                $empsecdept->emp_id = $empidd;
                $empsecdept->dept_id = $max_id;
                $empsecdept->is_primary = 1;
                $empsecdept->save();

            }
        }
        $department->created_by = $request->webuser_id;
        $department->save();
        return response()->json([
            'success' => true,
            'result' => $department
        ]);

    }
    
    public function getAllDepartments(Request $request){
        $webuserid = $request->webuserid;
        $results = DB::select('select * from department where created_by=?',[$webuserid]);
        if(count($results) > 0){
            return response()->json([
                'success' => true,
                'result' => $results
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Sorry, department do not exist!'
            ], 500);
        }

    }

    public function searchDepartment(Request $request){
        $name = $request->name;
        $webuserid = $request->webuserid;
        if($name == ""){
            $results = DB::select('select * from department where created_by=?',[$webuserid]);
            if(count($results) > 0){
                return response()->json([
                    'success' => true,
                    'result' => $results
                ]);
            }
            
        }
        $results = DB::select('select * from department where name=? and created_by=?',[$name,$webuserid]);
        if(count($results) > 0){
            return response()->json([
                'success' => true,
                'result' => $results
            ]);
        }
        else{

            $typename = 0;
            if(strtolower($name) == "class"){
                $typename = 1;
            }else if(strtolower($name) == "client"){
                $typename = 2;
            }else if(strtolower($name) == "department"){
                $typename = 3;
            }else if(strtolower($name) == "group"){
                $typename = 4;
            }else if(strtolower($name) == "job"){
                $typename = 5;
            }else if(strtolower($name) == "job site"){
                $typename = 6;
            }else if(strtolower($name) == "location"){
                $typename = 7;
            }else if(strtolower($name) == "office"){
                $typename = 8;
            }else if(strtolower($name) == "project"){
                $typename = 9;
            }else if(strtolower($name) == "task"){
                $typename = 10;
            }

            $results = DB::select('select * from department where type=? and created_by=?',[$typename,$webuserid]);
            if(count($results) > 0){
                return response()->json([
                    'success' => true,
                    'result' => $results
                ]);
            }
        }
        return response()->json([
            'success' => false,
            'message' => 'Sorry, Department do not exist!'
        ], 500);
    }
    public function getDepartmentById(Request $request){
        $dept_id = $request->dept_id;
        $results = DB::select('select * from department where id=?',[$dept_id]);
            if(count($results) > 0){
                return response()->json([
                    'success' => true,
                    'result' => $results
                ]);
            }

    }
    
}
