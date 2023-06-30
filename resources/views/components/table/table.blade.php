@props(['headers'])

<table class="table table-borderless datatable">
    <thead>
        <tr>
            @foreach ($headers as $header)
                <x-table.th>
                    {{ $header }}
                </x-table.th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        {{ $slot }}
    </tbody>
</table>
