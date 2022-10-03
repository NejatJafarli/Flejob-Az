<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

        <h1>First Name : {{ $request->FirstName}}</h1>
        <h1>Last Name : {{ $request->LastName}}</h1>
        <h1>Father Name : {{ $request->FatherName}}</h1>
        <h1>Birth Date : {{ $request->BirthDate}}</h1>
        <h1>City : {{ $request->City}}</h1>
        <h1>Description : {{ $request->Description}}</h1>
        <h1>Married : {{ $request->Married}}</h1>
        <h1>Username : {{ $request->Username}}</h1>
        <h1>Password : {{ $request->Password}}</h1>
        <h1>Confirm Password : {{ $request->Password_confirmation}}</h1>
        <h1>Email : {{ $request->email}}</h1>
        <h1>Phone : {{ $request->phone}}</h1>
        

    
    
</body>
</html>