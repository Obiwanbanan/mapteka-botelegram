<?php

namespace App\Enums;

class ErrorMessage
{
    const SHORT_STRING = 'В сообщение должно быть не менее 3 символов';
    const ONLY_STRING = 'В сообщение должны присутствовать только буквы русского алфавита';
    const EMPTY = 'Ничего не найдено, попробуйте еще раз';

}
