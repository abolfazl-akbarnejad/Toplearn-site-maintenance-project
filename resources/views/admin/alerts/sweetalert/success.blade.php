@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'انجام شد',
            text: '{{ session('success') }}',

        })
    </script>
@endif
