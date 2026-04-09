$(function () {
    const $datePicker = $('#datePicker');
    const fp = $datePicker.length
        ? flatpickr($datePicker[0], { dateFormat: 'Y/m/d' })
        : null;

    const $password = $('#password');
    const $confirm = $('#password_confirmation');

    $confirm.on('input', function () {
        const ok = ($confirm.val() || '') === ($password.val() || '');
        this.setCustomValidity(ok ? '' : 'Passwords must match.');
    });
});

