<?php

namespace Agouti\LaravelMailcatcher;

use Illuminate\Support\Collection as LaravelCollection;

class Collection extends LaravelCollection
{
    public function __construct(array $messages = [])
    {
        $messageModels = [];

        foreach ($messages as $message) {
            $messageModels[] = new Model($message);
        }

        parent::__construct($messageModels);
    }

    public function delete()
    {
        foreach ($this as $message) {
            $message->delete();
        }
    }

    public function whereRecip($email)
    {
        $coll = new self;
        foreach ($this as $msg) {
            if ($msg->recipients->contains('email', $email)) {
                $coll->push($msg);
            }
        }
        return $coll;

    }
}
