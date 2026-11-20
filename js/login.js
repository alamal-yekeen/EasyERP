$(function() {
    setTimeout(function() {
        $('#brand-panel').addClass('visible');
        setTimeout(function() {
            $('#login-card').addClass('visible');
            setTimeout(function() {
                $('#field1').addClass('in');
                setTimeout(function() {
                    $('#field2').addClass('in');
                    setTimeout(function() {
                        $('#btnRow').addClass('in');
                    }, 150);
                }, 120);
            }, 300);
        }, 200);
    }, 80);

    $('#togglePw').on('click', function() {
        var $input = $('#acesskey');
        var $icon = $('#pwIcon');
        if ($input.attr('type') === 'password') {
            $input.attr('type', 'text');
            $icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            $input.attr('type', 'password');
            $icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    $(document).on('mousemove', function(e) {
        var mx = (e.clientX / window.innerWidth - 0.5) * 10;
        var my = (e.clientY / window.innerHeight - 0.5) * 6;
        $('#brand-panel').css('transform',
            'rotateY(' + (8 + mx * 0.3) + 'deg) translateY(' + (my * 0.5) + 'px)');
        $('#login-card').css('transform',
            'rotateY(' + (-4 + mx * 0.2) + 'deg) translateY(' + (my * 0.4) + 'px)');
    });

    // $('#loginForm').on('submit', function(e) {
    //     e.preventDefault();
    //     $('#btn-label').hide();
    //     $('#spinner').show();

    //     alert('Login functionality is not implemented in this demo.');

    //     setTimeout(function() {
    //         $('#btn-label').show();
    //         $('#spinner').hide();
    //     }, 3000);
    // });

    $(function() {
        // ... your entrance animation + password toggle stay as-is ...

        $('#loginForm').on('submit', function(e) {
            e.preventDefault(); // ← AJAX, not native submit

            var $btn = $('#submit-btn');
            var $label = $('#btn-label');
            var $spin = $('#spinner');
            var $msg = $('#msg');

            $msg.text('');
            $label.hide();
            $spin.show();
            $btn.prop('disabled', true);
            var payload = {
                email: $('#access').val().trim(),
                password: $('#acesskey').val(),
                csrf: $('input[name="csrf"]').val(),
                login: 1
            }
            // console.log('Payload:', payload);

            $.ajax({
                    url: 'loginbk',
                    method: 'POST',
                    contentType: 'application/json',
                    dataType: 'json',
                    data: JSON.stringify(payload)
                })
                .done(function(res) {
                    console.log('Response:', res);
                    // return;
                    if (res && res.ok) {
                        successmessage('Login successful! Redirecting...');
                        setTimeout(function() {
                            window.location.href = res.redirect || 'home';
                        }, 1500);
                    } else {
                    console.log('Response:', res);
                        errormessage((res && res.error) || 'Login failed.');
                        $msg.text((res && res.error) || 'Login failed.');
                        $spin.hide();
                        $label.show();
                        $btn.prop('disabled', false);
                    }
                })
                .fail(function(xhr) {
                    var err = (xhr.responseJSON && xhr.responseJSON.error) ||
                        'Login failed.';
                    errormessage(err);
                    $msg.text(err);
                    $spin.hide();
                    $label.show();
                    $btn.prop('disabled', false);
                });
        });
    });

});