<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Zoter - Responsive Bootstrap 4 Admin Dashboard</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <div class="text-center">
                        <a href="" class="logo logo-admin"><img src="assets/images/e-logo.png" height="20" alt="logo"></a>
                    </div>

                    <div class="p-3">
                        <form method="POST" action="{{ route('register') }}">
                        @csrf

                            <div class="form-group row">
                                <div class="col-12">
                                    <input name = "email" class="form-control" type="email" required="" placeholder="Email">
                                </div>
                            </div>

                            @error('email')
                                <strong>{{ $message }}</strong>
                            @enderror

                            <div class="form-group row">
                                <div class="col-12">
                                    <input style = "text-transform: capitalize" name = "name" class="form-control" type="text" required="" placeholder="Username">
                                </div>
                            </div>

                            @error('username')
                                <strong>{{ $message }}</strong>
                            @enderror

                            <div class="form-group row">
                                <div class="col-12">
                                    <input id = "name" name = "password" class="form-control" type="password" required="" placeholder="Password">
                                </div>
                            </div>

                            @error('password')
                                <strong>{{ $message }}</strong>
                            @enderror

                            <div class="form-group row">
                                <div class="col-12">
                                    <input name = "password_confirmation" class="form-control" type="password" required="" placeholder="Confirm Password">
                                </div>
                            </div>
                            

                            <div class="form-group text-center row m-t-20">
                                <div class="col-12">
                                <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">{{ __('Register') }}</button>
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row">
                                <div class="col-12 m-t-20 text-center">
                                    <a href="/login" class="text-muted">Already have account?</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>



        <!-- jQuery  -->
        
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('assets/js/detect.js') }}"></script>
        <script src="{{ asset('assets/js/fastclick.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('assets/js/waves.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
        
        <!-- App js -->
        <script src="assets/js/app.js"></script>
        

        <script>
            $("#UserName").on({
                keydown: function(e) {
                    if (e.which === 32)
                    return false;
                },
                change: function() {
                    this.value = this.value.replace(/\s/g, "");
                }
            });
        </script>
    </body>
</html>