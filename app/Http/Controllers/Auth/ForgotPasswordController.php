<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Str;

class ForgotPasswordController extends ApiController
{
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
              'email' => 'required|email|exists:users',
          ]);

        $token = Str::random(64);

        FacadesDB::table('password_resets')->insert([
              'email' => $request->email,
              'token' => $token,
              'created_at' => Carbon::now()
            ]);

        FacadesMail::send('email.forgetPassword', ['token' => $token, 'email' => $request->email,], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return $this->successResponse(['token' => $token, 'email' => $request->email], "E-mail de recuperaçao enviado para o e-mail informado, favor ferificar");
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);

        $updatePassword = FacadesDB::table('password_resets')
                              ->where([
                                'email' => $request->email,
                                'token' => $request->token
                              ])
                              ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
                      ->update(['password' => FacadesHash::make($request->password)]);

        FacadesDB::table('password_resets')->where(['email'=> $request->email])->delete();
        return true;
    }

    public function submitChangePasswordForm(Request $request)
    {
        $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);

        $user = User::where('email', $request->email)
                      ->update(['password' => FacadesHash::make($request->password)]);

        FacadesDB::table('password_resets')->where(['email'=> $request->email])->delete();
        return true;
    }
}
