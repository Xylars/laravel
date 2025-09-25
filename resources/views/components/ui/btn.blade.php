@props([
    'href' => '#',
    'method' => 'get'
    ])

@if ($method === 'post')

<form action="{{ $href }}" method="POST" class="d-inline">
    @csrf
    <input {{ $attributes->merge(['class' => 'btn']) }} type="submit" value="{{ $slot }}"/>
</form>
@elseif ($method === 'get')
<a href = {{ $href }} {{ $attributes->merge(['class' => 'btn']) }}>{{ $slot }}</a>

@else
<form action="{{ $href }}" method="POST" class="d-inline">
    @csrf
    @method($method)
    <input {{ $attributes->merge(['class' => 'btn']) }} type="submit" value="{{ $slot }}"/>
</form>
@endif