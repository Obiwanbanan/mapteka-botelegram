@extends('layouts.layout')
@extends('major-menu')

@section('major-content')
    <div class="chat-bots-add">
        <h2>
            Добавить телеграм бота
        </h2>
        <form>
            <input class="input" id="name" type="text" name="name" placeholder="Имя">
            <input class="input" id="token" type="text" name="token" placeholder="Токен">
            <input class="input" id="url" type="text" name="url" placeholder="Url вебхук">

            <button type="button" class="custom-btn">
                {{ __('Добавить') }}
            </button>
        </form>
    </div>
@endsection
