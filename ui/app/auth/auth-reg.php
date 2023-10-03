<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register || Tag Chat</title>
    <link rel="stylesheet" href="../../css/basic/main.css">
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
                    <img src="../../assets/auth-img.png" alt="Login" draggable="false">
                </div>
            </div>
            <div class="main-cont-right">
                <div class="main-cont-right-cnt">
                    <h3>Register Account</h3>
                    <p>Get your free Doot account now.</p>
                    <form action="../../handles/" method="POST">
                        <div class="form-crd">
                            <label>Names</label>
                            <input type="text" placeholder="Enter Names" name="names" required>
                        </div>
                        <div class="form-crd">
                            <label>Email</label>
                            <input type="email" placeholder="Enter Email" name="email" required>
                        </div>

                        <div class="form-crd">
                            <label>Age</label>
                            <input type="date"  max="<?php echo date('Y') - 18?>-12-31" name="dob" required>
                        </div>
                        <div class="form-crd form-crd-part">
                            <div>
                                <label>Gender</label>
                                <select name="gender" id="">
                                    <option selected hidden disabled>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div>
                                <label>Username</label>
                                <input type="text" name="username" pattern="[a-z0-9_]+" placeholder="Claim A Username" required>
                            </div>
                        </div>
                        <div class="form-crd">
                            <label>
                                Password
                            </label>
                            <input type="password" name="password" placeholder="Enter Password" id="" required>
                        </div>
                        <button type="submit" name="register">Register</button>
                    </form>
                    <p class="just-p">
                        Have an Account already? <a href="../../../index.php">Log In</a>
                    </p>
                    <div class="copy">
                        &copy; <?php echo date('Y') ?> Lite. Crafted By Ineza.net
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>