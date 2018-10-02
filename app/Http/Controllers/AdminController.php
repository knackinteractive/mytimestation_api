<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\WebUser;
use App\AdminDeptAccess;
use DB;

class AdminController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);
        
        $admin = new WebUser();
        $admin->company_name = $request->name;
        $admin->email = $request->email;
        $admin->password = $request->password;
        $admin->created_by = $request->webuser_id;
        $admin->is_admin = 1;
        $webuserid = $request->webuser_id;
        $department_access = $request->department_access; //0 for all dept, 1 for selected
        $perm = $request->perm_type;
        $maxadminid = DB::select("select ifnull(max(id),0) as maxid from web_user");
        $max_id = 0;
        foreach($maxadminid as $maxid){
            $max_id = $maxid->maxid;
        }
        $max_id+=1;

        if($department_access == "0"){
            //all departments
            if($perm == "0"){
                //all perms
                $admin->perm_type = 0;//full
                $admin->is_Authorize_TS_Devices = 1;
                $admin->is_Create_Edit_Admin = 1;
                $admin->is_Create_Edit_Dept = 1;
                $admin->is_Create_Edit_Emp = 1;
                $admin->is_Create_Time_Entries = 1;
                $admin->is_Edit_Company_Settings = 1;
                $admin->is_Edit_Time_Entries = 1;
                $admin->is_Manage_Billing_Plan = 1;
                $admin->is_Print_Employee_Cards = 1;
                $admin->is_Run_Reports = 1;
                $admin->is_View_GPS_location = 1;
                $admin->is_View_Pay_Info = 1;

                $admin->save();
                $admin_orig_id = DB::select("select id from web_user where email=?",[$admin->email]);
                $admin_idd = 0;
                foreach($admin_orig_id as $adminid){
                    $admin_idd = $adminid->id;
                }
                $dept_ids = DB::select("select id from department where created_by=?",[$webuserid]);
                foreach($dept_ids as $dept_id){
                    $admin_dept_access = new AdminDeptAccess();
                    $admin_dept_access->admin_id = $admin_idd;
                    $admin_dept_access->dept_id = $dept_id->id;
                    $admin_dept_access->save();
                }

                return response()->json([
                    'success' => true,
                    'result' => $admin
                ]);

            }else if($perm == "1"){
                $admin->perm_type = 1;//partial
                $perm_array = $request->perms;
                if(in_array("1",$perm_array)){
                    $admin->is_Authorize_TS_Devices = 1;
                }
                if(in_array("2",$perm_array)){
                    $admin->is_Create_Edit_Admin = 1;
                }
                if(in_array("3",$perm_array)){
                    $admin->is_Create_Edit_Dept = 1;
                }
                if(in_array("4",$perm_array)){
                    $admin->is_Create_Edit_Emp = 1;
                }
                if(in_array("5",$perm_array)){
                    $admin->is_Create_Time_Entries = 1;
                }
                if(in_array("6",$perm_array)){
                    $admin->is_Edit_Company_Settings = 1;
                }
                if(in_array("7",$perm_array)){
                    $admin->is_Edit_Time_Entries = 1;
                }
                if(in_array("8",$perm_array)){
                    $admin->is_Manage_Billing_Plan = 1;
                }
                if(in_array("9",$perm_array)){
                    $admin->is_Print_Employee_Cards = 1;
                }
                if(in_array("10",$perm_array)){
                    $admin->is_Run_Reports = 1;
                }
                if(in_array("11",$perm_array)){
                    $admin->is_View_GPS_location = 1;
                }
                if(in_array("12",$perm_array)){
                    $admin->is_View_Pay_Info = 1;
                }
                $admin->save();

                $admin_orig_id = DB::select("select id from web_user where email=?",[$admin->email]);
                $admin_idd = 0;
                foreach($admin_orig_id as $adminid){
                    $admin_idd = $adminid->id;
                }
                $dept_ids = DB::select("select id from department where created_by=?",[$webuserid]);
                foreach($dept_ids as $dept_id){
                    $admin_dept_access = new AdminDeptAccess();
                    $admin_dept_access->admin_id = $admin_idd;
                    $admin_dept_access->dept_id = $dept_id->id;
                    $admin_dept_access->save();
                }

                return response()->json([
                    'success' => true,
                    'result' => $admin
                ]);
            }

        }else if($department_access == "1"){
            //selected departments
            if($perm == "0"){
                //all perms
                $admin->perm_type = 0;//full
                $admin->is_Authorize_TS_Devices = 1;
                $admin->is_Create_Edit_Admin = 1;
                $admin->is_Create_Edit_Dept = 1;
                $admin->is_Create_Edit_Emp = 1;
                $admin->is_Create_Time_Entries = 1;
                $admin->is_Edit_Company_Settings = 1;
                $admin->is_Edit_Time_Entries = 1;
                $admin->is_Manage_Billing_Plan = 1;
                $admin->is_Print_Employee_Cards = 1;
                $admin->is_Run_Reports = 1;
                $admin->is_View_GPS_location = 1;
                $admin->is_View_Pay_Info = 1;

                $admin->save();

                $admin_orig_id = DB::select("select id from web_user where email=?",[$admin->email]);
                $admin_idd = 0;
                foreach($admin_orig_id as $adminid){
                    $admin_idd = $adminid->id;
                }
                $dept_array = $request->depts;
                foreach($dept_array as $dept_id){
                    $admin_dept_access = new AdminDeptAccess();
                    $admin_dept_access->admin_id = $admin_idd;
                    $admin_dept_access->dept_id = $dept_id;
                    $admin_dept_access->save();
                }

                return response()->json([
                    'success' => true,
                    'result' => $admin
                ]);

            }else if($perm == "1"){
                $admin->perm_type = 1;//partial
                $perm_array = $request->perms;
                if(in_array("1",$perm_array)){
                    $admin->is_Authorize_TS_Devices = 1;
                }
                if(in_array("2",$perm_array)){
                    $admin->is_Create_Edit_Admin = 1;
                }
                if(in_array("3",$perm_array)){
                    $admin->is_Create_Edit_Dept = 1;
                }
                if(in_array("4",$perm_array)){
                    $admin->is_Create_Edit_Emp = 1;
                }
                if(in_array("5",$perm_array)){
                    $admin->is_Create_Time_Entries = 1;
                }
                if(in_array("6",$perm_array)){
                    $admin->is_Edit_Company_Settings = 1;
                }
                if(in_array("7",$perm_array)){
                    $admin->is_Edit_Time_Entries = 1;
                }
                if(in_array("8",$perm_array)){
                    $admin->is_Manage_Billing_Plan = 1;
                }
                if(in_array("9",$perm_array)){
                    $admin->is_Print_Employee_Cards = 1;
                }
                if(in_array("10",$perm_array)){
                    $admin->is_Run_Reports = 1;
                }
                if(in_array("11",$perm_array)){
                    $admin->is_View_GPS_location = 1;
                }
                if(in_array("12",$perm_array)){
                    $admin->is_View_Pay_Info = 1;
                }
                $admin->save();

                $admin_orig_id = DB::select("select id from web_user where email=?",[$admin->email]);
                $admin_idd = 0;
                foreach($admin_orig_id as $adminid){
                    $admin_idd = $adminid->id;
                }
                $dept_array = $request->depts;
                foreach($dept_array as $dept_id){
                    $admin_dept_access = new AdminDeptAccess();
                    $admin_dept_access->admin_id = $admin_idd;
                    $admin_dept_access->dept_id = $dept_id;
                    $admin_dept_access->save();
                }

                return response()->json([
                    'success' => true,
                    'result' => $admin
                ]);
            }

        }
    }
    public function getAllAdmins(Request $request){
        $this->validate($request, [
            'webuser_id' => 'required'
        ]);
        $webuserid = $request->webuser_id;
        $admins = DB::select("select * from web_user where is_admin=1 and created_by=?",[$webuserid]);
        return response()->json([
            'success' => true,
            'result' => $admins
        ]); 
    }
}
