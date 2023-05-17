@extends('layouts.layout')
@extends('major-menu')

@section('major-content')
    <div class="major__organization-edit-modal ">
        <div class="major__content-organization-edit-modal">
            <h2>
                Редактирвать организацию
            </h2>
            <span class="major__organization-edit-modal-close">
           <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32" height="32" viewBox="0 0 32 32">
            <path
                d="M16 0c-8.837 0-16 7.163-16 16s7.163 16 16 16 16-7.163 16-16-7.163-16-16-16zM16 29c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13z"/>
            <path d="M21 8l-5 5-5-5-3 3 5 5-5 5 3 3 5-5 5 5 3-3-5-5 5-5z"/>
            </svg>
        </span>


            <input class="input" id="name" type="text" name="name" placeholder="Имя"
                   value="{{$organization['name']}}">
            <input class="input" id="INN" type="text" name="INN" placeholder="INN" value="{{$organization['INN']}}">
            <select>
                @foreach($chatBots as $chatBot)
                    <option id="{{ $chatBot->id }}"
                            value="{{ $chatBot->name }}"
                            @if($chatBot->id === $organization['bot_id'])
                                selected
                        @endif
                    >
                        {{ $chatBot->name }}
                    </option>
                @endforeach
            </select>
            <div>
{{--                <form method="POST" action="{{ route('organization.delete', ['id' => $organization['id']]) }}">--}}
{{--                    @method('PATCH')--}}
{{--                    @csrf--}}
                    <button id="" class="btn">
                        {{ __('Обновить') }}
                    </button>
{{--                </form>--}}
                <form method="POST" action="{{ route('organization.delete', ['id' => $organization['id']]) }}">
                    @method('DELETE')
                    @csrf
                    <button class="btn" type="submit">
                        Удалить
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
