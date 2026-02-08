<?php
session_start();
$error_msg = $_SESSION['register_error'] ?? '';
unset($_SESSION['register_error']);

function showError($error)
{
    return !empty($error) ? "<div class='alert alert-danger py-2 mb-3' style='font-size: 12px; border-radius: 4px;'>$error</div>" : '';
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DICT R9 & BST | Register</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .register-container {
            max-width: 850px;
            margin: 0 auto;
        }

        .form-control-sm {
            height: 36px;
            font-size: 13px;
        }

        .agency-title {
            letter-spacing: -0.5px;
            color: #333;
        }

        .system-subtitle {
            font-size: 10px;
            letter-spacing: 1px;
            color: #1ab394;
        }

        /* Tightens the footer area */
        .loginColumns {
            padding-bottom: 0 !important;
        }
    </style>
</head>

<body class="gray-bg">
    <div class="loginColumns animated fadeInDown py-4">
        <div class="container-fluid px-0 register-container">

            <div class="row g-0 d-flex align-items-stretch shadow-sm rounded overflow-hidden bg-white mb-2" style="border: 1px solid #e7eaec;">

                <div class="col-md-4 p-0 d-none d-md-block">
                    <img src="img/headphones.jpg" alt="Register" class="w-100 h-100" style="object-fit: cover; min-height: 480px;">
                </div>

                <div class="col-md-8">
                    <div class="ibox-content h-100 d-flex flex-column justify-content-center py-4 px-4 px-lg-5 border-0">
                        <form id="registrationForm" role="form" action="controller/register.process.php" method="post">

                            <div class="mb-3 text-center text-md-start">
                                <h4 class="font-bold agency-title mb-0">DICT R9 & BST</h4>
                                <small class="system-subtitle font-bold text-uppercase">Account Access Request</small>
                            </div>

                            <?php echo showError($error_msg); ?>

                            <div class="form-group mb-2">
                                <label class="small font-bold mb-1">Full Name</label>
                                <input name="name" type="text" class="form-control form-control-sm" placeholder="Firstname Lastname" required>
                            </div>

                            <div class="form-group mb-2">
                                <label class="small font-bold mb-1">Email Address</label>
                                <input name="email" type="email" class="form-control form-control-sm" placeholder="name@dict.gov.ph" required>
                            </div>

                            <div class="row gx-2 mb-2">
                                <div class="col-md-6">
                                    <label class="small font-bold mb-1">Password</label>
                                    <input name="password" type="password" id="password" class="form-control form-control-sm" placeholder="••••••••" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="small font-bold mb-1">Confirm</label>
                                    <input name="confirm_password" type="password" id="confirm_password" class="form-control form-control-sm" placeholder="••••••••" required>
                                </div>
                                <div class="col-12">
                                    <div id="password-message" class="small mt-1"></div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="small font-bold mb-1">Organizational Role</label>
                                <select class="form-control form-control-sm" id="role" name="role" required>
                                    <option value="" disabled selected>Select Role</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>

                            <button type="submit" name="register" class="btn btn-primary w-100 mb-3 shadow-sm">Register Account</button>

                            <div class="text-center pt-2">
                                <p class="text-muted mb-1"><small>Already have credentials?</small></p>
                                <a class="btn btn-xs btn-outline-secondary w-100" href="login.php">Return to Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <div class="text-muted" style="font-size: 11px;">
                    <?php include 'view/partial/authforms_copyright.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/custom.js"></script>
    <script>
        const password = document.getElementById('password');
        const confirm_password = document.getElementById('confirm_password');
        const message = document.getElementById('password-message');

        function validatePassword() {
            if (password.value !== confirm_password.value) {
                message.textContent = "✘ Passwords do not match";
                message.className = "small mt-1 text-danger";
                confirm_password.setCustomValidity("Passwords do not match");
            } else {
                message.textContent = "✔ Passwords match";
                message.className = "small mt-1 text-success";
                confirm_password.setCustomValidity("");
            }
        }

        password.addEventListener('change', validatePassword);
        confirm_password.addEventListener('keyup', validatePassword);
    </script>
</body>

</html>