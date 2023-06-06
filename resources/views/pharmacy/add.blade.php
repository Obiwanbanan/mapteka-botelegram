@extends('layouts.layout')
@extends('major-menu')

@section('major-content')
    <div class="major__pharmacy-add">
        <h2>
            Добавить аптеку
        </h2>
        <form>
            <label for="">Организация для аптеки</label>
            <select name="selected-organization">
                @foreach($organizations as $organization)
                    <option value="{{ $organization->id }}">
                        {{ $organization->name }}
                    </option>
                @endforeach
            </select>
            <label for="">Название аптеки</label>
            <input class="input" id="name" type="text" name="name">
            <label for="">Город аптеки</label>
            <select name="selected-city">
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
            <label for="">Адрес аптеки</label>
            <input class="input" id="address" type="text" name="address">
            <label for="">Ссылка на яндекс карту</label>
            <input class="input" id="map" type="text" name="map">

            <button type="button" class="custom-btn" type="button">
                {{ __('Добавить') }}
            </button>
        </form>
    </div>
@endsection
