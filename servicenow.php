<?php
session_start();
// Fetch errors from session and clear them so they don't persist on refresh
$error_msg = $_SESSION['register_error'] ?? '';
unset($_SESSION['register_error']);

function showError($error)
{
    return !empty($error) ? "<div class='alert alert-danger py-2 small'>$error</div>" : '';
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSPINIA | Register </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        /* Restrict width for better aesthetics on wide screens */
        .register-container {
            max-width: 850px;
            margin: 0 auto;
        }
    </style>
</head>

<body class="gray-bg">
    <div class="loginColumns animated fadeInDown pt-4">
        <div class="container-fluid px-0 register-container">
            <div class="row g-0 d-flex align-items-stretch shadow rounded overflow-hidden bg-white mb-3">

                <div class="col-md-4 p-0 d-none d-md-block">
                    <img src="img/headphones.jpg" alt="Register" class="w-100 h-100" style="object-fit: cover; min-height: 450px;">
                </div>

                <div class="col-md-8">
                    <div class="ibox-content h-100 d-flex flex-column justify-content-center p-4 p-lg-5 border-0">
                        <form id="registrationForm" role="form" action="controller/register.process.php" method="post">
                            <h3 class="font-bold mb-4">Service Request Form</h3>

                            <?php echo showError($error_msg); ?>

                            <div class="form-group mb-3">
                                <input name="name" type="text" class="form-control" placeholder="Full Name" required>
                            </div>
                            <div class="form-group mb-3">
                                <input name="email" type="email" class="form-control" placeholder="Email Address" required>
                            </div>

                            <div class="row gx-2">
                                <div class="col-md-6 mb-3">
                                    <input name="password" type="password" id="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input name="confirm_password" type="password" id="confirm_password" class="form-control" placeholder="Confirm Password" required>
                                    <div id="password-message" class="small mt-1"></div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <select class="form-control" id="role" name="role" required>
                                    <option value="" disabled selected>Select Role</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>

                            <button type="submit" name="register" class="btn btn-primary w-100 mb-3">Service Request</button>

                            <div class="text-center">
                                <p class="text-muted mb-1"><small>Are you an admin?</small></p>
                                <a class="btn btn-sm btn-outline-secondary w-100" href="login.php">Log-in Here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <hr class="mt-0 mb-2" />
                <div class="text-muted small">
                    <?php include 'view/partial/authforms_copyright.php'; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>