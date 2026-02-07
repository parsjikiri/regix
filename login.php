<?php
session_start();

// Fetch error and immediately clear it from session so it doesn't stay there
$login_error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);

function showError($error)
{
    return !empty($error) ? "<div class='alert alert-danger p-2' style='font-size: 13px;'>$error</div>" : '';
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSPINIA | Login 2</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-10 mx-auto">
                    <div class="row g-0 shadow rounded overflow-hidden bg-white">

                        <div class="col-md-6 p-0">
                            <img src="img/headphones.jpg" alt="Welcome"
                                class="w-100 h-100"
                                style="object-fit: cover; min-height: 300px; display: block;">
                        </div>

                        <div class="col-md-6" id="login-form">
                            <div class="ibox-content h-100 d-flex flex-column justify-content-center p-4 p-lg-5 border-0">
                                <form role="form" action="controller/login.process.php" method="post" class="m-0">
                                    <h3 class="font-bold mb-4">Login to IN+</h3>

                                    <?php echo showError($login_error); ?>

                                    <div class="form-group mb-3">
                                        <input type="email" name="email" class="form-control" placeholder="Email" required="">
                                    </div>

                                    <div class="form-group mb-3">
                                        <input type="password" name="password" class="form-control" placeholder="Password" required="">
                                    </div>

                                    <button type="submit" name="login" id="login" class="btn btn-primary w-100 mb-3">Login</button>

                                    <div class="text-center">
                                        <a href="#"><small>Forgot password?</small></a>
                                        <p class="text-muted mt-3 mb-1"><small>Do not have an account?</small></p>
                                        <a class="btn btn-sm btn-outline-secondary w-100" href="register.php">Create an account</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <hr />
        <?php include 'view/partial/authforms_copyright.php'; ?>
    </div>

</body>

</html>