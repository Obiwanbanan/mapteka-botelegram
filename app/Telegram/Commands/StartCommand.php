<?php

namespace App\Telegram\Commands;

use App\Telegram\Keyboard\TelegramKeyboard;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Telegram\Bot\Keyboard\Keyboard;

class StartCommand extends Command
{
    protected string $name = 'start';
    protected string $description = 'Команда для старта';

    public function handle(): void
    {
        $update = $this->getUpdate();
        $chatId = $update->getChat()['id'] ?? '';
        $user = $update->getMessage()->getFrom();
        $username = $user->getFirstName() . ' ' . $user->getLastName();
        $telegram = $this->getTelegram();
        try {
            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => 'Привет, ' . $username,
                'reply_markup' => TelegramKeyboard::mainMenu()
            ]);
        } catch (TelegramResponseException $e) {
            Log::error($e->getMessage());
        }
    }
}
