<?php
require_once 'common/connectserver.php';
require_once 'common/auth.php';
require_once 'common/functions.php';

// Require login. This will redirect to /easy/login if session is dead.
$currentUser = requireLogin($conn);

// Pass the user's name to the topbar
$userName = htmlspecialchars($currentUser['full_name']);
$userEmail = htmlspecialchars($currentUser['email']);
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ERP Suite</title>
   <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="css/app.css">
  <link rel="stylesheet" href="css/components.css">
  <script src="assets/jquery.min.js"></script>
  <script src="assets/js/sweetalert2@11.js" ></script>

  <?php /* Future backend brand injection:
  <style>
    :root{
      --primary: <?= htmlspecialchars($brandPrimary) ?>;
      --secondary: <?= htmlspecialchars($brandSecondary) ?>;
    }
  </style>
  */ ?>
</head>
<body>

  <?php include 'partials/topbar.php'; ?>

  <div class="app-body">
    <?php include 'partials/sidebar.php'; ?>
    <main class="content" id="content-area">
      <div class="page-loader">
        <i class="fa-solid fa-spinner fa-spin"></i> Loading…
      </div>
    </main>
  </div>

  
  <script src="js/app.js"></script>
  <script src="js/functions.js"></script>
</body>
</html>