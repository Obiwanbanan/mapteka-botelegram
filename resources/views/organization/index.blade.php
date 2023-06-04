@extends('layouts.layout')
@extends('major-menu')

@section('major-content')
    <div class="major__content-organization-header">
        <h1>
            Организации
        </h1>
        <a href="/organization/add" class="major__content-btn custom-btn">
            Добавить организацию
        </a>
    </div>
    <div class="major__content-organization-additional">
        <div class="major__content-organization-search">
            <input class="input" id='search' type="text" placeholder="Введите имя или инн">
            <input class="input" id="action" type="hidden" name="action" value="search">
            <button class="custom-btn">
                Поиск
            </button>
        </div>
    </div>

    <div class="major__content-organization-container">
        @foreach($organizations as $organization)
            @if(!empty($organization))
                <a href="/organization/{{ $organization->id }}" class="major__content-organization" id="{{ $organization->id }}">
                    <div class="major__content-organization-left">
                        <div class="major__content-organization-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32" height="32"
                                 viewBox="0 0 32 32">
                                <path
                                    d="M28 8v-4h-28v22c0 1.105 0.895 2 2 2h27c1.657 0 3-1.343 3-3v-17h-4zM26 26h-24v-20h24v20zM4 10h20v2h-20zM16 14h8v2h-8zM16 18h8v2h-8zM16 22h6v2h-6zM4 14h10v10h-10z"/>
                            </svg>
                        </div>
                        <div class="major__content-organization-body">
                            @if(!empty($organization->name))
                                <p class="major__content-organization-name">
                                    {{ $organization->name }}
                                </p>
                            @endif

                            <div class="major__content-organization-wrapper">
                                @if(!empty($organization->INN))
                                    <div class="major__content-organization-inn">
                                        {{ $organization->INN }}
                                    </div>
                                @endif
                                @if(!empty($organization->bot->name))
                                    <div class="major__content-organization-botname">
                                        {{ $organization->bot->name }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="major__content-organization-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32" height="32" viewBox="0 0 32 32">
                            <path
                                d="M19.414 27.414l10-10c0.781-0.781 0.781-2.047 0-2.828l-10-10c-0.781-0.781-2.047-0.781-2.828 0s-0.781 2.047 0 2.828l6.586 6.586h-19.172c-1.105 0-2 0.895-2 2s0.895 2 2 2h19.172l-6.586 6.586c-0.39 0.39-0.586 0.902-0.586 1.414s0.195 1.024 0.586 1.414c0.781 0.781 2.047 0.781 2.828 0z"/>
                        </svg>
                    </div>
                </a>
            @endif
        @endforeach
    </div>
    {{ $organizations->onEachSide(2)->withQueryString()->links('pagination.custom') }}
@endsection
