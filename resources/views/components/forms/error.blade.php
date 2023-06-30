@props(['name'])

@error("$name")
    <p class="text-danger text-small mt-1">{{ $message }}</p>
@enderror
