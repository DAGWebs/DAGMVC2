$(document).ready(function() {
    $('#username').on('input', function() {
        var username = $(this).val();

        if(username.length < 1) {
            $('#username').removeClass('is-primary');
            $('#username').removeClass('is-success')
            $('#username').addClass('is-danger');
            $('#username').addClass('has-text-danger');
        } else {
            $('#username').removeClass('is-danger');
            $('#username').removeClass('is-primary');
            $('#username').removeClass('has-text-danger');
            $('#username').addClass('is-success');
            $('#username').addClass('has-text-success');
        }
    });

    $('#username').on('click', function() {
        var username = $(this).val();

        if(username.length < 1) {
            $('#username').removeClass('is-primary');
            $('#username').removeClass('is-success')
            $('#username').addClass('is-danger');
            $('#username').addClass('has-text-danger');
        } else {
            $('#username').removeClass('is-danger');
            $('#username').removeClass('is-primary');
            $('#username').removeClass('has-text-danger');
            $('#username').addClass('is-success');
            $('#username').addClass('has-text-success');
        }
    });

    $('#password').on('input', function() {
        var username = $(this).val();

        if(username.length < 1) {
            $('#password').removeClass('is-primary');
            $('#password').removeClass('is-success')
            $('#password').addClass('is-danger');
            $('#password').addClass('has-text-danger');
        } else {
            $('#password').removeClass('is-danger');
            $('#password').removeClass('is-primary');
            $('#password').removeClass('has-text-danger');
            $('#password').addClass('is-success');
            $('#password').addClass('has-text-success');
        }
    });

    $('#password').on('click', function() {
        var username = $(this).val();

        if(username.length < 1) {
            $('#password').removeClass('is-primary');
            $('#password').removeClass('is-success')
            $('#password').addClass('is-danger');
            $('#password').addClass('has-text-danger');
        } else {
            $('#password').removeClass('is-danger');
            $('#password').removeClass('is-primary');
            $('#password').removeClass('has-text-danger');
            $('#password').addClass('is-success');
            $('#password').addClass('has-text-success');
        }
    });
})