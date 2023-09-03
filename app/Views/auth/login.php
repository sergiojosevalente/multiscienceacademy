<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MSA - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>public/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>public/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php base_url() ?>public/assets/img/msa_logo.jpg" />

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-7 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-3 d-none d-lg-block"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back !</h1>
                                    </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="username"
                                                placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" placeholder="Password">
                                        </div>
                                        <button class="btn btn-primary btn-login btn-block">
                                            Login
                                        </button>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>public/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>public/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>public/assets/js/sb-admin-2.min.js"></script>

    <link href="<?= base_url('public/assets/plugins/toastr/toastr.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('public/assets/plugins/toastr/toastr.min.js') ?>"></script>
    <script>
        $(document).ready(function() {
            toastr.options = {
                closeButton: false,
                progressBar: false,
                positionClass: 'toast-top-right',
                preventDuplicates: true,
                showMethod: 'slideDown',
                hideMethod: 'slideUp',
                timeOut: 1000
            };

            $(".btn-login").click(function() {
                var username = $("#username").val();
                var password = $("#password").val();
                if (username.length == "") {
                    toastr.warning('Username Required !');
                } else if (password.length == "") {
                    toastr.warning('Password Required !');
                } else {
                    $.ajax({
                        url: "<?= base_url('validation') ?>",
                        type: "POST",
                        data: {
                            "username": username,
                            "password": password
                        },
                        success: function(response) {
                            let res = response.split("|");
                            if (res[0] == "success") {
                                toastr.success(res[1]);
                                setTimeout(function() {
                                    window.location.href = "<?php echo base_url('token') ?>";
                                }, 1000);
                            } else {
                                toastr.error(res[1]);
                            }
                        },
                        error: function(xhr, status, error) {
                            toastr.error('Authentication Failed.<br>Please Contact Admin!');
                        }
                    })
                }
            });
        });
    </script>

</body>

</html>