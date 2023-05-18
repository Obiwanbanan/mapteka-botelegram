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

            <form method="POST" action="{{ route('organization.edit', ['id' => $organization['id']]) }}">
                <input class="input" id="name" type="text" name="name" placeholder="Имя"
                       value="{{$organization['name']}}">
                <input class="input" id="INN" type="text" name="INN" placeholder="INN"
                       value="{{$organization['INN']}}">
                <select name="botId">
                    @foreach($chatBots as $chatBot)
                        <option value="{{ $chatBot->id }}"
                                @if($chatBot->id === $organization['bot_id'])
                                    selected
                            @endif
                        >
                            {{ $chatBot->name }}
                        </option>
                    @endforeach
                </select>

                @method('GET')
                @csrf
                <button id="" class="btn">
                    Обновить
                </button>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('INN')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

            </form>

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
