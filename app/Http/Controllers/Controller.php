<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendError($message,$data = []){

        $data['status'] = 0;

        return $this->sendSuccess($data,$message);

    }

    public function sendSuccess($data = [],$message = '')
    {
        if(is_string($data))
        {
            return response()->json([
                'message'=>$data,
                'status'=>true
            ]);
        }

        if(!isset($data['status'])) $data['status'] = 1;

        if($message)
            $data['message'] = $message;

        return response()->json($data);
    }


    public function checkPermission($permission = false)
    {
        if ($permission) {
            if (!Auth::id() or !Auth::user()->hasPermissionTo($permission)) {
                abort(403);
            }
        }
    }

    public function hasPermission($permission)
    {
        return Auth::user()->hasPermissionTo($permission);
    }





//    public function sendPushNotification(\App\User $user,\App\Models\Information $notification,$page="")
//    {	$res = $this->AccessTokenHuawei();
//        $res = json_decode($res);
//        $auth = $res->access_token;
//        $output="";
//        if ($user->is_huawei == 1) {
//
//            $output .= $this->sendNotificationHuawei($auth,$user->billing_country, $notification->title, $notification->description, $page);
//
//        } elseif(isset($user->billing_country)){ // android
//            $output.=  $this->sendNotification($user->billing_country,$notification->title,$notification->description,$page);
//        }
//        if(isset($user->billing_city)){ // ios
//            $output.= $this->sendNotification($user->billing_city,$notification->title,$notification->description,$page);
//
//        }
//
//    }


    public function sendNotification($token,$title,$body,$page)
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $notification = [
            'title' => $title,
            'body' =>  $body,
            'page' =>  $page,
            'sound' => true,
        ];

        $extraNotificationData = ["message" => $notification];
        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData,
        ];

        $headers = [
            'Authorization: key=AAAArA-v1Xo:APA91bFT2HX90ejcjKuWUzK1T3G27ocmJFie79CqHTbuScG4VMiP6D6b4t-0Qb_2WP1GqLLa0h6lkbcaEmEVfiyOInoCAF_zjqh0LZlr5vF_2nRsg67z8Qeyq9a5kYBGSy0MGSI09a_P',
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function AccessTokenHuawei()
    {
        $hcmUrl = 'https://oauth-login.cloud.huawei.com/oauth2/v3/token';
        $body = "grant_type=client_credentials&client_id=105052067&client_secret=225cbd2b8ef739db895a6d69cc336879cc4af7378a53777500ed675d8d24f555";
        $headers = array(
            "Content-Type: application/x-www-form-urlencoded",
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$hcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$body );
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    public function sendNotificationHuawei($auth,$token, $title, $body, $page)
    { //by DA

        //if (!isset($res->access_token))
        //{

        $hcmUrl ='https://push-api.cloud.huawei.com/v1/105052067/messages:send';
        if ($page == "travailafaire")
        {
            $body = '{
    "validate_only": false,
    "message": {
        "notification": {
            "title": "'.$title.'",
                "body": "'.$body.'"
        },
        "data": "{\'page\':\'travailafaire\'}",
        "android": {
            "urgency": "NORMAL",
            "ttl": "10000s",
            "notification": {
                "title": "'.$title.'",
                "body": "'.$body.'",
                "click_action": {
                    "type": 3
                }
            }
        },
        "token": [
            "'.$token.'"
        ]
    }
}';
        }
        elseif ($page == "convocation")
        {
            $body = '{
    "validate_only": false,
    "message": {
        "notification": {
            "title": "'.$title.'",
                "body": "'.$body.'"
        },
        "data": "{\'page\':\'convocation\'}",
        "android": {
            "urgency": "NORMAL",
            "ttl": "10000s",
            "notification": {
                "title": "'.$title.'",
                "body": "'.$body.'",

                "click_action": {
                    "type": 3
                }
            }
        },
        "token": [
            "'.$token.'"
        ]
    }
}';
        }
        else
        {
            $body = '{
    "validate_only": false,
    "message": {
        "notification": {
            "title": "'.$title.'",
            "body": "'.$body.'"
        },
        "data": "{\'page\':\'information\'}",
        "android": {
            "urgency": "NORMAL",
            "ttl": "10000s",
            "notification": {
                "title": "'.$title.'",
                "body": "'.$body.'",

                "click_action": {
                    "type": 3
                }
            }
        },
        "token": [
            "'.$token.'"
        ]
    }
}';}

        $headers = ['Authorization: Bearer ' . $auth,'Content-Type: application/json'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $hcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
