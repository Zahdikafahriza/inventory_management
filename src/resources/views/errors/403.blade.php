<x-error-page
    code="403"
    title="Akses Ditolak"
    :message="$exception->getMessage() ?: 'Anda tidak memiliki hak akses untuk melakukan aksi ini. Hubungi Admin bila menurut Anda ini keliru.'"
/>
