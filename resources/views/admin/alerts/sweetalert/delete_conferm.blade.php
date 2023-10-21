<script>
    $(document).ready(function() {

        var classNmae = '{{ $className }}';
        var element = $('.' + classNmae);



        element.on('click', function(e) {

            e.preventDefault();

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger mx-2'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'آیا مطمئن هستید',
                text: "در صورت تایید این داده حذف خواهد شد",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'بله حذف شود!!',
                cancelButtonText: 'خیر در خواست لفو شود',
                reverseButtons: true
            }).then((result) => {
                //if click yes deleted
                if (result.isConfirmed) {
                    $(this).parent().submit();


                    //if click no deleted
                    // show ok not deleted
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {

                    swalWithBootstrapButtons.fire(
                        'درخواست لفو شد',
                        'داده شما در امان است',
                        'error'
                    )
                }

            })
        });
    });
</script>
