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
    <link rel="stylesheet" href="../../../css/notify/main.css">
</head>

<body class="ofNav">
    <?php
    include("../nav.php");
    include("../chats.php");
    ?>

    <div class="profile-abs" id="profileAbs">
        <div class="friends-card">
            <div class="friends-btns">
                <button class="tabButton activeTabButton " onclick="tabs('allFriends', event)" id="friendBtn">Pending (<?php
                                                                                                                        $query = mysqli_query($conn, "SELECT * FROM `notification` WHERE from_user = $sessId AND `type` = 1");
                                                                                                                        echo mysqli_num_rows($query);
                                                                                                                        ?>)</button>
            </div>
            <div class="friends-cnt">
                <div class="tabs" id="allFriends">
                    <div class="tabs-cnt">
                        <ul id="people-cards">
                            <?php
                            $pend = mysqli_query($conn, "SELECT * FROM `notification` WHERE from_user = $sessId AND `type` = 1");
                            if (mysqli_num_rows($pend) > 0) {
                                while ($pendFetch = mysqli_fetch_array($pend)) {

                                    $notiid = $pendFetch['id'];
                                    $to_user = $pendFetch['to_user'];
                                    $userGet = mysqli_query($conn, "SELECT * FROM user WHERE id = $to_user");
                                    $userFetch = mysqli_fetch_array($userGet);
                                    $fetchid = $userFetch['id'];
                                    $fetchUsername = $userFetch['username'];
                                    $fetchProfile = $userFetch['profileimg'];
                                    $fetchVerify = $userFetch['verified'];


                            ?>
                                    <li class="people-card">
                                        <a href="../profile/?user=<?php echo $fetchid ?>" class="people-card-in">
                                            <div class="people-card-in-names">
                                                <div class="friend-profile">
                                                    <?php if ($fetchProfile == '#') { ?>
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 16 16">
                                                            <path d="M8 2C6.347656 2 5 3.347656 5 5C5 6.652344 6.347656 8 8 8C9.652344 8 11 6.652344 11 5C11 3.347656 9.652344 2 8 2 Z M 8 8C5.246094 8 3 10.246094 3 13L4 13C4 10.785156 5.785156 9 8 9C10.214844 9 12 10.785156 12 13L13 13C13 10.246094 10.753906 8 8 8 Z M 8 3C9.109375 3 10 3.890625 10 5C10 6.109375 9.109375 7 8 7C6.890625 7 6 6.109375 6 5C6 3.890625 6.890625 3 8 3Z" />
                                                        </svg>
                                                    <?php } else { ?>
                                                        <img src="../../../assets/users/<?php echo $fetchProfile ?>" alt="<?php $fetchUsername ?>'s_profile_picture">
                                                    <?php } ?>
                                                </div>
                                                <span class="names">
                                                    <?php echo $fetchUsername ?>
                                                    <?php if($fetchVerify == '1'){?>
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24">
                                                            <path d="M21.228,12l0.622-1.92c0.465-1.437-0.182-3-1.527-3.687l-1.797-0.918l-0.918-1.797c-0.687-1.345-2.25-1.993-3.687-1.527 L12,2.772L10.08,2.15c-1.437-0.465-3,0.182-3.687,1.527L5.474,5.474L3.677,6.393C2.332,7.08,1.685,8.643,2.15,10.08L2.772,12 L2.15,13.92c-0.465,1.437,0.182,3,1.527,3.687l1.797,0.918l0.918,1.797c0.687,1.345,2.25,1.993,3.687,1.527L12,21.228l1.92,0.622 c1.437,0.465,3-0.182,3.687-1.527l0.918-1.797l1.797-0.918c1.345-0.687,1.993-2.25,1.527-3.687L21.228,12z M11,16.414l-3.707-3.707 l1.414-1.414L11,13.586l5.293-5.293l1.414,1.414L11,16.414z" />
                                                        </svg>
                                                    <?php } ?>
                                                </span>
                                            </div>
                                            <!-- <div class="people-card-in-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30">
                                                    <path d="M15 3C11.783059 3 8.8641982 4.2807926 6.7070312 6.3496094 A 1.0001 1.0001 0 0 0 6.3476562 6.7070312C4.2793766 8.8641071 3 11.783531 3 15C3 21.615572 8.3844276 27 15 27C18.210007 27 21.123475 25.724995 23.279297 23.664062 A 1.0001 1.0001 0 0 0 23.662109 23.28125C25.724168 21.125235 27 18.210998 27 15C27 8.3844276 21.615572 3 15 3 z M 15 5C20.534692 5 25 9.4653079 25 15C25 17.40637 24.155173 19.609062 22.746094 21.332031L8.6679688 7.2539062C10.390938 5.8448274 12.59363 5 15 5 z M 7.2539062 8.6679688L21.332031 22.746094C19.609062 24.155173 17.40637 25 15 25C9.4653079 25 5 20.534692 5 15C5 12.59363 5.8448274 10.390938 7.2539062 8.6679688 z" />
                                                </svg>
                                            </div> -->
                                        </a>
                                    </li>
                                <?php }
                            } else { ?>
                                <p class="demos">You Have 0 Pending Requests</p>
                            <?php } ?>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="close-friends" onclick="closeTools('profileAbs','showProfileAbs')">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30">
                    <path d="M7.9785156 5.9804688 A 2.0002 2.0002 0 0 0 6.5859375 9.4140625L12.171875 15L6.5859375 20.585938 A 2.0002 2.0002 0 1 0 9.4140625 23.414062L15 17.828125L20.585938 23.414062 A 2.0002 2.0002 0 1 0 23.414062 20.585938L17.828125 15L23.414062 9.4140625 A 2.0002 2.0002 0 0 0 21.960938 5.9804688 A 2.0002 2.0002 0 0 0 20.585938 6.5859375L15 12.171875L9.4140625 6.5859375 A 2.0002 2.0002 0 0 0 7.9785156 5.9804688 z" />
                </svg>
            </div>
        </div>
    </div>
    <div class="notify-ui">
        <div class="noti-top">
            <h1>Feed</h1>
        </div>
        <div class="noti-bottom">

            <?php
            $notiSql = mysqli_query($conn, "SELECT * FROM `notification` WHERE to_user = $sessId ORDER BY id DESC");
            if (mysqli_num_rows($notiSql) <= 0) {
            ?>
                <p class="demo">Nothing To Show Here</p>
            <?php } ?>

            <ul>
                <div class="noti-btns">
                    <a href="">All</a>
                    <a href="">
                        Requests
                        <div class="countNum">
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM `notification` WHERE to_user = $sessId AND `type` = 1");
                            echo mysqli_num_rows($query);
                            ?>
                        </div>
                    </a>
                    <!-- <a href="">Approved</a> -->
                    <div class="noti-btn-d" onclick="showTools('profileAbs','showProfileAbs')">
                        Pending
                        <div class="countNum">
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM `notification` WHERE from_user = $sessId AND `type` = 1");
                            echo mysqli_num_rows($query);
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                while ($notiFetch = mysqli_fetch_array($notiSql)) {
                    $from = $notiFetch['from_user'];
                    $to = $notiFetch['to_user'];
                    $type = $notiFetch['type'];
                    $id = $notiFetch['id'];
                    $user = mysqli_query($conn, "SELECT * FROM user WHERE id = $from");
                    $fetchUser = mysqli_fetch_array($user);
                    $username = $fetchUser['username'];
                    $names = $fetchUser['names'];
                    $profile = $fetchUser['profileimg'];
                    $verify = $fetchUser['verified'];
                    $user2 = mysqli_query($conn, "SELECT * FROM user WHERE id = $to");
                    $fetchUser2 = mysqli_fetch_array($user);
                    $username2 = $fetchUser['username'];
                    $names2 = $fetchUser['names'];
                    $profile2 = $fetchUser['profileimg'];
                    $verify2 = $fetchUser['verified'];

                    $friend = mysqli_query($conn, "SELECT * FROM friends WHERE user1 = $from OR user2 = $from");
                    if ($type == '1') { ?>
                        <li class="request">
                            <div class="noti-li-first">
                                <div class="noti-info">
                                    <div class="noti-li-img">
                                        <?php
                                        if ($profile == '#') {
                                        ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 16 16">
                                                <path d="M8 2C6.347656 2 5 3.347656 5 5C5 6.652344 6.347656 8 8 8C9.652344 8 11 6.652344 11 5C11 3.347656 9.652344 2 8 2 Z M 8 8C5.246094 8 3 10.246094 3 13L4 13C4 10.785156 5.785156 9 8 9C10.214844 9 12 10.785156 12 13L13 13C13 10.246094 10.753906 8 8 8 Z M 8 3C9.109375 3 10 3.890625 10 5C10 6.109375 9.109375 7 8 7C6.890625 7 6 6.109375 6 5C6 3.890625 6.890625 3 8 3Z" />
                                            </svg>
                                        <?php } else { ?>
                                            <img src="../../../assets/users/<?php echo $profile ?>" alt="<?php echo $names ?>'s Profile">
                                        <?php } ?>
                                    </div>
                                    <div class="noti-li-cnts">
                                        <a href='../profile/?user=<?php echo $from ?>' class="noti-names">
                                            <?php echo $names ?>
                                            <?php if($verify == '1'){?>
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24">
                                                <path d="M21.228,12l0.622-1.92c0.465-1.437-0.182-3-1.527-3.687l-1.797-0.918l-0.918-1.797c-0.687-1.345-2.25-1.993-3.687-1.527 L12,2.772L10.08,2.15c-1.437-0.465-3,0.182-3.687,1.527L5.474,5.474L3.677,6.393C2.332,7.08,1.685,8.643,2.15,10.08L2.772,12 L2.15,13.92c-0.465,1.437,0.182,3,1.527,3.687l1.797,0.918l0.918,1.797c0.687,1.345,2.25,1.993,3.687,1.527L12,21.228l1.92,0.622 c1.437,0.465,3-0.182,3.687-1.527l0.918-1.797l1.797-0.918c1.345-0.687,1.993-2.25,1.527-3.687L21.228,12z M11,16.414l-3.707-3.707 l1.414-1.414L11,13.586l5.293-5.293l1.414,1.414L11,16.414z" />
                                            </svg>
                                            <?php } ?>
                                        </a>
                                        <p>@<?php echo $username ?></p>
                                    </div>
                                </div>
                                <div class="noti-li-scnd">
                                    <?php echo mysqli_num_rows($friend)?> Friends 
                                </div>
                            </div>
                            <div class="noti-li-options">
                                <a href="../../../handles/?accept=<?php echo $id ?>">
                                    Accept
                                </a>
                                <a href="../../../handles/?del=<?php echo $id ?>">
                                    Reject
                                </a>
                            </div>
                        </li>
                    <?php } else if ($type == '2') { ?>
                        <li class="acceptance">
                            <div class="acceptance-dt">
                                <div class="acceptance-img">
                                    <?php 
                                        if($profile2 == '#'){
                                    ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 16 16">
                                        <path d="M8 2C6.347656 2 5 3.347656 5 5C5 6.652344 6.347656 8 8 8C9.652344 8 11 6.652344 11 5C11 3.347656 9.652344 2 8 2 Z M 8 8C5.246094 8 3 10.246094 3 13L4 13C4 10.785156 5.785156 9 8 9C10.214844 9 12 10.785156 12 13L13 13C13 10.246094 10.753906 8 8 8 Z M 8 3C9.109375 3 10 3.890625 10 5C10 6.109375 9.109375 7 8 7C6.890625 7 6 6.109375 6 5C6 3.890625 6.890625 3 8 3Z" />
                                    </svg>
                                    <?php }else{?>
                                    <img src="../../../assets/users/<?php echo $profile2 ?>" alt="<?php echo $profile2?>'s_profile_picture">
                                    <?php } ?>
                                </div>
                                <div class="acceptance-info">
                                    <a href="../profile/?user=<?php echo $from ?>">
                                        <?php echo $names ?> [<span>@<?php echo $username2 ?></span>]
                                        <?php if ($verify2 == '1'){?>
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24">
                                                <path d="M21.228,12l0.622-1.92c0.465-1.437-0.182-3-1.527-3.687l-1.797-0.918l-0.918-1.797c-0.687-1.345-2.25-1.993-3.687-1.527 L12,2.772L10.08,2.15c-1.437-0.465-3,0.182-3.687,1.527L5.474,5.474L3.677,6.393C2.332,7.08,1.685,8.643,2.15,10.08L2.772,12 L2.15,13.92c-0.465,1.437,0.182,3,1.527,3.687l1.797,0.918l0.918,1.797c0.687,1.345,2.25,1.993,3.687,1.527L12,21.228l1.92,0.622 c1.437,0.465,3-0.182,3.687-1.527l0.918-1.797l1.797-0.918c1.345-0.687,1.993-2.25,1.527-3.687L21.228,12z M11,16.414l-3.707-3.707 l1.414-1.414L11,13.586l5.293-5.293l1.414,1.414L11,16.414z" />
                                            </svg>
                                        <?php } ?>
                                    </a>
                                    Have Accepted Your Friend Request
                                </div>
                            </div>
                            <a href="../../../handles/?del=<?php echo $id ?>" class="noti-del">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48">
                                    <path d="M24 4C20.704135 4 18 6.7041348 18 10L11.746094 10 A 1.50015 1.50015 0 0 0 11.476562 9.9785156 A 1.50015 1.50015 0 0 0 11.259766 10L7.5 10 A 1.50015 1.50015 0 1 0 7.5 13L10 13L10 38.5C10 41.519774 12.480226 44 15.5 44L32.5 44C35.519774 44 38 41.519774 38 38.5L38 13L40.5 13 A 1.50015 1.50015 0 1 0 40.5 10L36.746094 10 A 1.50015 1.50015 0 0 0 36.259766 10L30 10C30 6.7041348 27.295865 4 24 4 z M 24 7C25.674135 7 27 8.3258652 27 10L21 10C21 8.3258652 22.325865 7 24 7 z M 13 13L35 13L35 38.5C35 39.898226 33.898226 41 32.5 41L15.5 41C14.101774 41 13 39.898226 13 38.5L13 13 z M 20.476562 17.978516 A 1.50015 1.50015 0 0 0 19 19.5L19 34.5 A 1.50015 1.50015 0 1 0 22 34.5L22 19.5 A 1.50015 1.50015 0 0 0 20.476562 17.978516 z M 27.476562 17.978516 A 1.50015 1.50015 0 0 0 26 19.5L26 34.5 A 1.50015 1.50015 0 1 0 29 34.5L29 19.5 A 1.50015 1.50015 0 0 0 27.476562 17.978516 z" />
                                </svg>
                            </a>
                        </li>
                <?php }
                }
                ?>


                <!-- <li class="pending">
                    <div class="noti-li-first">
                        <div class="noti-info">
                            <div class="noti-li-img">
                                <img src="../../../assets/avatar-1.jpg" alt="">
                            </div>
                            <div class="noti-li-cnts">
                                <a href="" class="noti-names">
                                    John Doe
                                </a>
                                <p>@admin</p>
                            </div>
                        </div>
                        <div class="noti-li-scnd">
                            107 Friends (4 Mutuals)
                        </div>
                    </div>
                    <div class="noti-li-options">
                        <a href="">
                            Discard
                        </a>
                    </div>
                </li>  -->
            </ul>
        </div>
    </div>
    <script src="../../../js/app.js"></script>
    <script src="../../../js/theme.js"></script>
    <script src="../../../js/show.js"></script>
</body>

</html>