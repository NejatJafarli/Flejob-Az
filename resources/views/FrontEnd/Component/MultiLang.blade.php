<div class="other-option" style="margin: 0 0 0 50px">
    <select class="form-control" onchange="window.location.href=this.value">
        @php
            $route = Route::current()->getName();
            $locale = app()->getLocale();
        @endphp
        @foreach ($Langs as $lang)
            <option {{$locale == $lang->LanguageCode ? "Selected":""}} value="{{ route($route, ['language' => $lang->LanguageCode]) }}">
                {{ $lang->LanguageName }}</a>
        @endforeach
    </select>
</div>