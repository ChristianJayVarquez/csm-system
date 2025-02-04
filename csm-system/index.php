<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM System</title>
    <link rel="website icon" type="png" href="logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        body{
            margin:0;
            color:#6a6f8c;
            font:600 16px/18px 'Open Sans',sans-serif;
        }

        *,:after,:before{box-sizing:border-box}
        .clearfix:after,.clearfix:before{content:'';display:table}
        .clearfix:after{clear:both;display:block}
        a{color:inherit;text-decoration:none}

        .logo {
            position: absolute;
            top: 20px; /* Adjust as needed */
            right: 20px; /* Adjust as needed */
            width: 100px; /* Adjust as needed */
            height: auto;
            z-index: 10;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            max-width: 100%;
            height: auto;
            border-radius: 50%;
        }

        .deped-logo {
            position: absolute;
            top: 20px; /* Adjust as needed */
            z-index: 10;
            justify-content: center;
            align-items: center;
            display: block;
            margin: 5px auto 20px auto;
            max-width: 40%;
            height: auto;
        }

        .login-wrap {
            width: 100%;
            margin: auto;
            max-width: 525px;
            min-height: 670px;
            position: relative;
            background: url("bg.jpg") no-repeat center;
            box-shadow: 0 12px 15px 0 rgba(0, 0, 0, .24), 0 17px 50px 0 rgba(0, 0, 0, .19);
        }

        .login-html {
            width: 100%;
            height: 100%;
            position: absolute;
            padding: 90px 70px 50px 70px;
            background: rgba(42, 42, 82, 0.7); /* Darkened overlay for readability */
            border-radius: 10px;
        }

        .login-html .sign-in-htm,
        .login-html .sign-up-htm{
            top:0;
            left:0;
            right:0;
            bottom:0;
            position:absolute;
            transform:rotateY(180deg);
            backface-visibility:hidden;
            transition:all .4s linear;
        }
    
        .login-html .sign-in,
        .login-html .sign-up,
        .login-form .group .check{
            display:none;
        }

        .login-html .tab,
        .login-form .group .label,
        .login-form .group .button{
            text-transform:uppercase;
        }

        .login-html .tab{
            font-size:22px;
            margin-right:15px;
            padding-bottom:5px;
            margin:0 15px 10px 0;
            display:inline-block;
            border-bottom:2px solid transparent;
        }

        .login-html .sign-in:checked + .tab,
        .login-html .sign-up:checked + .tab{
            color:#fff;
            border-color:#1161ee;
        }

        .login-form{
            min-height:345px;
            position:relative;
            perspective:1000px;
            transform-style:preserve-3d;
        }

        .login-form .group{
            margin-bottom:15px;
        }

        .login-form .group .label,
        .login-form .group .input,
        .login-form .group .button{
            width:100%;
            color:#fff;
            display:block;
        }

        .login-form .group .input,
        .login-form .group .button{
            border:none;
            padding:15px 20px;
            border-radius:25px;
            background:rgba(255,255,255,.1);
        }

        .login-form .group input[data-type="password"]{
            text-security:circle;
            -webkit-text-security:circle;
        }

        .login-form .group .label{
            color:#aaa;
            font-size:12px;
        }

        .login-form .group .button{
            background:#1161ee;
        }

        .login-form .group label .icon{
            width:15px;
            height:15px;
            border-radius:2px;
            position:relative;
            display:inline-block;
            background:rgba(255,255,255,.1);
        }

        .login-form .group label .icon:before,
        .login-form .group label .icon:after{
            content:'';
            width:10px;
            height:2px;
            background:#fff;
            position:absolute;
            transition:all .2s ease-in-out 0s;
        }

        .login-form .group label .icon:before{
            left:3px;
            width:5px;
            bottom:6px;
            transform:scale(0) rotate(0);
        }

        .login-form .group label .icon:after{
            top:6px;
            right:0;
            transform:scale(0) rotate(0);
        }

        .login-form .group .check:checked + label{
        color:#fff;
        }
        
        .login-form .group .check:checked + label .icon{
            background:#1161ee;
        }
        
        .login-form .group .check:checked + label .icon:before{
            transform:scale(1) rotate(45deg);
        }

        .login-form .group .check:checked + label .icon:after{
            transform:scale(1) rotate(-45deg);
        }

        .login-html .sign-in:checked + .tab + .sign-up + .tab + .login-form .sign-in-htm{
            transform:rotate(0);
        }

        .login-html .sign-up:checked + .tab + .login-form .sign-up-htm{
            transform:rotate(0);
        }

        .hr{
            height:2px;
            margin:60px 0 50px 0;
            background:rgba(255,255,255,.2);
        }
        
        .foot-lnk{
            text-align:center;
        }
    </style>
    <?php
        if (isset($_SESSION['error'])) {
            echo "<script>
                window.onload = function() {
                    toastr.error('" . $_SESSION['error'] . "');
                }
            </script>";
            unset($_SESSION['error']);
        }
    ?>
</head>
<body>
    <div class="login-wrap">
        <div class="login-html">
            <div class="logo-container">
                <img src="deped.png" alt="CSM System Logo" class="deped-logo">
                <img src="logo.png" alt="CSM System Logo" class="logo">
            </div><br/>
            <br/><br/><center><h4 style="color: #fff;">CSM SYSTEM</h4></center><br/>
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
            <label for="tab-1" class="tab">Sign In</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up">
            <label for="tab-2" class="tab">Sign Up</label>
            <div class="login-form">
                <div class="sign-in-htm">
                    <form action="login.php" method="POST">
                        <div class="group">
                            <label for="login-user" class="label">Username</label>
                            <input id="login-user" name="username" type="text" class="input" required>
                        </div>
                        <div class="group">
                            <label for="login-pass" class="label">Password</label>
                            <input id="login-pass" name="password" type="password" class="input" data-type="password" required>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Sign In">
                        </div>
                        <div class="foot-lnk">
                            <label for="tab-2" style="color: #ffff;">Don't have an account?</label>
                            <div class="hr"></div>
                            <a href="#forgot" style="color: #ffff;">Welcome to Login Page of the CSM System</a>
                        </div>
                    </form>
                </div>
                <div class="sign-up-htm">
                    <form action="register.php" method="POST">
                        <div class="group">
                            <label for="register-user" class="label">Username</label>
                            <input id="register-user" name="username" type="text" class="input" required>
                        </div>
                        <div class="group">
                            <label for="register-email" class="label">Email Address</label>
                            <input id="register-email" name="email" type="email" class="input" required>
                        </div>
                        <div class="group">
                            <label for="register-pass" class="label">Password</label>
                            <input id="register-pass" name="password" type="password" class="input" data-type="password" required>
                        </div>
                        <div class="group">
                            <label for="register-pass-repeat" class="label">Repeat Password</label>
                            <input id="register-pass-repeat" name="repeat_password" type="password" class="input" data-type="password" required>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Sign Up">
                        </div>
                        <div class="foot-lnk">
                            <label for="tab-1"  style="color: #ffff;">Already Member?</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>