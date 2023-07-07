@props(['name'])

<x-form.label :name="$name"/>

<input name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control']) }} {{ $attributes(['value'=> old($name)]) }} {{ $attributes }}>

<x-form.error :name="$name"/>