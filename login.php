<?php
// Lampirkan db dan User
require_once "koneksi.php";
require_once "user.php";

//Buat object user
$user = new User($db);

//Jika sudah login
if ($user->isLoggedIn()) {
    header("location: index.php"); //redirect ke index
}

//jika ada data yg dikirim
if (isset($_POST['kirim'])) {
    $nip      = $_POST['nip'];
    $password = $_POST['password'];

    // Proses login user
    if ($user->login($nip, $password)) {
        header("location: index.php");
    } else {
        // Jika login gagal, ambil pesan error
        $error = $user->getLastError();
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <title>Sistem Persediaan Amanda Reload</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="dist/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="dist/css/matrix-login.css" />
    <link href="dist/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="loginbox">
        <form id="loginform" class="form-vertical" method="post" >
            <div class="control-group normal_text">
                <h1>Amanda Reload</h1>
            </div>
            <?php if (isset($error)): ?>
                <?php echo $error ?>
              <?php endif; ?>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_lg"><i class="fa fa-user"> </i></span><input type="text" placeholder="Masukkan NIP" name="nip"/>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_ly"><i class="fa fa-lock"></i></span><input type="password" placeholder="Masukkan Kata Sandi" name="password"/>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <span><button type="submit" class="btn btn-success btn-block" name="kirim"/> Login</button></span>
            </div>
        </form>
    </div>
    <script src="dist/js/jquery.min.js"></script>
    <script src="dist/js/matrix.login.js"></script>
</body>

</html>
