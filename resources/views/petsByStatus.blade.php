<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

@include('components.navigation')

<div>
    <h1>Pets by {{ $status }} status.</h1>
</div>

<div>
    <table>
        <tbody>
        @foreach($pets as $pet)
            <tr>
                <td>{{ json_encode($pet)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</body>
</html>
