<div class="other-option" style="padding: 0 0 0 50px">
    <select class="form-control" onchange="window.location.href=this.value">
        @php
            $route = Route::current()->getName();
            $locale = app()->getLocale();


            //UpperCase First Char of LangCode
            $langCode = strtoupper($locale);
            
        @endphp
        @foreach ($Langs as $lang)
            <option {{$locale == $lang->LanguageCode ? "Selected":""}} value="{{ route($route, ['language' => $lang->LanguageCode]) }}">
                {{ strtoupper($lang->LanguageCode) }}</a>
        @endforeach
    </select>
</div>