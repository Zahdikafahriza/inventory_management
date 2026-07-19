<x-error-page
    code="503"
    title="Sedang Pemeliharaan"
    :message="$exception->getMessage() ?: 'Sistem sedang dalam pemeliharaan terjadwal. Silakan coba akses kembali beberapa saat lagi.'"
/>
