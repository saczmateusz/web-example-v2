<?php
session_start();

$msg = '';

if (isset($_SESSION['admin'])) {
    header('Location: admin-dashboard.php');
    die();
}

if (isset($_POST['submit'])) {
    if ($_POST['login'] == 'admin' && $_POST['password'] == 'admin') {
        $_SESSION['admin'] = true;
        header('Location: admin-dashboard.php');
        die();
    } else {
        $msg = "Złe dane logowania";
    }
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
  <title>Admin Login</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" />
</head>

<body>
  <header>
    <div class="header-title">
      <h1 class="animate-left">Logowanie</h1>
    </div>
    <div class="animate-right">
      <a href="../" class="button delete">Wróć</a>
    </div>
  </header>

  <div class="content container">
    <div class="card login-card">
      <form action="" enctype="multipart/form-data" method="POST">
        <div class="form-group">
          <label for="login">Login</label>
          <input type="text" name="login" class="form-control <?php echo $msg ? 'is-invalid' : ''; ?>">
          <div class="form-group">
            <label for="password">Hasło</label>
            <input type="password" name="password" class="form-control <?php echo $msg ? 'is-invalid' : ''; ?>">
            <?php if ($msg): ?>
            <div class="invalid-feedback"><?php echo $msg; ?></div>
            <?php endif;?>
          </div>
          <div class="form-group submit-login">
            <button name="submit" class="button view">Zaloguj</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <footer>
    <p>
      © 2020 Mateusz Sączawa. All rights reserved.
    </p>
  </footer>

  <div class="loading">
    <img src="../assets/img/planet.svg" />
  </div>

  <!-- <script src="../assets/js/script.js"></script> -->
</body>

</html>