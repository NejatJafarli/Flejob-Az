<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- Choose language --}}
    {{-- <a href="{{route(Route::currentRouteName(),"en")}}">English</a> --}}
    {{-- <a href="{{ URL::ToRoute(Route::current(), ['language' => 'az'], true) }}">Azerbaijan</a> --}}
    {{-- <a href="{{ URL::ToRoute(Route::current(), ['language' => 'en'], true) }}">en</a> --}}
    {{-- set locale az --}}
    <a href="{{route('CompanyUser',['language'=>'az'])}}">Azerbaijan</a>
    <a href="{{route('CompanyUser',['language'=>'en'])}}">en</a>
    {{-- set locale en --}}
    {{-- set locale ru --}}


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{route("RegisterCompany",app()->getLocale())}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" value="{{old('CompanyName')}}" name="CompanyName" placeholder="FirstName">
        <input type="text" value="{{old('CompanyUsername')}}" name="CompanyUsername" placeholder="Username">
        <input type="email" value="{{old('CompanyEmail')}}" name="CompanyEmail" placeholder="Email">
        <input type="password" name="CompanyPassword" placeholder="Password">
        <input type="password" name="CompanyPassword_confirmation" placeholder="Confirm Password">
        <input type="text" value="{{old('CompanyAdress')}}" name="CompanyAdress" placeholder="Adres">

        <input type="text" value="{{old('CompanyPhone[]')}}" name="CompanyPhone[]" placeholder="phone">
        <input type="text" value="{{old('CompanyPhone[]')}}" name="CompanyPhone[]" placeholder="phone">
        <input type="text" value="{{old('CompanyPhone[]')}}" name="CompanyPhone[]" placeholder="phone">

        <input type="file" value="{{old('CompanyLogo')}}" name="CompanyLogo" placeholder="Logo" >
        
        <textarea value="{{old('CompanyDescription')}}" name="CompanyDescription" cols="30" rows="10"></textarea>

        <select value="{{old('Categories[]')}}" name="Categories[]" multiple>
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->CategoryName}}</option>
            @endforeach
        </select>
        <input type="text" value="{{old('CompanyLink')}}" name="CompanyLink" placeholder="Website Link">

        <button type="submit">Register</button>
    </form> 
    
</body>
</html>