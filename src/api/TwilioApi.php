<?php

namespace App\api;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client ;
use function PHPUnit\Framework\throwException;

class TwilioApi
{

    public $account_sid = 'AC827499c505a0825c13b9c15a5e57dcde';
    public $auth_token = '6c919d52d4ce5021a1a8a2487ed0e5f6';
    public $twilio_number = '+14704444081';
    public $client  ;

    public function __construct()
    {
        $this->client = new Client($this->account_sid , $this->auth_token);
    }


    public function sendSMS(string $phoneNumber , string $message){

        try {
            $this->client->messages->create($phoneNumber,array('from'=>$this->twilio_number,'body'=> $message));
            echo 'sms sent successfully';
        }
        catch (TwilioException $e){
            echo 'error sending sms';
            throwException($e);
        }

    }


}