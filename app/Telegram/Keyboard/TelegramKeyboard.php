<?php

namespace App\Telegram\Keyboard;

use Telegram\Bot\Keyboard\Keyboard;


class TelegramKeyboard
{
    public static function mainMenu(): Keyboard
    {
        return
            Keyboard::make()
                ->inline()
                ->row([
                    Keyboard::inlineButton([
                        'text' => 'Поиск лекарств',
                        'callback_data' => 'search',
                    ]),
                ])
                ->row([
                        Keyboard::inlineButton([
                            'text' => 'Адреса аптек',
                            'callback_data' => 'address',
                        ]),
                        Keyboard::inlineButton([
                            'text' => 'Корзина',
                            'callback_data' => 'cart',
                        ]),
                    ]
                )
                ->row([
                    Keyboard::inlineButton([
                        'text' => 'Помощь',
                        'callback_data' => 'help',
                    ]),
                    Keyboard::inlineButton([
                        'text' => 'Мои заказы',
                        'callback_data' => 'orders',
                    ]),
                ]);
    }
}
