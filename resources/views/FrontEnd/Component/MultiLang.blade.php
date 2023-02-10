<div class="other-option">
    <select class="form-control nice-select" onchange="window.location.href=this.value" 
  >
        @php
            use App\Models\lang;
            
            $Langs = lang::all();
            
            $route = Route::current()->getName();
            
            $locale = app()->getLocale();
            
            //UpperCase First Char of LangCode
            $langCode = strtoupper($locale);
            
        @endphp
        @if (!isset($id))
            @foreach ($Langs as $lang)
                <option {{ $locale == $lang->LanguageCode ? 'Selected' : '' }}
                    value="{{ route($route, ['language' => $lang->LanguageCode]) }}">
                    {{ strtoupper($lang->LanguageCode) }}</a>
            @endforeach
        @else
            @foreach ($Langs as $lang)
                <option {{ $locale == $lang->LanguageCode ? 'Selected' : '' }}
                    value="{{ route($route, ['language' => $lang->LanguageCode, 'id' => $id]) }}">
                    {{ strtoupper($lang->LanguageCode) }}</a>
            @endforeach
        @endif
    </select>
</div>
