<?php

namespace Agouti\LaravelMailcatcher;

use Config;
use Jenssegers\Model\Model as BaseModel;

class Model extends BaseModel
{
    public $messageObject = false;

    protected $appends = ['url'];

    private function personData($person)
    {
        return [
            'name' => $person->getName(),
            'email' => $person->getEmail(),
        ];
    }

    private function parseMessage($message)
    {
        $this->messageObject = $message;
        $data['id'] = $message->getId();
        $data['sender'] = $this->personData($message->getSender());
        foreach ($message->getRecipients() as $recipient) {
            $data['recipients'][] = $this->personData($recipient);
        }
        $data['subject'] = $message->getSubject();
        $data['content'] = $message->getContent();

        return $data;
    }

    public function __construct($message)
    {
        if (is_a($message, 'Agouti\LaravelMailcatcher\Model')) {
            $data = $message->toArray();
        } else {
            $data = $this->parseMessage($message);
        }

        return parent::__construct($data);
    }

    public function getUrlAttribute()
    {
        $baseUrl = Config::get('mailcatcher.url');

        return $baseUrl.'/messages/'.$this->id.'.html';
    }

    public function delete()
    {
        $this->messageObject->delete();

        return parent::delete();
    }
}
