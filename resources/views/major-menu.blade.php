@section('content')
    <section class="major">
        <div class="container">
            <div class="major__body">
                <div class="major__menu">
                    <a href="/" id="dashboard"
                       class="major__menu-dashboard major__menu-btn @if(Route::currentRouteName() === 'dashboard') active-menu @endif">
                        <div class="major__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32" height="32"
                                 viewBox="0 0 32 32">
                                <path
                                    d="M32 18.451l-16-12.42-16 12.42v-5.064l16-12.42 16 12.42zM28 18v12h-8v-8h-8v8h-8v-12l12-9z"/>
                            </svg>
                        </div>
                        <div class="major__menu-title">
                            Панель приборов
                        </div>
                    </a>
                    <a href="/organization" id="organizations"
                       class="major__menu-organizations major__menu-btn @if(Route::currentRouteName() === 'organization') active-menu @endif">
                        <div class="major__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="36" height="32"
                                 viewBox="0 0 36 32">
                                <path
                                    d="M7 4h-6c-0.55 0-1 0.45-1 1v22c0 0.55 0.45 1 1 1h6c0.55 0 1-0.45 1-1v-22c0-0.55-0.45-1-1-1zM6 10h-4v-2h4v2z"/>
                                <path
                                    d="M17 4h-6c-0.55 0-1 0.45-1 1v22c0 0.55 0.45 1 1 1h6c0.55 0 1-0.45 1-1v-22c0-0.55-0.45-1-1-1zM16 10h-4v-2h4v2z"/>
                                <path
                                    d="M23.909 5.546l-5.358 2.7c-0.491 0.247-0.691 0.852-0.443 1.343l8.999 17.861c0.247 0.491 0.852 0.691 1.343 0.443l5.358-2.7c0.491-0.247 0.691-0.852 0.443-1.343l-8.999-17.861c-0.247-0.491-0.852-0.691-1.343-0.443z"/>
                            </svg>
                        </div>
                        <div class="major__menu-title">
                            Организации
                        </div>
                    </a>
                    <a href="/chat-bots" id="chatbots"
                       class="major__menu-chat-bots major__menu-btn @if(Route::currentRouteName() === 'chat-bots') active-menu @endif">
                        <div class="major__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1"
                                 viewBox="0 0 122.88 119.35"><title>chatbot</title>
                                <path
                                    d="M57.49,29.2V23.53a14.41,14.41,0,0,1-2-.93A12.18,12.18,0,0,1,50.44,7.5a12.39,12.39,0,0,1,2.64-3.95A12.21,12.21,0,0,1,57,.92,12,12,0,0,1,61.66,0,12.14,12.14,0,0,1,72.88,7.5a12.14,12.14,0,0,1,0,9.27,12.08,12.08,0,0,1-2.64,3.94l-.06.06a12.74,12.74,0,0,1-2.36,1.83,11.26,11.26,0,0,1-2,.93V29.2H94.3a15.47,15.47,0,0,1,15.42,15.43v2.29H115a7.93,7.93,0,0,1,7.9,7.91V73.2A7.93,7.93,0,0,1,115,81.11h-5.25v2.07A15.48,15.48,0,0,1,94.3,98.61H55.23L31.81,118.72a2.58,2.58,0,0,1-3.65-.29,2.63,2.63,0,0,1-.63-1.85l1.25-18h-.21A15.45,15.45,0,0,1,13.16,83.18V81.11H7.91A7.93,7.93,0,0,1,0,73.2V54.83a7.93,7.93,0,0,1,7.9-7.91h5.26v-2.3A15.45,15.45,0,0,1,28.57,29.2H57.49ZM82.74,47.32a9.36,9.36,0,1,1-9.36,9.36,9.36,9.36,0,0,1,9.36-9.36Zm-42.58,0a9.36,9.36,0,1,1-9.36,9.36,9.36,9.36,0,0,1,9.36-9.36Zm6.38,31.36a2.28,2.28,0,0,1-.38-.38,2.18,2.18,0,0,1-.52-1.36,2.21,2.21,0,0,1,.46-1.39,2.4,2.4,0,0,1,.39-.39,3.22,3.22,0,0,1,3.88-.08A22.36,22.36,0,0,0,56,78.32a14.86,14.86,0,0,0,5.47,1A16.18,16.18,0,0,0,67,78.22,25.39,25.39,0,0,0,72.75,75a3.24,3.24,0,0,1,3.89.18,3,3,0,0,1,.37.41,2.22,2.22,0,0,1,.42,1.4,2.33,2.33,0,0,1-.58,1.35,2.29,2.29,0,0,1-.43.38,30.59,30.59,0,0,1-7.33,4,22.28,22.28,0,0,1-7.53,1.43A21.22,21.22,0,0,1,54,82.87a27.78,27.78,0,0,1-7.41-4.16l0,0ZM94.29,34.4H28.57A10.26,10.26,0,0,0,18.35,44.63V83.18A10.26,10.26,0,0,0,28.57,93.41h3.17a2.61,2.61,0,0,1,2.41,2.77l-1,14.58L52.45,94.15a2.56,2.56,0,0,1,1.83-.75h40a10.26,10.26,0,0,0,10.22-10.23V44.62A10.24,10.24,0,0,0,94.29,34.4Z"/>
                            </svg>
                        </div>
                        <div class="major__menu-title">
                            Чат боты
                        </div>
                    </a>
                    <a href="/settings" id="settings"
                       class="major__menu-settings major__menu-btn @if(Route::currentRouteName() === 'settings') active-menu @endif">
                        <div class="major__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32" height="32"
                                 viewBox="0 0 32 32">
                                <path
                                    d="M29.181 19.070c-1.679-2.908-0.669-6.634 2.255-8.328l-3.145-5.447c-0.898 0.527-1.943 0.829-3.058 0.829-3.361 0-6.085-2.742-6.085-6.125h-6.289c0.008 1.044-0.252 2.103-0.811 3.070-1.679 2.908-5.411 3.897-8.339 2.211l-3.144 5.447c0.905 0.515 1.689 1.268 2.246 2.234 1.676 2.903 0.672 6.623-2.241 8.319l3.145 5.447c0.895-0.522 1.935-0.82 3.044-0.82 3.35 0 6.067 2.725 6.084 6.092h6.289c-0.003-1.034 0.259-2.080 0.811-3.038 1.676-2.903 5.399-3.894 8.325-2.219l3.145-5.447c-0.899-0.515-1.678-1.266-2.232-2.226zM16 22.479c-3.578 0-6.479-2.901-6.479-6.479s2.901-6.479 6.479-6.479c3.578 0 6.479 2.901 6.479 6.479s-2.901 6.479-6.479 6.479z"/>
                            </svg>
                        </div>
                        <div class="major__menu-title">
                            Настройки
                        </div>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" id="logout"
                          class="major__menu-logout">
                        @csrf
                        <button class="major__menu-btn" type="submit">
                        <span class="major__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32" height="32"
                                 viewBox="0 0 32 32">
                                <title>exit</title>
                                <path
                                    d="M24 20v-4h-10v-4h10v-4l6 6zM22 18v8h-10v6l-12-6v-26h22v10h-2v-8h-16l8 4v18h8v-6z"/>
                            </svg>
                        </span>
                            <span class="major__menu-title">
                            Выйти
                        </span>
                        </button>


                    </form>
                </div>
                <div class="major__content">
                    @yield('major-content')
                </div>
            </div>
        </div>
    </section>
@endsection
