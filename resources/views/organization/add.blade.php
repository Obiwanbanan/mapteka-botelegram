@extends('layouts.layout')
@extends('major-menu')

@section('major-content')
    <div class="major__organization-add">
        <h2>
            Добавить организацию
        </h2>
        <form>
            <label for="">Название организации</label>
            <input class="input" id="name" type="text" name="name">
            <label for="">ИНН организации</label>
            <input class="input" id="INN" type="text" name="INN">
            <label for="">Бот для организации</label>
            <select name="botId">
                @foreach($chatBots as $chatBot)
                    <option value="{{ $chatBot->id }}">
                        {{ $chatBot->name }}
                    </option>
                @endforeach
            </select>

            <button type="button" class="custom-btn" type="button">
                {{ __('Добавить') }}
            </button>
        </form>
    </div>
@endsection
