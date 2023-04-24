<h1>
    Chat bots
</h1>

<div class="major__content-container">
    <div class="chatbots__header">
        <div class="chatbots__choice">
            <select>
                @if(!$choiceBot)
                    <option>
                        Not selected
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
                Add
            </button>
        </div>
        <div class="chatbots__edit">
            <button class="btn">
                Edit
            </button>
        </div>
        <div class="chatbots__remove">
            <button class="btn">
                Remove
            </button>
        </div>
    </div>
    <div class="chatbots__body">
        @include('ajax.chatbots-body')
    </div>
</div>

@include('modals.chatbots-add')
