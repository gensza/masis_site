<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Error Page | 500 | Internal Server Error | UBold - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <!-- App css -->
    <link href="../assets/css/bootstrap-material.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="../assets/css/app-material.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="../assets/css/bootstrap-material-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="../assets/css/app-material-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="loading authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="auth-logo">
                                <a href="index.html" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="../assets/images/logo-dark.png" alt="" height="22">
                                    </span>
                                </a>

                                <a href="index.html" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="../assets/images/logo-light.png" alt="" height="22">
                                    </span>
                                </a>
                            </div>

                            <div class="text-center mt-4">
                                <h1 class="text-error">500</h1>
                                <h3 class="mt-3 mb-2">Internal Server Error</h3>
                                <p class="text-muted mb-3">DATABASE Not Found! <br><a href="" class="text-dark"><b>Develop By @genszanando <- Follow My Instgaram</b></a></p>

                                <a href="<?= base_url('Auth') ?>" class="btn btn-success waves-effect waves-light">Back to Login</a>
                            </div>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->


    <footer class="footer footer-alt">
        2015 - <script>
            document.write(new Date().getFullYear())
        </script> &copy; UBold theme by <a href="" class="text-white-50">Coderthemes</a>
    </footer>

    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>

</body>

</html>