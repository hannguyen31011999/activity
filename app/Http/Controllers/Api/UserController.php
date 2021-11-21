<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;
use JWTAuth;
use Hash;
use Crypt;

class UserController extends Controller
{
    private $expired = 60*24*30;

    public function userRegister(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name'=>'required|regex:[^[a-zA-Z]]|max:254',
                'email'=>'required|email|unique:user,email|max:254',
                'password'=>'required|min:6|max:254',
                'confirm_password'=>'required|same:password',
                'phone'=>'required|regex:/(0)[0-9]{9}/'
            ],
            [
                'phone.regex'=>'Number phone start 0 and maximum 10 number'
            ]
        );
        if($validator->fails()){
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()
            ]);
        }
        try {
            $input = $request->all();
            $input['isActive'] = 1;
            $input['role'] = 1;
            $input['password'] = Hash::make($input['password']);
            $result = User::create($input);
            if($result){
                return response()->json([
                    'code' => $this->codeSuccess,
                    'data' => $result
                ]);
            }
        }catch(Exception $e){
            return response()->json([
                'code' => $this->codeFails,
                'message' => 'Server error not response'
            ],$this->codeFails);
        }
    }

    // http://localhost:8000/api/login
    public function useLogin(Request $request)
    {
        $input = $request->only('email', 'password');
        JWTAuth::factory()->setTTL($this->expired);
        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'code' => 500,
                'message' => 'Email hoặc password không đúng',
            ],$this->codeSuccess);
        }
        if(JWTAuth::user()->isActive != 2){
            $data = [
                'id'=>JWTAuth::user()->id,
                'name'=>JWTAuth::user()->name,
                'email'=>JWTAuth::user()->email,
                'phone'=>JWTAuth::user()->phone,
                'role'=>JWTAuth::user()->role,
                'isActive'=>JWTAuth::user()->isActive,
            ];
            return response()->json([
                'code' => 200,
                'token' => $token,
                'data'=> $data,
                'timestamp' => [
                    'expired' => $this->expired,
                    'time' => Carbon::now()
                ]
            ],$this->codeSuccess);
        }else {
            return response()->json([
                'code' => 500,
                'message' => 'Tài khoản chưa được kích hoạt',
            ],$this->codeSuccess);
        }
    }

    public function userLogout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::parseToken());
            return response()->json([
                'code' => $this->codeSuccess,
                'message' => 'Đăng xuất thành công'
            ],$this->codeSuccess);
        } catch (JWTException $exception) {
            return response()->json([
                'code' => $this->codeFails,
                'message' => 'Lỗi server, vui lòng thử lại'
            ], $this->codeFails);
        }
    }
}
