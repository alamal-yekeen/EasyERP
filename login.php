<?php
$cfg = $config;
secureSessionStart($cfg);
// Already logged in? bounce to dashboard
if (!empty($_SESSION['user_id'])) {
    header('Location: dashboard');
    exit;
}
$csrf = csrfToken();
?>

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

                <form autocomplete="off" id="loginForm" method="post">
                    <input type="hidden" name="csrf" value="<?= htmlspecialchars($csrf, ENT_QUOTES) ?>">

                    <!-- Username -->
                    <div class="field-group" id="field1">
                        <div class="field-label">Username</div>
                        <div class="field-wrap">
                            <input type="email" id="access" name="email" class="field-input transs"
                                placeholder="username@domain.com" required />
                            <i class="fas fa-user"></i>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="field-group" id="field2">
                        <div class="field-label">Password</div>
                        <div class="field-wrap">
                            <input type="password" id="acesskey" name="password" class="field-input transs" required />
                            <i class="fas fa-lock"></i>
                            <button type="button" class="toggle-pw" id="togglePw" tabindex="-1">
                                <i class="fas fa-eye" id="pwIcon"></i>
                            </button>
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
    <script src="assets/js/sweetalert2@11.js" ></script>
    <script src="js/functions.js" crossorigin="anonymous"></script>
    <script src="js/login.js" crossorigin="anonymous"></script>


</body>

</html>