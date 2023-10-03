<?php include "./admins/chatdb.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login || Tag Chat</title>
    <link rel="stylesheet" href="./ui/css/basic/main.css">
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
                    <h3>Welcome To Tag chat !!!</h3>
                    <p>Sign Up To Continue To Tag Chat.</p>
                    <form action="./ui/handles/" method="POST">
                        <div class="form-crd">
                            <label>Names</label>
                            <input type="text" placeholder="Enter Username" name="name" required value="">
                        </div>
                        <div class="form-crd">
                            <label>
                                Username
                            </label>
                            <input type="code" name="user" placeholder="Enter Username" id="" required  value="">
                        </div>
                        <div class="form-crd">
                            <label>
                                Email
                            </label>
                            <input type="email" name="mail" placeholder="Enter EMail" id="" required  value="">
                        </div>
                        <div class="form-crd">
                            <label>
                                Birthday
                            </label>
                            <input type="date" name="BD" placeholder="Enter Birthday" id="" required  value="">
                        </div>
                        <div class="form-crd">
                            <label>
                                Gender
                            </label>
                            <input type="text" name="sex" placeholder="Enter Gender" id="" required  value="">
                        </div>
                        <div class="form-crd">
                            <label>
                                Password
                                <a href="./auth-forgot.php">Forgot Password?</a>
                            </label>
                            <input type="password" name="pswd" placeholder="Enter Password" id="" required  value="<?php if (isset($_COOKIE['rememberpassword'])){echo $_COOKIE['rememberpassword'];}?>">
                        </div>
                        <div class="check">
                            <input type="checkbox" name="remember" id="check" >
                            <label for="check">Remember Me</label>
                        </div>
                        <button type="submit" name="register">Register</button>
                    </form>
                    <p class="just-p">
                        Already Have an account? <a href="./index.php">Sign In</a>
                    </p>
                    <div class="copy">
                        &copy; <?php echo date('Y') ?> Lite. Crafted By Ineza.NET
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
            if(isset($_POST['register'])){
                $name=$_POST['name'];
                $usern =$_POST['user'];
                $email = $_POST['mail'];
                $password = $_POST['pswd'];
                $age = $_POST['BD'];
                $gender = $_POST['sex']; 
                
                $selectusername = mysqli_query($con,"SELECT * FROM user WHERE username = '$usern'");
                if(mysqli_num_rows($selectusername) > 0){
                    echo "<div id='upalert' class='absolute px-5 py-3 bg-red-400 rounded-md top-5 right-10 animate-bounce'><h3 class='text-sm text-white'>Username in use...</h3></div>";   
                } else{
                    $insert = mysqli_query($con, "INSERT INTO user VALUES(NULL,'$name','$usern','$email','$age','$gender','$password',)");
                    if($insert){
                        echo "<div id='upalert' class='absolute px-5 py-3 bg-green-400 rounded-md top-5 right-10 animate-bounce'><h3 class='text-sm text-white'>Signed Up Successfully</h3></div>";
                        echo "<meta http-equiv='refresh' content='3'>";
                    } else{
                        echo "<div id='upalert' class='absolute px-5 py-3 bg-red-400 rounded-md top-5 right-10 animate-bounce'><h3 class='text-sm text-white'>Failed Try Again!</h3></div>";   
                        echo "<meta http-equiv='refresh' content='3'>";
                    }
                }
            }
        ?>
</body>

</html>