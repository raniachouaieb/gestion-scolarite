<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\Parente;
use App\Http\Requests\ForgotPassRequest;
use App\Http\Requests\ResetPassRequest;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;




class ForgotPasswordController extends Controller
{



    public function forgotPassword(){

        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);

        return  response()->json( 'Reset password link sent on your email id.',200);

        /*if(Parente::where('email', $email)->doesntExist()){
            return response ([
                'message'=>'Parent doesn\'t exist!'
            ], 404);
        }

        $token = Str::random(10);
      try{
            DB::table('password_resets')->insert([
                'email'=> $email,
                'token'=>$token
            ]);

          //send email

          Mail::send('mails.forgotPass', ['token'=>$token], function(Message $message) use($email){
              $message->to($email);
              $message->subject('Reset your password');
          });

            return response([
                'message'=>'check your email'
            ]);
        }catch(\Exception $exception){
            return response ([
                'message'=>$exception->getMessage()
            ]);
          }*/

    }

    public function reset(ResetPassRequest $request){


        $reset_password_status = Password::reset($request->validated(), function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
             return response()->json((ApiCode::INVALID_RESET_PASSWORD_TOKEN));
        }

        return response()->json(("Password has been successfully changed"));
    }



}
