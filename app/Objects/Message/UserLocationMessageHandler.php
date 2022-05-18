<?php

namespace App\Objects\Message;

use App\Objects\MessageText\MessageTextToSend;
use App\Repositories\Users\UserRepository;

class UserLocationMessageHandler extends BaseMessageHandler
{
    public function handle()
    {
        $repository = new UserRepository();
        $user = $repository->getUser($this->data['nickName']);
        $repository->updateUserLocation($user, $this->data);

        $message = MessageTextToSend::MESSAGE_TEXT_TYPES['locationSentReply'];
        return $this->telegram()->sendMessage($this->data['chat_id'], $message);
    }
}