<?php 
namespace Abackdev\User;

class Message{
    private  static $api_url='http://api.msg91.com/api/sendhttp.php?';
    private static $init=false;
    private static $curl;


    public static function init(){
        self::$api_url=self::$api_url.'authkey='.config('message.authkey').'&country='.config('message.country').'&sender='.config('message.sender').'&route='.config('message.route');
        dd(curl_init());
        self::$curl=curl_init();
    }

    
    public static function send($phone,$message){
       if(!self::$init){
           self::init();
       }
      return $this->callApi($phone,$message,function($response){
            return !$response?false:true;
      });
      
    }
    public function callApi($mobile,$msg,$res){
        $curl_url=self::$api_url.'mobiles='.$mobile.'&message='.$msg;
        curl_setopt_array(self::$curl, array(
                $curl_url,  
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                ));
        $response = curl_exec(self::$curl);
             $err = curl_error(self::$curl);
                 curl_close(self::$curl);
        return $err?$res(false):$res($response);
    }
}