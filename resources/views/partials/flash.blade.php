<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @if(session('success'))
    <div class="success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="error">{{ session('error') }}</div>
    @endif

    @if($errors->any())
    <div class="error">
        <ul>
            @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</body>

</html>