<?php
session_start();
if (!isset($_SESSION["RegState"])) $_SESSION["RegState"] = 0;
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.108.0">
        <title>CIS4398 - Lab 2</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
        <link href="./css/bootstrap.min.css" rel="stylesheet">

        <style>
         .bd-placeholder-img {
             font-size: 1.125rem;
             text-anchor: middle;
             -webkit-user-select: none;
             -moz-user-select: none;
             user-select: none;
         }

         @media (min-width: 768px) {
             .bd-placeholder-img-lg {
                 font-size: 3.5rem;
             }
         }

         .b-example-divider {
             height: 3rem;
             background-color: rgba(0, 0, 0, .1);
             border: solid rgba(0, 0, 0, .15);
             border-width: 1px 0;
             box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
         }

         .b-example-vr {
             flex-shrink: 0;
             width: 1.5rem;
             height: 100vh;
         }

         .bi {
             vertical-align: -.125em;
             fill: currentColor;
         }

         .nav-scroller {
             position: relative;
             z-index: 2;
             height: 2.75rem;
             overflow-y: hidden;
         }

         .nav-scroller .nav {
             display: flex;
             flex-wrap: nowrap;
             padding-bottom: 1rem;
             margin-top: -1px;
             overflow-x: auto;
             text-align: center;
             white-space: nowrap;
             -webkit-overflow-scrolling: touch;
         }
        </style>


        <!-- Custom styles for this template -->
        <link href="./css/sign-in.css" rel="stylesheet">
    </head>
    <body class="text-center">

        <main class="form-signin w-100 m-auto">

            <?php
            if ($_SESSION["RegState"] <= 0) {
            ?>
                <!-- Login form -->
                <form id="loginForm">
                    <img class="mb-4" src="./assets/bootstrap-logo.svg" alt="" width="72" height="57">
                    <h1 class="h3 mb-3 fw-normal">Please Sign In</h1>

                    <div class="form-floating">
                        <input type="email" class="form-control" name="loginEmail" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="loginPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>

                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                    <a href="./php/redirectRegister.php">Register</a>
                    |
                    <a href="./php/redirectResetPassword.php">Forget?</a>
                    <div class="w-100 btn btn-warning btn-block mt-2" id="loginMessage"></div>
                </form>
            <?php
            }

            if ($_SESSION["RegState"] == 1) {
            ?>

                <!-- Register form -->
                <form id="registerForm" action="./php/register.php" method="post">
                    <img class="mb-4" src="./assets/bootstrap-logo.svg" alt="" width="72" height="57">
                    <h1 class="h3 mb-3 fw-normal">Please Register</h1>

                    <div class="form-floating">
                        <input type="text" class="form-control" name="registerFirstname" placeholder="John">
                        <label for="floatingInput">First name</label>
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control" name="registerLastname" placeholder="Doe">
                        <label for="floatingInput">Last name</label>
                    </div>

                    <div class="form-floating">
                        <input type="email" class="form-control" name="registerEmail" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
                    <a class="btn btn-primary mt-2" href="./php/return.php">Return</a>
                    <div class="w-100 btn btn-warning btn-block mt-2" id="registerMessage">
                        <?php
                        print $_SESSION["Message"];
                        $_SESSION["Message"] = ""; // Show only once
                        ?>
                    </div>
                </form>
            <?php
            }

            if ($_SESSION["RegState"] == 2) {
            ?>
                <!-- Authentication form -->
                <form id="authenticationForm">
                    <img class="mb-4" src="./assets/bootstrap-logo.svg" alt="" width="72" height="57">
                    <h1 class="h3 mb-3 fw-normal">Please Enter Authentication Code</h1>

                    <div class="form-floating">
                        <input type="text" class="form-control" name="authenticationCode" placeholder="Authentication code from your email">
                        <label for="floatingInput">Authentication code</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">Authenticate</button>
                    <div class="w-100 btn btn-warning btn-block mt-2" id="authenticationMessage"></div>
                </form>


                <!-- Set password form -->
                <form id="setPasswordForm">
                    <img class="mb-4" src="./assets/bootstrap-logo.svg" alt="" width="72" height="57">
                    <h1 class="h3 mb-3 fw-normal">Please Set New Password</h1>

                    <div class="form-floating">
                        <input type="password" class="form-control" name="setPassword1" placeholder="Password">
                        <label for="floatingInput">Password</label>
                    </div>

                    <div class="form-floating">
                        <input type="password" class="form-control" name="setPassword2" placeholder="Confirm Password">
                        <label for="floatingInput">Confirm Password</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">Set Password</button>
                    <div class="w-100 btn btn-warning btn-block mt-2" id="setPasswordMessage"></div>
                </form>
            <?php
            }
            if ($_SESSION["RegState"] == 3) {
            ?>
                <!-- Reset password form -->
                <form id="resetPasswordForm">
                    <img class="mb-4" src="./assets/bootstrap-logo.svg" alt="" width="72" height="57">
                    <h1 class="h3 mb-3 fw-normal">Please Enter a Registered Email</h1>

                    <div class="form-floating">
                        <input type="email" class="form-control" name="resetPasswordEmail" placeholder="name@example.com">
                        <label for="floatingInput">Registered email</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">Authenticate Email</button>
                    <div class="w-100 btn btn-warning btn-block mt-2" id="resetPasswordMessage"></div>
                    <a class="btn btn-primary mt-2" href="./php/return.php">Return</a>
                </form>
            <?php
            }
            ?>
        </main>

    </body>
</html>
