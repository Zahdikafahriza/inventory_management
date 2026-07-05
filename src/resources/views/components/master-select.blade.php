@props([
    'name',
    'label',
    'options' => [],
    'selected' => null,
    'required' => false,
    'placeholder' => 'Pilih',
])

@php
    $selected = old($name, $selected);
    // Pastikan nilai lama yang tidak ada di master tetap muncul sebagai opsi,
    // agar edit barang lama tidak kehilangan nilainya.
    $allOptions = collect($options);
    if ($selected && !$allOptions->contains($selected)) {
        $allOptions = $allOptions->prepend($selected);
    }
@endphp

<div>
    <x-input-label :for="$name" :value="$label" />
    <select id="{{ $name }}" name="{{ $name }}" class="select-input mt-1" @if($required) required @endif>
        <option value="">{{ $placeholder }} {{ strtolower($label) }}</option>
        @foreach($allOptions as $opt)
            <option value="{{ $opt }}" @selected($selected === $opt)>{{ $opt }}</option>
        @endforeach
    </select>
    <x-input-error class="mt-2" :messages="$errors->get($name)" />
</div>
