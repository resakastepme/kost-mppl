@props(['name'])

<x-forms.label :name="$name"/>

<input name="{{ $name }}" class="form-control" value="{{ old($name) }}" {{ $attributes }}>

<x-forms.error :name="$name"/>