@extends('layouts.layout')
@extends('major-menu')

@section('major-content')
    <div class="major__content-organization-add">
        <h2>
            Добавить организацию
        </h2>
        <span class="major__content-organization-modal-close">
           <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32" height="32" viewBox="0 0 32 32">
            <path
                d="M16 0c-8.837 0-16 7.163-16 16s7.163 16 16 16 16-7.163 16-16-7.163-16-16-16zM16 29c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13z"/>
            <path d="M21 8l-5 5-5-5-3 3 5 5-5 5 3 3 5-5 5 5 3-3-5-5 5-5z"/>
            </svg>
        </span>
        <input class="input" id="action" type="hidden" name="action" value="add">
        <input class="input" id="page" type="hidden" name="page" value="organizations">
        <input class="input" id="organization-name" type="text" name="organization-name" placeholder="Имя">
        <input class="input" id="organization-INN" type="text" name="organization-INN" placeholder="INN">

        <select>
            @foreach($chatBots as $chatBot)
                <option id="{{ $chatBot->id }}" value="{{ $chatBot->name }}">
                    {{ $chatBot->name }}
                </option>
            @endforeach
        </select>

        <button class="btn">
            {{ __('Добавить') }}
        </button>
    </div>
@endsection
