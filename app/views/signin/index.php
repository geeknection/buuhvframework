<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <title>Login</title>
    <meta charset="UTF-8"></meta>
    <link rel='stylesheet' href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel='stylesheet' href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
    <link rel='stylesheet' href="<?php echo App::layout('/stylesheet/signin.css'); ?>"/>
</head>
<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Sign In</h5>
                        <form class="form-signin" method='POST' onsubmit="return onSubmitSignIn(event);">
                            <div class="form-label-group">
                                <input type="email" id="inputEmail" autocomplete class="form-control" placeholder="Email address" required autofocus>
                                <label for="inputEmail">Email address</label>
                            </div>

                            <div class="form-label-group">
                                <input type="password" id="inputPassword" autocomplete class="form-control" placeholder="Password" required>
                                <label for="inputPassword">Password</label>
                            </div>

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Remember password</label>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src='<?php echo App::layout('/javascript/axios.min.js'); ?>'></script>
    <script src='<?php echo App::layout('/javascript/signin.js'); ?>'></script>
</body>
</html>