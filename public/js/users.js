$(function () {
    const $datePicker = $('#datePicker');
    const fp = $datePicker.length
        ? flatpickr($datePicker[0], { dateFormat: 'Y/m/d' })
        : null;

    $('#btnClearForm').on('click', function () {
        $('#full_name').val('');
        $('#email').val('');
        $('#phone').val('');
        if (fp) fp.clear();
        $('#searchForm input[name="user_flg[]"]').prop('checked', true);
    });

    $('#importFile').on('change', function () {
        if (this.files && this.files.length > 0) {
            $('#importForm').trigger('submit');
        }
    });

    $(document).on('submit', 'form.btn-delete', function (e) {
        e.preventDefault();
        const form = this;

        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to delete this user?',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

