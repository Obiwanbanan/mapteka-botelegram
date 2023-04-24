<?php

namespace App\Handler;

use App\Models\Bot;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotLogicHandler
{
    public function __invoke($request)
    {

     return   $this->sendMessage();
    }

    /**
     * @throws TelegramSDKException
     */
    private function sendMessage()
    {
        $update = Telegram::commandsHandler(true);
        $telegram = new Api('6037349296:AAGChITqT8J8xfqBeOZk9K-sEXnUTMpNG9U');
        $lastMessage = $update->getMessage()->get('text');
        $keyboard = [
            ['7', '8', '9'],
            ['4', '5', '6'],
            ['1', '2', '3'],
            ['23']
        ];

        $reply_markup = Keyboard::make([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]);

        if ($lastMessage == 'hello') {
            $telegram->sendMessage(
                [
                    'chat_id' => '725014793',
                    'text' => 'ne chort',
                    'reply_markup' => $reply_markup

                ]
            );
        } else {
            $telegram->sendMessage(
                [
                    'chat_id' => '725014793',
                    'text' => 'chort',
                    'reply_markup' => $reply_markup

                ]
            );
        }

        return (json_encode($update));
    }

}
