<?php
session_start();
include "../../../../admins/chatdb.php";
if (!(isset($_SESSION["loginChat"]))) {
    echo "<script>window.location.href = '../../../../'</script>";
} else {
    $sessId = $_SESSION['chatId'];
    $sql = mysqli_query($conn, "SELECT * FROM user WHERE id = $sessId");
    $fetchsql = mysqli_fetch_assoc($sql);
    $profimg = $fetchsql['profileimg'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tag Chat</title>
    <link rel="stylesheet" href="../../../css/search/main.css">
</head>

<body class="ofNav">
    <?php
    include("../nav.php");
    include("../chats.php");
    ?>
    <div class="friends-ui">
        <div class="friends-top">
            <h1>Search</h1>
            <input type="text" name="search" onkeyup="othersearch('friendSearch','people-cards')" id="friendSearch" placeholder="Search A User...">
        </div>
        <div class="friends-bottom">
            <ul id="people-cards" class="search-cards">
                <?php
                $sessID = $_SESSION['chatId'];
                $sql = mysqli_query($conn, "SELECT * FROM user WHERE id != $sessID");
                while ($userrow = mysqli_fetch_array($sql)) {
                    $userid = $userrow['id'];
                    $username = $userrow['username'];
                    $userprofile = $userrow['profileimg'];
                    $userverify = $userrow['verified'];
                ?>
                    <li>
                        <div class="people-card-dv">
                            <a href='../profile/?user=<?php echo $userid; ?>' class="people-card-in">
                                <div class="friend-profile <?php if ($userprofile == '#') {
                                                                echo "noPro";
                                                            } ?>">
                                    <?php if ($userprofile == '#') { ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 16 16">
                                            <path d="M8 2C6.347656 2 5 3.347656 5 5C5 6.652344 6.347656 8 8 8C9.652344 8 11 6.652344 11 5C11 3.347656 9.652344 2 8 2 Z M 8 8C5.246094 8 3 10.246094 3 13L4 13C4 10.785156 5.785156 9 8 9C10.214844 9 12 10.785156 12 13L13 13C13 10.246094 10.753906 8 8 8 Z M 8 3C9.109375 3 10 3.890625 10 5C10 6.109375 9.109375 7 8 7C6.890625 7 6 6.109375 6 5C6 3.890625 6.890625 3 8 3Z" />
                                        </svg>
                                    <?php } else { ?>
                                        <img src="../../../assets/users/<?php echo $userprofile; ?>" alt="">
                                    <?php } ?>
                                </div>
                                <div class="user">
                                    <span class="names"><?php echo $username ?></span>
                                    <?php 
                                        if($userverify == '1'){
                                    ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24">
                                        <path d="M21.228,12l0.622-1.92c0.465-1.437-0.182-3-1.527-3.687l-1.797-0.918l-0.918-1.797c-0.687-1.345-2.25-1.993-3.687-1.527 L12,2.772L10.08,2.15c-1.437-0.465-3,0.182-3.687,1.527L5.474,5.474L3.677,6.393C2.332,7.08,1.685,8.643,2.15,10.08L2.772,12 L2.15,13.92c-0.465,1.437,0.182,3,1.527,3.687l1.797,0.918l0.918,1.797c0.687,1.345,2.25,1.993,3.687,1.527L12,21.228l1.92,0.622 c1.437,0.465,3-0.182,3.687-1.527l0.918-1.797l1.797-0.918c1.345-0.687,1.993-2.25,1.527-3.687L21.228,12z M11,16.414l-3.707-3.707 l1.414-1.414L11,13.586l5.293-5.293l1.414,1.414L11,16.414z" />
                                    </svg>
                                    <?php } ?>
                                </div>
                            </a>
                        </div>
                    </li>
                <?php } ?>
                <p id="demo" class="demo">Search For A User...</p>
        </div>
    </div>
    <script src="../../../js/app.js"></script>
    <script src="../../../js/theme.js"></script>
    <script>
        function othersearch(input, uls) {
            var value = document.getElementById(input).value.toUpperCase();
            var list = document.getElementById(uls);
            var listcard = list.getElementsByTagName("li");
            for (var i = 0; i < listcard.length; i++) {
                var listcardIn = listcard[i].querySelector(".people-card-in");
                var a = listcard[i].querySelector(".names").innerHTML.toUpperCase();
                if (a.indexOf(value) > -1) {
                    listcardIn.style.display = 'flex';
                    listcard[i].style.display = 'block';
                    document.getElementById("demo").style.display = 'none';
                } else {
                    listcard[i].style.display = 'none';
                    document.getElementById("demo").style.display = 'none';
                }
                if (value == '') {
                    listcard[i].style.display = 'none';
                    document.getElementById("demo").style.display = 'block';
                }
            }
        }
    </script>
</body>

</html>