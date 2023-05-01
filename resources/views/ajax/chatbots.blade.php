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
                    <option id="{{ $chatBot->id }}" value="{{ $chatBot->name }}">
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
        @include('ajax.chatbots-body')
    </div>
</div>

@include('modals.chatbots-add')
