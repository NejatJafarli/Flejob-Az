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
    <a href="{{route('User',['language'=>'az'])}}">Azerbaijan</a>
    <a href="{{route('User',['language'=>'en'])}}">en</a>
    {{-- set locale en --}}
    {{-- set locale ru --}}


{{-- get any error --}}
{{-- <h1>{{__( )}}</h1> --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{route("RegisterUser",app()->getLocale())}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="FirstName" placeholder="FirstName">
        <input type="text" name="LastName" placeholder="LastName">
        <input type="text" name="FatherName" placeholder="FatherName">
        <input type="date" name="BirthDate">
        <select name="City">
            @foreach ($cities as $city)
                <option value="{{$city->id}}">{{$city->CityName}}</option>
            @endforeach
        </select>
        <input type="file" name="image" placeholder="File" >
        <textarea name="Description" id="" cols="30" rows="10"></textarea>
        <select name="Married">
            <option value="1">Married</option>
            <option value="0">Single</option>
        </select>
        <input type="text" name="Username" placeholder="Username">
        <input type="password" name="Password" placeholder="Password">
        <input type="password" name="Password_confirmation" placeholder="Confirm Password">
        <input type="email" name="email" placeholder="email">
        <input type="text" name="phone" placeholder="phone">
        <p>format +944558448831</p>
        <input type="text" name="companyname[]" placeholder="company name">
        <input type="text" name="companyrank[]" placeholder="company name">
        <input type="date" name="companydate[]">
        <input type="text" name="educationName[]" placeholder="educationName">
        <input type="number" name="educationYear[]" placeholder="educationYear">
        <select name="educationLevel[]">
            @foreach ($education_levels as $education_level)
                <option value="{{$education_level->id}}">{{$education_level->education_level_name}}</option>
            @endforeach
        </select>
        <select name="Languages[]" multiple>
            @foreach ($languages as $language)
                <option value="{{$language->id}}">{{$language->LanguageName}}</option>
            @endforeach
        </select>
        <textarea name="Skills" cols="30" rows="10"></textarea>
        <select name="Categories[]" multiple>
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->CategoryName}}</option>
            @endforeach
        </select>
        <input type="number" name="MinSalary" placeholder="MinSalary">
        <input type="number" name="MaxSalary" placeholder="MaxSalary">
        <input type="text" name="LinkName[]" placeholder="Link">
        <input type="text" name="Link[]" placeholder="Link">
        
        <button type="submit">Register</button>
    </form> 
    
</body>
</html>