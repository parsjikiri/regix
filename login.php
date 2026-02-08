<?php
session_start();
// Get error from session if it exists (e.g., from a previous failed non-AJAX attempt)
$login_error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);

function showError($error)
{
    // If $error is empty, we add 'd-none' to hide the box.
    $hideClass = empty($error) ? 'd-none' : '';

    return "
    <div id='error-box' class='alert alert-danger p-2 border-0 shadow-sm mb-3 $hideClass' style='font-size: 12px; border-left: 3px solid #ed5565;'>
        <i class='fa fa-times-circle me-1'></i> 
        <span id='error-msg'>$error</span>
    </div>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IN+ | Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
</head>

<body>

    <div class="login-container animated fadeInDown">
        <div class="shadow-lg login-card">
            <div class="img-col d-none d-md-block">
                <img src="img/headphones.jpg" alt="Login">
            </div>

            <div class="form-col">
                <div class="mb-3">
                    <h5 class="fw-bold mb-0">Member Login</h5>
                    <p class="text-muted" style="font-size: 12px;">Access your workspace.</p>
                </div>

                <?php echo showError($login_error); ?>

                <form id="loginForm">
                    <div class="mb-2">
                        <label class="small-label fw-bold">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="user@domain.com" required>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="small-label fw-bold">Password</label>
                            <a href="#" class="text-decoration-none fw-bold" style="color: var(--primary); font-size: 10px;">Forgot?</a>
                        </div>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                            <i class="fa fa-eye password-toggle" id="togglePass"></i>
                        </div>
                    </div>

                    <button type="submit" id="submitBtn" class="btn btn-primary w-100">
                        <span id="btnText">Sign In</span>
                    </button>
                </form>

                <div class="icon-action-bar">
                    <a href="register.php" class="icon-btn" title="Create Account">
                        <i class="fa fa-user-plus"></i> Register
                    </a>
                    <a href="servicenow.php" class="icon-btn" title="Service Request">
                        <i class="fa fa-life-ring"></i> ServiceNow
                    </a>
                </div>

                <div class="text-center mt-3">
                    <small style="font-size: 10px; color: #ccc;">
                        <?php include 'view/partial/authforms_copyright.php'; ?>
                    </small>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Password Toggle
        document.getElementById('togglePass').addEventListener('click', function() {
            const passInput = document.getElementById('password');
            const isPass = passInput.type === 'password';
            passInput.type = isPass ? 'text' : 'password';
            this.classList.toggle('fa-eye-slash', !isPass);
            this.classList.toggle('fa-eye', isPass);
        });

        // AJAX Submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const errorBox = document.getElementById('error-box');
            const errorMsg = document.getElementById('error-msg');

            // Reset UI state
            btn.disabled = true;
            btnText.innerHTML = '<i class="fa fa-circle-o-notch fa-spin"></i> Processing...';
            errorBox.classList.add('d-none');

            const formData = new FormData(this);
            formData.append('login', 'true');

            fetch('controller/login.process.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    // If login.process.php does a header("Location: ...")
                    if (response.redirected) {
                        window.location.href = response.url;
                        return;
                    }
                    return response.text();
                })
                .then(data => {
                    btn.disabled = false;
                    btnText.innerText = 'Sign In';

                    // If the PHP returns any text, it's treated as an error message
                    if (data && data.trim() !== "") {
                        errorMsg.innerText = data.trim();
                        errorBox.classList.remove('d-none');
                    }
                })
                .catch(error => {
                    btn.disabled = false;
                    btnText.innerText = 'Sign In';
                    errorMsg.innerText = "A connection error occurred.";
                    errorBox.classList.remove('d-none');
                });
        });
    </script>
</body>

</html>