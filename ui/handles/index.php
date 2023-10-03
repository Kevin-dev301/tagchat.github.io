
<?php 
    session_start();
    include ("../../admins/chatdb.php");
    if(isset($_POST['register'])){
        $names = $_POST['names'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $username = $_POST['username'];
        $pw = $_POST['password'];
        $profileimg = '#';
        $coverimg = '#';
        $descr = '#';
        $fb = '#';
        $ig = '#';
        $tl = '#';
        $yt = '#';
        $linkedin = '#';
        $web = '#';
        $active = '1';
        $active_availability = '1';
        $last_time = time();
        $join =  date('M, Y');
        $verify = '0';
        $location = '#';
        
        $emailCheck = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
        if(mysqli_num_rows($emailCheck) > 0){
            echo "  <script>
                        alert('Email Is Already In Use');
                        window.location.href = '../app/auth/auth-reg.php';
                    </script>";
        }else{
            $userCheck = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
            if(mysqli_num_rows($userCheck) > 0){
                echo "  <script>
                            alert('Username Is Already Taken');
                            window.location.href = '../app/auth/auth-reg.php';
                        </script>";
            }else {
                $sql = mysqli_query($conn, "INSERT INTO user VALUES (NULL, '$names', '$username', '$email','$dob','$gender','$pw', '$profileimg', '$coverimg', '$descr', '$fb', '$ig', '$tl', '$yt', '$linkedin', '$web', '$active', '$active_availability', '$location','$last_time', '$join', '$verify')");
                echo "  <script>
                            alert('Thanks For Creating Account With Us');
                            window.location.href = '../../';
                        </script>";
            }
        }
    }

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $pw = $_POST['password'];
        
        $sql = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND `password` = '$pw'");
        if(mysqli_num_rows($sql) > 0){
            echo "  <script>
                        alert('Login Successful');
                        window.location.href = '../app/chat/dashboard/';
                    </script>";
            if (isset($_POST['remember'])) {
                $remember = $_POST['remember'];
                setcookie("rememberUsername",$username, time() + 3600 * 30,'/');
                setcookie("rememberpassword",$pw, time()+3600*30,'/');
                setcookie("remembercheck",$remember, time()+3600*30,'/');
            }else{
                setcookie("rememberUsername",$username, time() - 3600,'/');
                setcookie("rememberpassword",$pw, time() -3600,'/');
                setcookie("remembercheck",'', time()+3600*30,'/');
            }
            $user = mysqli_fetch_array($sql);

            $_SESSION["loginChat"] = '1';
            $_SESSION['chatId'] = $user['id'];
            $userid = $_SESSION['chatId'];
            $_SESSION['chatUsername'] = $user['username'];
            $time = time();
            $sql = mysqli_query($conn, "UPDATE user SET active='1',last_seen_time = $time WHERE id = $userid");
            // $_SESSION['chatName'] = $user['names'];
            // $_SESSION['chatEmail'] = $user['email'];
            // $_SESSION['chatPw'] = $user['password'];
            // $_SESSION['chatDob'] = $user['birthdate'];
            // $_SESSION['chatGender'] = $user['gender'];
            // $_SESSION['chatProfile'] = $user['profileimg'];
            // $_SESSION['chatCover'] = $user['coverimg'];
            // $_SESSION['chatDescr'] = $user['description'];
            // $_SESSION['chatFb'] = $user['fb'];
            // $_SESSION['chatIg'] = $user['ig'];
            // $_SESSION['chatTl'] = $user['tl'];
            // $_SESSION['chatYt'] = $user['yt'];
            // $_SESSION['chatLinkedin'] = $user['linkedin'];
            // $_SESSION['chatWeb'] = $user['web'];
            // $_SESSION['chatActive'] = $user['active'];
            $_SESSION['chatAvailability'] = $user['active_availability'];
            // $_SESSION['chatLastSeen'] = $user['last_seen_time'];
            $_SESSION['chatJoined'] = $user['joined'];
            // $_SESSION['chatVerified'] = $user['verified'];
        }else{
            
            echo "  <script>
                        alert('Login Failed');
                        window.location.href = '../../';
                    </script>";
            die("".mysqli_error($conn));
        }

        
    }

    if(isset($_SESSION['chatId'])){
        $sessID = $_SESSION['chatId'];
    }

    if(isset($_GET['logout'])){
        $time = time();
        $sql = mysqli_query($conn, "UPDATE user SET active = 0,last_seen_time = $time WHERE id = $sessID");
        session_destroy();
        echo "  <script>
                    window.location.href = '../../';
                </script>";
    }

    if(isset($_POST['updateAcc'])){
        $names = $_POST['upName'];
        $username = $_POST['upUserName'];
        $descr = $_POST['upDescr'];
        $loc = $_POST['location'];

        if($descr == ''){
            $descr = '#';
        }

        if($loc == ''){
            $loc = '#';
        }
        

        if(($username != $_SESSION['chatUsername']) ){
        
            $userCheck = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

            if(mysqli_num_rows($userCheck) > 0){
                echo "  <script>
                            alert('Username Is Already Taken');
                            window.location.href = '../app/chat/settings/';
                        </script>";
            }else{
                $sql = mysqli_query($conn, "UPDATE user SET names = '$names', username = '$username', `description` = '$descr',`location` = '$loc' WHERE id = $sessID");

                $_SESSION['chatUsername'] = $username;
                $_SESSION['chatName'] = $names;
                $_SESSION['chatDescr'] = $descr;
                echo "  <script>
                            alert('Updated Successfully');
                            window.location.href = '../app/chat/settings/';
                        </script>";
            }
        }else{
                $sql = mysqli_query($conn, "UPDATE user SET names = '$names', username = '$username', `description` = '$descr',`location` = '$loc' WHERE id = $sessID");

                $_SESSION['chatUsername'] = $username;
                $_SESSION['chatName'] = $names;
                $_SESSION['chatDescr'] = $descr;
                echo "  <script>
                            alert('Updated Successfully');
                            window.location.href = '../app/chat/settings/';
                        </script>";
        }

    }

    if(isset($_POST['upProfile'])){
        $img = $_FILES['upProfImg']['name'];
        if(empty($img)){
            $img = '#';
        }else{
            $tmp_img = $_FILES['upProfImg']['tmp_name'];
            $path = '../assets/users/'.$img;
            $move = move_uploaded_file($tmp_img,$path);
        }
        
        $_SESSION['chatProfile'] = $img;
        $sql = mysqli_query($conn, "UPDATE user SET profileimg = '$img' WHERE id = $sessID");
        echo "  <script>
                        window.location.href = '../app/chat/settings/';
                    </script>";
    }

    if(isset($_POST['upCover'])){
        $img = $_FILES['updCoverImg']['name'];
        if(empty($img)){
            $img = '#';
        }else{
            $tmp_img = $_FILES['updCoverImg']['tmp_name'];
            $path = '../assets/users/'.$img;
            $move = move_uploaded_file($tmp_img,$path);
        }
        
        $_SESSION['chatCover'] = $img;
        $sql = mysqli_query($conn, "UPDATE user SET coverimg = '$img' WHERE id = $sessID");
        echo "  <script>
                        window.location.href = '../app/chat/settings/';
                    </script>";
    }

    if(isset($_POST['upPw'])){
        $currentPW = $_POST['currentPw'];
        $newPW = $_POST['newPw'];
        $repNewPw = $_POST['repNewPw'];
        if($currentPW == $_SESSION['chatPw']){
            if($newPW == $repNewPw){
                $sql = mysqli_query($conn, "UPDATE user SET `password` = $newPW WHERE id = $sessID");
                if($sql){
                echo "  <script>
                            alert('Password Updated Successfully');
                            window.location.href = '../app/chat/settings/';
                        </script>";
                }
            }else{
                echo "  <script>
                            alert('Repeat Password Value And New Password Value Should be Same');
                            window.location.href = '../app/chat/settings/';
                        </script>";
                }
        }else{
                echo "  <script>
                            alert('The Current Password Your Entered Is Incorrect');
                            window.location.href = '../app/chat/settings/';
                        </script>";
        }
    }

    if(isset($_POST['upSocials'])){
        $fb = $_POST['upFb'];
        $ig = $_POST['upIg'];
        $tl = $_POST['upTl'];
        $ln = $_POST['upLn'];
        $yt = $_POST['upYt'];
        $web = $_POST['upWeb'];

        if($fb == ''){
            $fb = '#';
        }
        if($ig == ''){
            $ig = '#';
        }
        if($tl == ''){
            $tl = '#';
        }
        if($ln == ''){
            $ln = '#';
        }
        if($yt == ''){
            $yt = '#';
        }
        if($web == ''){
            $web = '#';
        }
        $sql = mysqli_query($conn, "UPDATE user SET fb = '$fb', ig = '$ig', tl = '$tl',yt = '$yt', linkedin = '$ln', web = '$web' WHERE id = $sessID");
        if($sql){
            $_SESSION['chatIg'] = $ig;
            $_SESSION['chatFb'] = $fb;
            $_SESSION['chatTl'] = $tl;
            $_SESSION['chatWeb'] = $web;
            echo "  <script>
                        alert('Socials Updated Successfully');
                        window.location.href = '../app/chat/settings/';
                    </script>";
            }
    }

    if(isset($_POST['upVisibility'])){
        $visibility = $_POST['visibility'];
        $sql = mysqli_query($conn, "UPDATE user SET active_availability = $visibility WHERE id = $sessID");
        echo "  <script>
                        alert('Visibility Updated Successfully');
                        window.location.href = '../app/chat/settings/';
                    </script>";
    }

    if(isset($_GET['add'])){
        $to = $_GET['add'];
        $user = mysqli_query($conn, "SELECT * FROM user WHERE id = $to");
        $fetchUser = mysqli_fetch_array($user);
        $username = $fetchUser['username'];
        $from = $sessID;
        $type = 1;
        $query = mysqli_query($conn, "INSERT INTO `notification` VALUES(NULL, '$from', '$to', $type)");
        if($query){
            echo "  <script>
                        alert('Friend Request Sent Successfully To @".$username."');
                        window.location.href = '../app/chat/profile/?user=".$to."';
                    </script>";
        }
    }

    if(isset($_GET['accept'])){
        $noti = $_GET['accept'];
        $notisql = mysqli_query($conn, "SELECT * FROM `notification` WHERE id = $noti");
        $notiFetch= mysqli_fetch_array($notisql);
        $from = $notiFetch['from_user'];
        $to = $notiFetch['to_user'];
        $type = 2;
        $sql = mysqli_query($conn, "DELETE FROM `notification` WHERE id = $noti");
        $query = mysqli_query($conn, "INSERT INTO `notification` VALUES(NULL, '$to', '$from', '$type')");
        $friendQuery = mysqli_query($conn, "INSERT INTO friends VALUES(NULL, '$to','$from')");
        if($query && $sql && $friendQuery){
            echo "  <script>
                        alert('Friend Request Accepted');
                        window.location.href = '../app/chat/notify/';
                    </script>";
        }
    }

    if(isset($_GET['del'])){
        $notid = $_GET['del'];
        $sql = mysqli_query($conn, "DELETE FROM `notification` WHERE id = $notid");
        if($sql){
            echo "  <script>
                        alert('Notification Deleted Successfully');
                        window.location.href = '../app/chat/notify/';
                    </script>";
        }
    }

    if(isset($_GET['delfriend'])){
        $notid = $_GET['delfriend'];
        $sql = mysqli_query($conn, "DELETE FROM `friends` WHERE (user1 = $sessID AND user2 = $notid) OR (user1 = $notid AND user2 = $sessID)");
        $checkDM = mysqli_query($conn, "SELECT * FROM dms WHERE user1 = $sessId AND user2 = $chatid OR user1 = $chatid AND user2 = $sessId");
        if($sql){
            if(mysqli_num_rows($checkDM) > 0){
                $sqll = mysqli_query($conn, "DELETE from dms WHERE user1 = $sessId AND user2 = $chatid OR user1 = $chatid AND user2 = $sessId");
                echo "  <script>
                        alert('Removed Successfully');
                        window.location.href = '../app/chat/profile?user=$notid';
                    </script>";
            }else{
                echo "  <script>
                        alert('Removed Successfully');
                        window.location.href = '../app/chat/profile?user=$notid';
                    </script>";
            }
            
        }
    }

    
?>