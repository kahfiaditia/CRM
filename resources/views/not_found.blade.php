<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Akses di Tolak</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        @include('layouts.css')
    </head>

    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-5 text-muted">
                            <a href="index.html" class="d-block auth-logo">
                                <img src="assets/images/logo-dark.png" alt="" height="20"
                                    class="auth-logo-dark mx-auto">
                                <img src="assets/images/logo-light.png" alt="" height="20"
                                    class="auth-logo-light mx-auto">
                            </a>
                            <p class="mt-3">Akses Anda di Tolak</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body">

                                <div class="p-2">
                                    <div class="text-center">

                                        <div class="avatar-md mx-auto">
                                            <div class="avatar-title rounded-circle bg-light">
                                                <i class="bx bx-mail-send h1 mb-0 text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="p-2 mt-4">
                                            <h4>Success !</h4>
                                            <p class="text-muted">Silahkan kirim pesan atau nyatakan dengan baik kepada
                                                bagian terkait untuk anda mendapatkan hak akses ini</p>
                                            <div class="mt-4">
                                                <a href="{{ route('dashboard') }}" class="btn btn-success">Back to
                                                    Dashbaord</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="mt-5 text-center">

                            <p>©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Team Management Akses </i>
                                by Apotek
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @include('layouts.js')
    </body>

</html>
