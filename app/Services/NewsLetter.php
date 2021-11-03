<?php
namespace App\Services;

use MailchimpMarketing\ApiClient;

class NewsLetter {

    public function client(){
        return (new ApiClient())->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us5'
        ]);
    }
    public function subscribe(string $email){
        return $this->client()->lists->addListMember(config('services.mailchimp.lists.subscriber'),[
            "email_address" => $email,
            'status' => "subscribed"
        ]);
    }
}