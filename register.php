<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Create your Account</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/reg.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="" alt="Celebrity Logo">
                  <span class="d-none d-lg-block">IPT2 MidTermProj</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">
    <div class="card-body">
        <div class="pt-6 pb-4">
            <h5 class="card-title text-center pb-0 fs-2">Create an Account</h5>
            <p class="text-center small">Complete you profile by filling in this account creation form.</p>
        </div>
  
        <?php
include 'database/registry.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Securely hash the password

    $sql = "INSERT INTO registeredusers (name, email, username, password) VALUES ('$name', '$email', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to login.php with a success message
        header("Location: login.php?message=success");
        exit(); // Ensure no further code is executed after redirection
    } else {
        $error = "Error: Unable to register user. Please try again.";
    }
}
?>


        <form  action="register.php"  method="POST">
            <div class="pt-6 pb-3 form-group" >
              <label for="name">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" required>
                <div class="invalid-feedback">Please enter your name!</div>
            </div>

            <div class="pt-6 pb-3 form-group">
            <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" required >
                <div class="invalid-feedback">Please enter a valid Email Address!</div>
            </div>

            <div class="pt-6 pb-3 form-group">
            <label for="username">Username</label>
                <div class="input-group has-validation">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                    <div class="invalid-feedback">Please make your username!</div>
                </div>
            </div>

            <div style="pt-6 pb-3 position: relative; width: 100%;">
            <label for="password">Password</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required style="width: 100%; padding-right: 40px;">
    <span onclick="togglePassword()" id="toggleIcon" style="position: absolute; right: 30px; top: 62%; transform: translateY(-50%); cursor: pointer; font-size: 1.2rem;">
        ✓ <!-- Checkmark icon for "visible" -->
    </span>
                <div class="invalid-feedback">Please enter your password!</div>
            </div>

            <div class="col-12">
                <div class="pt-4 pb-3 form-check">
                    <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                    <label class="form-check-label" for="acceptTerms" for="privacyPolicy">By creating an account, you agree to Celebrities Information Management System <a href="database/Register.php">Terms & Service<a href="database/Register.php"></a> and <a href="database/Register.php">Privacy Policy.</a></label>
                    <div class="invalid-feedback">You must agree to the terms & condition before submitting.</div>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Create Account</button>
            </div>
            <div class="pt-4 pb-3 col-12">
                <p class="text-center medium">Already have an account? <a href="login.php">Log in</a></p>
            </div>
        </form>
    </div>
</div>

<!-- Display Success or Error Messages -->
<?php if (!empty($success)): ?>
    <div style="color: green;"><?php echo $success; ?></div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div style="color: red;"><?php echo $error; ?></div>
<?php endif; ?>

<script>
function togglePassword() {
    const passwordField = document.getElementById("password");
    const toggleIcon = event.target;

    if (passwordField.type === "password") {
        passwordField.type = "text"; // Show password
        toggleIcon.textContent = "✓"; // Checkmark (visible)
    } else {
        passwordField.type = "password"; // Hide password
        toggleIcon.textContent = "✕"; // X (hidden)
    }
}
</script>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>