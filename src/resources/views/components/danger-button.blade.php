<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-danger-solid']) }}>
    {{ $slot }}
</button>
