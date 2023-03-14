<section class="major">
    <div class="container">
        <div class="major__body">
            <div class="major__menu">
                <div id="dashboard" class="major__menu-dashboard major__menu-btn active-menu">
                    <div class="major__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32" height="32"
                             viewBox="0 0 32 32">
                            <path
                                d="M32 18.451l-16-12.42-16 12.42v-5.064l16-12.42 16 12.42zM28 18v12h-8v-8h-8v8h-8v-12l12-9z"/>
                        </svg>
                    </div>
                    <div class="major__menu-title">
                        Dashboard
                    </div>
                </div>
                <div id="organizations" class="major__menu-organizations major__menu-btn">
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
                        Organizations
                    </div>
                </div>
                <div id="settings" class="major__menu-settings major__menu-btn">
                    <div class="major__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32" height="32"
                             viewBox="0 0 32 32">
                            <path
                                d="M29.181 19.070c-1.679-2.908-0.669-6.634 2.255-8.328l-3.145-5.447c-0.898 0.527-1.943 0.829-3.058 0.829-3.361 0-6.085-2.742-6.085-6.125h-6.289c0.008 1.044-0.252 2.103-0.811 3.070-1.679 2.908-5.411 3.897-8.339 2.211l-3.144 5.447c0.905 0.515 1.689 1.268 2.246 2.234 1.676 2.903 0.672 6.623-2.241 8.319l3.145 5.447c0.895-0.522 1.935-0.82 3.044-0.82 3.35 0 6.067 2.725 6.084 6.092h6.289c-0.003-1.034 0.259-2.080 0.811-3.038 1.676-2.903 5.399-3.894 8.325-2.219l3.145-5.447c-0.899-0.515-1.678-1.266-2.232-2.226zM16 22.479c-3.578 0-6.479-2.901-6.479-6.479s2.901-6.479 6.479-6.479c3.578 0 6.479 2.901 6.479 6.479s-2.901 6.479-6.479 6.479z"/>
                        </svg>
                    </div>
                    <div class="major__menu-title">
                        Settings
                    </div>
                </div>
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
                            Logout
                        </span>
                    </button>


                </form>
            </div>
            <div class="major__content">
                @include('ajax.dashboard')
            </div>
        </div>
    </div>
</section>

{{--<script>--}}
{{--    $('#organizations').on('submit', function (event) {--}}
{{--        event.preventDefault();--}}
{{--        console.log('qwe')--}}
{{--        $.ajax({--}}
{{--            url: "/organizations",--}}
{{--            type: "POST",--}}
{{--            data: {--}}
{{--                "_token": "{{ csrf_token() }}",--}}
{{--                name: 'test',--}}
{{--            },--}}
{{--            success: function (response) {--}}
{{--                console.log(response)--}}
{{--            },--}}

{{--        });--}}
{{--    });--}}


{{--</script>--}}
