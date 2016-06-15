<?php

namespace Agouti\LaravelMailcatcher;

use Config;
use Alex\MailCatcher\Client as MailCatcherClient;

class Client extends MailCatcherClient
{

    public function __construct()
    {
        $url = Config::get('mailcatcher.url');

        return parent::__construct($url);
    }

    public function get(array $criterias = [], $limit = null)
    {
        return $this->search($criterias, $limit);
    }

    public function search(array $criterias = [], $limit = null)
    {
        $messages = parent::search($criterias, $limit);

        return new Collection($messages);
    }
}
