<?php

namespace App\Http\Controllers;

use App\WebUser;
use Illuminate\Http\Request;
use JWTAuth;
use DB;
class WebuserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function getById(Request $request){
        $id = $request->id;
        $results = DB::select('select * from web_user where id = ?', [$id]);
        return response()->json([
            'success' => true,
            'result' => $results
        ]);
    }

    public function store(Request $request){

        $this->validate($request, [
            'company_name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $WebUser = new WebUser();
        $WebUser->company_name = $request->company_name;
        $WebUser->email = $request->email;
        $WebUser->password = $request->password;

        if ($WebUser->save()){
            return response()->json([
                'success' => true
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user could not be added'
            ], 500);
        }
    }

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $email = $request->email;
        $password = $request->password;
        $results = DB::select('select * from web_user where email = ? and password = ?', [$email,$password]);
        if(count($results) > 0){
            foreach($results as $user){
                return response()->json([
                    'success' => true,
                    'result' => $user
                ]);
            }
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user do not exist!'
            ], 500);
        }
    }

    public function updateAccountSetting(Request $request){
        $company_name = $request->company_name;
        $webuserid = $request->webuser_id;
        DB::update('update web_user set company_name = ? where id=?', [$company_name,$webuserid]);
        $attendance_mode = $request->attendance_mode;
        DB::update('update web_user set attendance_mode = ? where id=?', [$attendance_mode,$webuserid]);

        if($request->has('is_enable_location_tagging')){
            $is_enable_location_tagging = $request->is_enable_location_tagging;
            DB::update('update web_user set is_enable_location_tagging = 1 where id=?', [$webuserid]);
            if($request->has('is_require_location')){
                $is_require_location = $request->is_require_location;
                DB::update('update web_user set is_require_location = 1 where id=?', [$webuserid]);
                
            }
        }
        $time_rounding = $request->time_rounding;
        DB::update('update web_user set time_rounding = ? where id=?', [$time_rounding,$webuserid]);
        if($request->has('is_display_time_round')){
            $is_display_time_round = $request->is_display_time_round;
            DB::update('update web_user set is_display_time_round = 1 where id=?', [$webuserid]);
        }

        $date_format = $request->date_format;
        DB::update('update web_user set date_format = ? where id=?', [$date_format,$webuserid]);
        
        $time_format = $request->time_format;
        DB::update('update web_user set time_format = ? where id=?', [$time_format,$webuserid]);
        
        $hours_format = $request->hours_format;
        DB::update('update web_user set hours_format = ? where id=?', [$hours_format,$webuserid]);
        
        $auto_time_deduct = $request->auto_time_deduct;
        DB::update('update web_user set auto_time_deduct = ? where id=?', [$auto_time_deduct,$webuserid]);
        
        $attndnce_every_hours = $request->attndnce_every_hours;
        DB::update('update web_user set attndnce_every_hours = ? where id=?', [$attndnce_every_hours,$webuserid]);
        
        $default_report_date_range = $request->default_report_date_range;
        DB::update('update web_user set default_report_date_range = ? where id=?', [$default_report_date_range,$webuserid]);
        
        if($request->has('is_include_today')){
            $is_include_today = $request->is_include_today;
            DB::update('update web_user set is_include_today = 1 where id=?', [$webuserid]);
        }   

        $card_info_1 = $request->card_info_1;
        DB::update('update web_user set card_info_1 = ? where id=?', [$card_info_1,$webuserid]);
        
        $card_info_2 = $request->card_info_2;
        DB::update('update web_user set card_info_2 = ? where id=?', [$card_info_2,$webuserid]);
        
        $card_info_3 = $request->card_info_3;
        DB::update('update web_user set card_info_3 = ? where id=?', [$card_info_3,$webuserid]);
        
        $card_info_4 = $request->card_info_1;
        DB::update('update web_user set card_info_4 = ? where id=?', [$card_info_4,$webuserid]);
        
        $card_font_size = $request->card_font_size;
        DB::update('update web_user set card_font_size = ? where id=?', [$card_font_size,$webuserid]);

        $results = DB::select('select * from web_user where id = ?', [$webuserid]);
        
        return response()->json([
            'success' => true,
            'user' => $results
        ]);
    }

    public function updateProfile(Request $request){
        $name = $request->name;
        $webuserid = $request->webuser_id;
        if($name == ""){
            //do nothing
        }else{
            DB::update('update web_user set company_name = ? where id=?', [$name,$webuserid]);
        }

        $old_email = "";
        $old_password = "";
        $results = DB::select('select * from web_user where id = ?', [$webuserid]);
        foreach($results as $row){
            $old_email = $row->email;
            $old_password = $row->password;
        }
        
        $email = $request->email;
        $current_password = $request->current_password;
        $new_password = $request->new_password;

        if($email != $old_email){
            if($current_password == $old_password){
                DB::update('update web_user set email = ? where id=?', [$email,$webuserid]);
            }else{
                return response()->json([
                    'success' => false,
                    'result' => 'Current password must be correct to change email'
                ]);
            }
        }

        if($new_password != ""){
            if($current_password == $old_password){
                DB::update('update web_user set password = ? where id=?', [$new_password,$webuserid]);
            }else{
                return response()->json([
                    'success' => false,
                    'result' => 'Invalid Current Password!'
                ]);
            }
        }

        $userr = DB::select('select * from web_user where id = ?', [$webuserid]);

        return response()->json([
            'success' => true,
            'message' => 'Successfully Updated!',
            'result' => $userr
        ]);

    }
    
}
