<?php
//
//namespace App\Telegram\Commands;
//
//use App\Telegram\Keyboard\TelegramKeyboard;
//use Illuminate\Support\Facades\Log;
//use Telegram\Bot\Actions;
//use Telegram\Bot\Commands\Command;
//use Telegram\Bot\Exceptions\TelegramResponseException;
//use Telegram\Bot\Laravel\Facades\Telegram;
//
//class HelpCommand extends Command
//{
//    protected string $name = 'help';
//    protected string $description = 'Здесь вы узнаете как пользоватся ботом';
//
//    public function handle()
//    {
//        $update = $this->getUpdate();
//        $chatId = $update->getChat()['id'] ?? '';
//        $telegram = $this->getTelegram();
//
//        try {
//            $telegram->sendMessage([
//                'chat_id' => $chatId,
//                'text' => 'Туториал как пользоваться ботом',
//                'reply_markup' => TelegramKeyboard::mainMenu()
//            ]);
//        } catch (TelegramResponseException $e) {
//            Log::error($e->getMessage());
//        }
//    }
//}
