<?php

namespace App\Telegram\Keyboard;

use Telegram\Bot\Keyboard\Keyboard;


class TelegramKeyboard
{
    public const MAPPING_BUTTONS = [
        self::SEARCH => 'Поиск лекарств',
        self::ADDRESS => 'Адреса аптек',
        self::CART => 'Корзина',
        self::HELP => 'Помощь',
        self::ORDERS => 'Мои заказы',
        self::BACK_MAIN_MENU => 'Главное меню',
        self::FIND_CURE => 'Найти лекарство',
        self::FIND_CITY => 'Найти город 🔍',
    ];
    public const SEARCH = 'search';
    public const ADDRESS = 'address';
    public const CART = 'cart';
    public const HELP = 'help';
    public const ORDERS = 'orders';
    public const BACK_MAIN_MENU = 'backMainMenu';
    public const FIND_CURE = 'findCure';
    public const FIND_CITY = 'findCity';

    public static function mainMenu(): Keyboard
    {
        return
            Keyboard::make()
                ->inline()
                ->row([
                    Keyboard::inlineButton([
                        'text' => self::MAPPING_BUTTONS[self::SEARCH],
                        'callback_data' => self::SEARCH,
                    ]),
                ])
                ->row([
                        Keyboard::inlineButton([
                            'text' => self::MAPPING_BUTTONS[self::ADDRESS],
                            'callback_data' => self::ADDRESS,
                        ]),
                        Keyboard::inlineButton([
                            'text' => self::MAPPING_BUTTONS[self::CART],
                            'callback_data' => self::CART,
                        ]),
                    ]
                )
                ->row([
                    Keyboard::inlineButton([
                        'text' => self::MAPPING_BUTTONS[self::HELP],
                        'callback_data' => self::HELP,
                    ]),
                    Keyboard::inlineButton([
                        'text' => self::MAPPING_BUTTONS[self::ORDERS],
                        'callback_data' => self::ORDERS,
                    ]),
                ]);
    }

    public static function menuHelp(): Keyboard
    {
        return
            Keyboard::make()
                ->inline()
                ->row([
                    Keyboard::inlineButton([
                        'text' => self::MAPPING_BUTTONS[self::BACK_MAIN_MENU],
                        'callback_data' => self::BACK_MAIN_MENU,
                    ]),
                ]);
    }

    public static function menuSearchCity(): Keyboard
    {
        return
            Keyboard::make()
                ->inline()
                ->row([
                        Keyboard::inlineButton([
                            'text' => self::MAPPING_BUTTONS[self::FIND_CITY],
                            'callback_data' => self::FIND_CITY,
                        ]),
                    ]
                );
    }

}
