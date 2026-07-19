<x-error-page
    code="400"
    title="Permintaan Tidak Valid"
    :message="$exception->getMessage() ?: 'Permintaan yang dikirim tidak dapat diproses oleh sistem. Periksa kembali data yang Anda masukkan.'"
/>
