@extends('layouts.layout')
@extends('major-menu')

@section('major-content')
    <h1>
        Чат боты
    </h1>

    <div class="major__content-container">
        <div class="chatbots__header">
            <div class="chatbots__choice">
                <select>
                    @if(!$choiceBot)
                        <option>
                            Не выбран
                        </option>
                    @endif

                    @foreach($chatBots as $chatBot)
                        <option
                            id="{{ $chatBot->id }}"
                            data-name="{{ $chatBot->name }}"
                            data-token="{{ $chatBot->token }}"
                            data-webhook="{{ $chatBot->webhook }}"
                            data-url="{{ $chatBot->url }}"
                        >
                            {{ $chatBot->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="chatbots__add">
                <button class="btn">
                    Добавить
                </button>
            </div>
            <div class="chatbots__edit">
                <button class="btn">
                    Редактирвать
                </button>
            </div>
            <div class="chatbots__remove">
                <button class="btn">
                    Удалить
                </button>
            </div>
        </div>
        <div class="chatbots__body">
            @if(!empty($choiceBot))
                @php
                    $status = $choiceBot->webhook ? 'Активный' : 'Неактивный'
                @endphp
                <div class="chatbots__body-wrapper">
                    <div class="chatbots__fields">
                        <input class="input" id="name" type="text" name="name" placeholder="Name"
                               value="{{ $choiceBot->name }}"
                               disabled>
                        <input class="input" id="token" type="text" name="token" placeholder="Token"
                               value="{{ $choiceBot->token }}"
                               disabled>
                        <input class="input" id="url" type="text" name="url" placeholder="Url webhook"
                               value="{{ $choiceBot->url }}"
                               disabled>
                    </div>
                    <div class="chatbots__status">
                        Webhook: <span> {{ $status }}</span>
                    </div>
                </div>

                <div class="chatbots__buttons">
                    <div class="chatbots__buttons-accept">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32" height="32"
                             viewBox="0 0 32 32">
                            <path d="M27 4l-15 15-7-7-5 5 12 12 20-20z"/>
                        </svg>
                    </div>

                    <div class="chatbots__buttons-cancel">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32" height="32"
                             viewBox="0 0 32 32">
                            <path
                                d="M31.708 25.708c-0-0-0-0-0-0l-9.708-9.708 9.708-9.708c0-0 0-0 0-0 0.105-0.105 0.18-0.227 0.229-0.357 0.133-0.356 0.057-0.771-0.229-1.057l-4.586-4.586c-0.286-0.286-0.702-0.361-1.057-0.229-0.13 0.048-0.252 0.124-0.357 0.228 0 0-0 0-0 0l-9.708 9.708-9.708-9.708c-0-0-0-0-0-0-0.105-0.104-0.227-0.18-0.357-0.228-0.356-0.133-0.771-0.057-1.057 0.229l-4.586 4.586c-0.286 0.286-0.361 0.702-0.229 1.057 0.049 0.13 0.124 0.252 0.229 0.357 0 0 0 0 0 0l9.708 9.708-9.708 9.708c-0 0-0 0-0 0-0.104 0.105-0.18 0.227-0.229 0.357-0.133 0.355-0.057 0.771 0.229 1.057l4.586 4.586c0.286 0.286 0.702 0.361 1.057 0.229 0.13-0.049 0.252-0.124 0.357-0.229 0-0 0-0 0-0l9.708-9.708 9.708 9.708c0 0 0 0 0 0 0.105 0.105 0.227 0.18 0.357 0.229 0.356 0.133 0.771 0.057 1.057-0.229l4.586-4.586c0.286-0.286 0.362-0.702 0.229-1.057-0.049-0.13-0.124-0.252-0.229-0.357z"/>
                        </svg>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @include('modals.chatbots-add')
@endsection
