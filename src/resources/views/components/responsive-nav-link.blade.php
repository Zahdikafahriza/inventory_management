@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-xl bg-brand-50 px-4 py-3 text-start text-sm font-semibold text-brand-700 ring-1 ring-brand-100 transition'
            : 'block w-full rounded-xl px-4 py-3 text-start text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 focus:outline-none focus:ring-4 focus:ring-slate-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
