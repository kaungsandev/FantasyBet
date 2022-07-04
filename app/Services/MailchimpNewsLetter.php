<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsLetter implements NewsLetter
{
    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function listId()
    {
        ddd($this->client->lists->getAllLists());
    }

    public function subscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscriber');

        return $this->client->lists->setListMember($list, $email, [
            'email_address' => $email,
            'status' => 'subscribed',
        ]);
    }
}
