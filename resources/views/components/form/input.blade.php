@props(['name','text'=>null])

<x-form.label :name="$text ?? $name"/>

<input name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control']) }} {{ $attributes(['value'=> old($name)]) }} {{ $attributes }}>

<x-form.error :name="$name"/>