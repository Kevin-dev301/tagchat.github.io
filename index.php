<?php 
    session_start();
    if(isset($_SESSION["loginChat"])){
        echo "<script>window.location.href = './ui/app/chat/dashboard/'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login || Tag Chat</title>
    <link rel="stylesheet" href="./ui/css/basic/main.css">
    <link rel="shortcut icon" href="./defcover.png" type="image/x-icon">
</head>

<body>
    <div class="main">
        <div class="main-cont container">
            <div class="main-cont-left">
                <div class="logo">
                    <div class="logo-main">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32">
                            <path d="M4 4L4 20L8 20L8 24L17.648438 24L24 29.080078L24 24L28 24L28 8L24 8L24 4L4 4 z M 6 6L22 6L22 8L8 8L8 9L8 18L6 18L6 6 z M 10 10L26 10L26 22L22 22L22 24.917969L18.351562 22L10 22L10 10 z M 15 13 A 1 1 0 0 0 15 15 A 1 1 0 0 0 15 13 z M 21 13 A 1 1 0 0 0 21 15 A 1 1 0 0 0 21 13 z M 15.607422 17.205078L14.392578 18.794922C14.392578 18.794922 15.914756 20 18 20C20.085244 20 21.607422 18.794922 21.607422 18.794922L20.392578 17.205078C20.392578 17.205078 19.296756 18 18 18C16.703244 18 15.607422 17.205078 15.607422 17.205078 z" />
                        </svg>
                        <h3>Tag Chat</h3>
                    </div>
                    <p>Best Basic Chat Services</p>
                </div>
                <div class="abs-img">
                    <img src="./ui/assets/auth-img.png" alt="Login" draggable="false">
                </div>
            </div>
            <div class="main-cont-right">
                <div class="main-cont-right-cnt">
                    <h3>Welcome Back!</h3>
                    <p>Sign In To Continue To Tag Chat.</p>
                    <form action="./ui/handles/" method="POST">
                        <div class="form-crd">
                            <label>Username</label>
                            <input type="text" placeholder="Enter Username" name="username" required value="<?php if (isset($_COOKIE['rememberUsername'])){echo $_COOKIE['rememberUsername'];}?>">
                        </div>
                        <div class="form-crd">
                            <label>
                                Password
                                <a href="./auth-forgot.php">Forgot Password?</a>
                            </label>
                            <input type="password" name="password" placeholder="Enter Password" id="" required  value="<?php if (isset($_COOKIE['rememberpassword'])){echo $_COOKIE['rememberpassword'];}?>">
                        </div>
                        <div class="check">
                            <input type="checkbox" name="remember" id="check" <?php if (isset($_COOKIE['remembercheck'])){echo "checked";}?>>
                            <label for="check">Remember Me</label>
                        </div>
                        <button type="submit" name="login">Log In</button>
                    </form>
                    <div class="checkouts">
                        <div class="checkouts-header">
                            <hr>
                            Checkout
                            <hr>
                        </div>
                        <div class="checkout-btns">
                            <a href="">User Guide</a>
                            <a href="">Terms & Conditions</a>
                        </div>
                    </div>
                    <p class="just-p">
                        Don't have an account? <a href="./ui/app/auth/auth-reg.php">Register</a>
                    </p>
                    <div class="copy">
                        &copy; <?php echo date('Y') ?> Lite. Crafted By Ineza.NET
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>