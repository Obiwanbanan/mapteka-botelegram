<div class="major__content-organization-header">
    <h1>
        Organizations
    </h1>
    <button class="major__content-btn btn">
        Add Organization
    </button>
</div>
<div class="major__content-organization-additional">
    <div class="major__content-organization-search">
        <input class="input" id='search' type="text" placeholder="Search">
        <input class="input" id="action" type="hidden" name="action" value="search">
        <button class="btn">
            Search
        </button>
    </div>
</div>


<div class="major__content-organization-container">
    @foreach($organizations as $organization)
        @if(!empty($organization))
            <div class="major__content-organization" id="{{ $organization->id }}">
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
                            <div class="major__content-organization-name">
                                {{ $organization->name }}
                            </div>
                        @endif

                        <div class="major__content-organization-wrapper">
                            @if(!empty($organization->INN))
                                <div class="major__content-organization-inn">
                                    {{ $organization->INN }}
                                </div>
                            @endif
                            @if(!empty($organization->bot->username))
                                <div class="major__content-organization-botname">
                                    {{ $organization->bot->username }}
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
            </div>

        @endif
    @endforeach
    <div class="major__content-organization-pagination">
        <div class="prev-page"
             data-prev-page= {{ substr($organizations->previousPageUrl(), strpos($organizations->previousPageUrl(), '=') + 1, strlen($organizations->previousPageUrl()))  }}
        >
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32" height="32" viewBox="0 0 32 32">
                <path
                    d="M12.586 27.414l-10-10c-0.781-0.781-0.781-2.047 0-2.828l10-10c0.781-0.781 2.047-0.781 2.828 0s0.781 2.047 0 2.828l-6.586 6.586h19.172c1.105 0 2 0.895 2 2s-0.895 2-2 2h-19.172l6.586 6.586c0.39 0.39 0.586 0.902 0.586 1.414s-0.195 1.024-0.586 1.414c-0.781 0.781-2.047 0.781-2.828 0z"/>
            </svg>
        </div>
        <div class="next-page"
             data-next-page= {{ substr($organizations->nextPageUrl(), strpos($organizations->nextPageUrl(), '=') + 1, strlen($organizations->nextPageUrl())) }}
        >
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32" height="32" viewBox="0 0 32 32">
                <path
                    d="M19.414 27.414l10-10c0.781-0.781 0.781-2.047 0-2.828l-10-10c-0.781-0.781-2.047-0.781-2.828 0s-0.781 2.047 0 2.828l6.586 6.586h-19.172c-1.105 0-2 0.895-2 2s0.895 2 2 2h19.172l-6.586 6.586c-0.39 0.39-0.586 0.902-0.586 1.414s0.195 1.024 0.586 1.414c0.781 0.781 2.047 0.781 2.828 0z"/>
            </svg>
        </div>
    </div>
    @php
        //        dd(
        //            $organizations->getOptions(),
        //            $organizations->getUrlRange(1, 3),
        //            $organizations->lastPage(),
        //
        //$organizations->currentPage(),
        //
        //$organizations->firstItem(),
        //
        //$organizations->hasMorePages(),
        //
        //$organizations->lastItem(),
        //
        //$organizations->lastPage(),
        //
        //$organizations->nextPageUrl(),
        //
        //$organizations->perPage(),
        //
        //$organizations->previousPageUrl(),
        //
        //$organizations->total(),
        //
        //        );
    @endphp
    {{--    {{ $organizations->links() }}--}}

</div>



