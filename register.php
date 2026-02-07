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
</head>

<body class="gray-bg">
    <div class="loginColumns animated fadeInDown">
        <div class="container-fluid px-0">
            <div class="row g-0 d-flex align-items-stretch shadow rounded overflow-hidden bg-white mb-5">

                <div class="col-md-4 p-0 d-none d-md-block">
                    <img src="img/headphones.jpg" alt="Register" class="w-100 h-100" style="object-fit: cover; min-height: 450px;">
                </div>

                <div class="col-md-8">
                    <div class="ibox-content h-100 d-flex flex-column justify-content-center p-4 p-lg-5 border-0">
                        <form id="registrationForm" role="form" action="controller/register.process.php" method="post">
                            <h3 class="font-bold mb-4">Create Account</h3>

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

                            <button type="submit" name="register" class="btn btn-primary w-100 mb-3">Register</button>

                            <div class="text-center">
                                <p class="text-muted mb-1"><small>Already have an account?</small></p>
                                <a class="btn btn-sm btn-outline-secondary w-100" href="login.php">Log-in Here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr />
            <?php include 'view/partial/authforms_copyright.php'; ?>
        </div>
    </div>

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

        // Trigger validation on both inputs for better UX
        password.addEventListener('change', validatePassword);
        confirm_password.addEventListener('keyup', validatePassword);
    </script>
</body>

</html>