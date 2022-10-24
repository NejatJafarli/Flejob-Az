<div class="other-option" style="padding: 0 0 0 50px">
    <select class="form-control nice-select" onchange="window.location.href=this.value">
        @php
            use App\Models\lang;
            
            $Langs = lang::all();
            
            $route = Route::current()->getName();

            $locale = app()->getLocale();
            
            //UpperCase First Char of LangCode
            $langCode = strtoupper($locale);
            
        @endphp
        <h1>{{ $route }}</h1>
        @foreach ($Langs as $lang)
            <option {{ $locale == $lang->LanguageCode ? 'Selected' : '' }}
                value="{{ route($route, ['language' => $lang->LanguageCode]) }}">
                {{ strtoupper($lang->LanguageCode) }}</a>
        @endforeach
    </select>
</div>
