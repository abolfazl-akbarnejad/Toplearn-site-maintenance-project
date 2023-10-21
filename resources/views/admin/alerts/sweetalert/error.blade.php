@if (session('error'))
    @section('alert')
        <script>
            Swal.fire({
                icon: 'error',
                title: 'خطا',
                text: '{{ session('error') }}',

            })
        </script>
    @endsection

@endif
