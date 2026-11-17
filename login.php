<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="apple-touch-icon" type="image/png" href="img/clientlogo.jpg" />
    <link rel="shortcut icon" type="image/x-icon" href="img/clientlogo.jpg" />
    <link rel="mask-icon" type="image/x-icon" href="img/clientlogo.jpg" color="#f4efe3" />
    <title>Easy — Enterprise Portal</title>
    <script src="assets/jquery.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <!-- <script src="js/jquery.transit.js"></script> -->
</head>

<body translate="no">

    <div id="scene">
        <div id="bg-base"></div>
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div id="stars"></div>
        <div id="grid-floor"></div>
        <div id="light-beam"></div>
    </div>

    <div id="stage">

        <div id="brand-panel">
            <div class="brand-glass"></div>
            <div class="brand-content">
                <div class="logo-ring">
                    <img src="img/clientlogo.jpg" alt="FINAQ Logo" onerror="this.style.display='none'" />
                </div>
                <div class="brand-name">Easy</div>
                <div class="brand-tagline">Enterprise Resource Planning</div>
                <div class="brand-divider"></div>
                <div class="brand-descriptor">
                    <span>Finance &amp; Operations</span>
                    <span>Analytics &amp; Intelligence</span>
                    <span>Unified Platform</span>
                </div>
            </div>
        </div>

        <div id="connector"></div>

        <div id="login-card">
            <div class="card-glass"></div>
            <div class="corner-ornament"></div>
            <div class="card-inner">

                <div class="login-header">
                    <div id="msg-area"><span id="msg"></span></div>
                    <div class="login-welcome">Welcome Back</div>
                    <div class="login-sub">Sign in to your account</div>
                    <div class="gold-rule"></div>
                </div>

                <form autocomplete="off" id="loginForm">
                    <div class="field-group" id="field1">
                        <div class="field-label">Username</div>
                        <div class="field-wrap">
                            <input type="text" id="access" class="field-input transs" placeholder="username@domain.com"
                                required />
                            <i class="fas fa-user"></i>
                            <input id="access1" type="hidden"
                                value="<?php echo date('Ymd').(sprintf('%06d',(gettimeofday()['usec']))); ?>">
                            <?php echo "<input id='accesst' type='hidden'>"; ?>
                        </div>
                    </div>

                    <div class="field-group" id="field2">
                        <div class="field-label">Password</div>
                        <div class="field-wrap">
                            <input type="password" id="acesskey" class="field-input transs" required />
                            <i class="fas fa-lock"></i>
                            <button type="button" class="toggle-pw" id="togglePw" tabindex="-1">
                                <i class="fas fa-eye" id="pwIcon"></i>
                            </button>
                            <?php echo "<input id='acesskeyt' type='hidden'>"; ?>
                        </div>
                    </div>

                    <div class="btn-row" id="btnRow">
                        <button type="submit" id="submit-btn" form="loginForm">
                            <span id="btn-label">Sign In</span>
                            <div class="spinner" id="spinner"></div>
                        </button>
                        <a href="#" class="forgot-link">Forgot password?</a>
                    </div>
                </form>

                <div class="copyright">
                    &copy; RLLC <?php echo date("Y"); ?> &nbsp;&middot;&nbsp; Easy ERP Platform
                </div>

            </div>
        </div>

    </div><!-- /#stage -->

    <script>
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

        $('#loginForm').on('submit', function(e) {
          e.preventDefault();
            $('#btn-label').hide();
            $('#spinner').show();

            alert('Login functionality is not implemented in this demo.');

            setTimeout(function() {
                $('#btn-label').show();
                $('#spinner').hide();
            }, 3000);
        });

    });
    </script>

</body>

</html>