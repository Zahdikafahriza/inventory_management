<x-error-page
    code="422"
    title="Data Tidak Dapat Diproses"
    :message="$exception->getMessage() ?: 'Data yang dikirim tidak lolos validasi sistem. Periksa kembali isian Anda.'"
/>
