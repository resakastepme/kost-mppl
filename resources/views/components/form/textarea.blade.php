@props(['name','text'=>null])

<x-form.label :name="$text ?? $name"/>

<textarea name="{{ $name }}" class="form-control" cols="30" rows="10">{{ $slot ?? old($name) }}</textarea>

<x-form.error :name="$name"/>