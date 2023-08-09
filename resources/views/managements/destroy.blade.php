<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @php
        $selectedValues = request('selectedValues');
    @endphp
    {{ $selectedValues }}
    <form action="{{ route('managements.destroy', $selectedValues) }}" method="POST">
        @csrf
        @method('delete')
        <button class="border border-gray-400 p-1 rounded hidden" onclick="return confirm('삭제하시겠습니까?')" >{{ __('삭제') }}</button>
    </form>
</body>
</html>