<?php

namespace App\Services;

interface NewsLetter
{
    public function listId();

    public function subscribe(string $email, string $list = null);
}
