<?php
session_start();
include "../../../../admins/chatdb.php";
if (!(isset($_SESSION["loginChat"]))) {
    echo "<script>window.location.href = '../../../../'</script>";
} else {
    $sessId = $_SESSION['chatId'];
    $sessAvailable = $_SESSION['chatAvailability'];
    $sql = mysqli_query($conn, "SELECT * FROM user WHERE id = $sessId");
    $fetchsql = mysqli_fetch_assoc($sql);
    $profimg = $fetchsql['profileimg'];
    $available = $fetchsql['active_availability'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tag Chat</title>
    <link rel="stylesheet" href="../../../css/dashboard/main.css">
</head>

<body>
    <?php
    if (isset($_GET['c'])) {
        $chatid = $_GET['c'];
        $checkfriend = mysqli_query($conn, "SELECT * FROM friends WHERE (user1 = $sessId AND user2 = $chatid) OR (user1 = $chatid AND user2 = $sessId)");
        $rowfriend = mysqli_num_rows($checkfriend);
        $getmessage = mysqli_query($conn, "SELECT * FROM messages WHERE (from_user = $sessId AND to_user = $chatid) OR (from_user = $chatid AND to_user = $sessId)");
        $rowMessage = mysqli_num_rows($getmessage);

        $getChatUser = mysqli_query($conn, "SELECT * FROM user WHERE id = $chatid");
        if ($rowMessage > 0) {
            $sql = mysqli_query($conn, "UPDATE messages SET seen = 1 WHERE from_user = $chatid AND to_user = $sessId");
        }
        
        if (mysqli_num_rows($checkfriend) > 0) {
            $fetchFriend = mysqli_fetch_array($checkfriend);
            $user1 = $fetchFriend['user1'];
            $user2 = $fetchFriend['user2'];
            if ($user1 == $sessId) {
                $user = $user2;
            }
            if ($user2 == $sessId) {
                $user = $user1;
            }


            $getfriend = mysqli_query($conn, "SELECT * FROM user WHERE id = $user");
            $fetchFF = mysqli_fetch_array($getfriend);
            $friendU = $fetchFF['username'];
            $friendN = $fetchFF['names'];
            $friendP = $fetchFF['profileimg'];
            $friendActive = $fetchFF['active'];
            $friendVisible = $fetchFF['active_availability'];
            $friendVerify = $fetchFF['verified'];
            $friendSeen = $fetchFF['last_seen_time'];
            $getmessage = mysqli_query($conn, "SELECT * FROM messages WHERE (from_user = $sessId AND to_user = $chatid) OR (from_user = $chatid AND to_user = $sessId)");
            $rowMessage = mysqli_num_rows($getmessage);

            $getChatUser = mysqli_query($conn, "SELECT * FROM user WHERE id = $chatid");
            if ($rowMessage > 0) {
                $sql = mysqli_query($conn, "UPDATE messages SET seen = 1 WHERE from_user = $chatid AND to_user = $sessId");
            }



            //Function to Calc Last Seen Time

            function last_seen($time)
            {
                $difference = time() - $time;

                $seconds = $difference;

                $minutes = round($difference / 60);

                $hours = round($difference / 3600);

                $days = round($difference / 86400);

                $weeks = round($difference / 604800);

                //Difference In Months Is Dif_In_Weeks * 4.3

                $months = round($difference / 2600640);

                $years = round($difference / 31207680);

                if ($seconds <= 60) {
                    echo "Last Seen $seconds Seconds Ago";
                } else if ($minutes <= 60) {
                    if ($minutes == 1) {
                        echo "Last Seen 1 Minute Ago";
                    } else {
                        echo "Last Seen $minutes Minutes Ago";
                    }
                } else if ($hours <= 24) {
                    if ($hours == 1) {
                        echo "Last Seen 1 Hour Ago";
                    } else {
                        echo "Last Seen $hours Hours Ago";
                    }
                } else if ($days <= 7) {
                    if ($days == 1) {
                        echo "Last Seen 1 Day Ago";
                    } else {
                        echo "Last Seen $days Days Ago";
                    }
                } else if ($months <= 12) {
                    if ($months == 1) {
                        echo "Last Seen 1 Month Ago";
                    } else {
                        echo "Last Seen $months Months Ago";
                    }
                } else {
                    if ($years == 1) {
                        echo "Last Seen 1 Year Ago";
                    } else {
                        echo "Last Seen $years Years Ago";
                    }
                }
            }
        }
    }
    include("../nav.php");
    include("../chats.php");
    ?>
    <div class="tools-send" id="audio">
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="audioFile" accept="audio/*" id="audioInput" required>
            <label for="audioInput" class="tools-send-main">
                <div class="tools-send-img">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24">
                        <path d="M12,2c-4.962,0-9,4.038-9,9v8c0,1.105,0.895,2,2,2h3v-7H5v-3c0-3.86,3.14-7,7-7s7,3.14,7,7v3h-3v7h3c1.105,0,2-0.895,2-2v-8 C21,6.038,16.962,2,12,2z" />
                    </svg>
                </div>
                <h2>Click To Choose Audio</h2>
            </label>
            <div class="tool-send-btns">
                <p id="toolSendClose" onclick="closeTools('audio','showToolSend')">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30">
                        <path d="M7.9785156 5.9804688 A 2.0002 2.0002 0 0 0 6.5859375 9.4140625L12.171875 15L6.5859375 20.585938 A 2.0002 2.0002 0 1 0 9.4140625 23.414062L15 17.828125L20.585938 23.414062 A 2.0002 2.0002 0 1 0 23.414062 20.585938L17.828125 15L23.414062 9.4140625 A 2.0002 2.0002 0 0 0 21.960938 5.9804688 A 2.0002 2.0002 0 0 0 20.585938 6.5859375L15 12.171875L9.4140625 6.5859375 A 2.0002 2.0002 0 0 0 7.9785156 5.9804688 z" />
                    </svg>
                </p>
                <button type="submit" name="sendAudio">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30">
                        <path d="M6 3 A 2 2 0 0 0 4 5L4 11 A 2 2 0 0 0 5.3398438 12.884766 A 2 2 0 0 0 6 13 A 2 2 0 0 0 6.0214844 13L18 15L6.0214844 17.001953 A 2 2 0 0 0 6 17 A 2 2 0 0 0 5.3378906 17.115234 A 2 2 0 0 0 4 19L4 25 A 2 2 0 0 0 6 27 A 2 2 0 0 0 6.9921875 26.734375L6.9941406 26.734375L27.390625 15.921875L27.392578 15.917969 A 1 1 0 0 0 28 15 A 1 1 0 0 0 27.390625 14.078125L6.9941406 3.265625 A 2 2 0 0 0 6 3 z" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
    <div class="tools-send" id="video">
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="videoFile" accept="video/*" id="videoInput" required>
            <label for="videoInput" class="tools-send-main">
                <div class="tools-send-img">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24">
                        <path d="M3 5C1.9069372 5 1 5.9069372 1 7L1 17C1 18.093063 1.9069372 19 3 19L16 19C17.093063 19 18 18.093063 18 17L18 14.080078L23 18.080078L23 5.9199219L18 9.9199219L18 7C18 5.9069372 17.093063 5 16 5L3 5 z M 3 7L16 7L16 17L3 17L3 7 z M 21 10.082031L21 13.917969L18.601562 12L21 10.082031 z" />
                    </svg>
                </div>
                <h2>Click To Choose Video</h2>
            </label>
            <div class="tool-send-btns">
                <p id="toolSendClose" onclick="closeTools('video','showToolSend')">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30">
                        <path d="M7.9785156 5.9804688 A 2.0002 2.0002 0 0 0 6.5859375 9.4140625L12.171875 15L6.5859375 20.585938 A 2.0002 2.0002 0 1 0 9.4140625 23.414062L15 17.828125L20.585938 23.414062 A 2.0002 2.0002 0 1 0 23.414062 20.585938L17.828125 15L23.414062 9.4140625 A 2.0002 2.0002 0 0 0 21.960938 5.9804688 A 2.0002 2.0002 0 0 0 20.585938 6.5859375L15 12.171875L9.4140625 6.5859375 A 2.0002 2.0002 0 0 0 7.9785156 5.9804688 z" />
                    </svg>
                </p>
                <button type="submit" name="sendVideo">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30">
                        <path d="M6 3 A 2 2 0 0 0 4 5L4 11 A 2 2 0 0 0 5.3398438 12.884766 A 2 2 0 0 0 6 13 A 2 2 0 0 0 6.0214844 13L18 15L6.0214844 17.001953 A 2 2 0 0 0 6 17 A 2 2 0 0 0 5.3378906 17.115234 A 2 2 0 0 0 4 19L4 25 A 2 2 0 0 0 6 27 A 2 2 0 0 0 6.9921875 26.734375L6.9941406 26.734375L27.390625 15.921875L27.392578 15.917969 A 1 1 0 0 0 28 15 A 1 1 0 0 0 27.390625 14.078125L6.9941406 3.265625 A 2 2 0 0 0 6 3 z" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
    <div class="tools-send" id="image">
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="imgFile" accept="image/*" id="imageInput" required>
            <label for="imageInput" class="tools-send-main">
                <div class="tools-send-img">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48">
                        <path d="M11.5 6C8.4802259 6 6 8.4802259 6 11.5L6 36.5C6 39.519774 8.4802259 42 11.5 42L36.5 42C39.519774 42 42 39.519774 42 36.5L42 11.5C42 8.4802259 39.519774 6 36.5 6L11.5 6 z M 11.5 9L36.5 9C37.898226 9 39 10.101774 39 11.5L39 31.955078L32.988281 26.138672 A 1.50015 1.50015 0 0 0 32.986328 26.136719C32.208234 25.385403 31.18685 25 30.173828 25C29.16122 25 28.13988 25.385387 27.361328 26.138672L25.3125 28.121094L19.132812 22.142578C18.35636 21.389748 17.336076 21 16.318359 21C15.299078 21 14.280986 21.392173 13.505859 22.140625 A 1.50015 1.50015 0 0 0 13.503906 22.142578L9 26.5L9 11.5C9 10.101774 10.101774 9 11.5 9 z M 30.5 13C29.125 13 27.903815 13.569633 27.128906 14.441406C26.353997 15.313179 26 16.416667 26 17.5C26 18.583333 26.353997 19.686821 27.128906 20.558594C27.903815 21.430367 29.125 22 30.5 22C31.875 22 33.096185 21.430367 33.871094 20.558594C34.646003 19.686821 35 18.583333 35 17.5C35 16.416667 34.646003 15.313179 33.871094 14.441406C33.096185 13.569633 31.875 13 30.5 13 z M 30.5 16C31.124999 16 31.403816 16.180367 31.628906 16.433594C31.853997 16.686821 32 17.083333 32 17.5C32 17.916667 31.853997 18.313179 31.628906 18.566406C31.403816 18.819633 31.124999 19 30.5 19C29.875001 19 29.596184 18.819633 29.371094 18.566406C29.146003 18.313179 29 17.916667 29 17.5C29 17.083333 29.146003 16.686821 29.371094 16.433594C29.596184 16.180367 29.875001 16 30.5 16 z M 16.318359 24C16.578643 24 16.835328 24.09366 17.044922 24.296875 A 1.50015 1.50015 0 0 0 17.046875 24.298828L23.154297 30.207031L14.064453 39L11.5 39C10.101774 39 9 37.898226 9 36.5L9 30.673828L15.589844 24.298828C15.802764 24.093234 16.059641 24 16.318359 24 z M 30.173828 28C30.438806 28 30.692485 28.09229 30.902344 28.294922L39 36.128906L39 36.5C39 37.898226 37.898226 39 36.5 39L18.380859 39L29.447266 28.294922C29.654714 28.094207 29.910436 28 30.173828 28 z" />
                    </svg>
                </div>
                <h2>Click To Choose Image</h2>
            </label>
            <div class="tool-send-btns">
                <p id="toolSendClose" onclick="closeTools('image','showToolSend')">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30">
                        <path d="M7.9785156 5.9804688 A 2.0002 2.0002 0 0 0 6.5859375 9.4140625L12.171875 15L6.5859375 20.585938 A 2.0002 2.0002 0 1 0 9.4140625 23.414062L15 17.828125L20.585938 23.414062 A 2.0002 2.0002 0 1 0 23.414062 20.585938L17.828125 15L23.414062 9.4140625 A 2.0002 2.0002 0 0 0 21.960938 5.9804688 A 2.0002 2.0002 0 0 0 20.585938 6.5859375L15 12.171875L9.4140625 6.5859375 A 2.0002 2.0002 0 0 0 7.9785156 5.9804688 z" />
                    </svg>
                </p>
                <button type="submit" name="sendImg">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30">
                        <path d="M6 3 A 2 2 0 0 0 4 5L4 11 A 2 2 0 0 0 5.3398438 12.884766 A 2 2 0 0 0 6 13 A 2 2 0 0 0 6.0214844 13L18 15L6.0214844 17.001953 A 2 2 0 0 0 6 17 A 2 2 0 0 0 5.3378906 17.115234 A 2 2 0 0 0 4 19L4 25 A 2 2 0 0 0 6 27 A 2 2 0 0 0 6.9921875 26.734375L6.9941406 26.734375L27.390625 15.921875L27.392578 15.917969 A 1 1 0 0 0 28 15 A 1 1 0 0 0 27.390625 14.078125L6.9941406 3.265625 A 2 2 0 0 0 6 3 z" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
    <div class="tools-send" id="link">
        <form method="POST">
            <label for="" class="tools-send-main">
                <div class="tools-send-img">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50">
                        <path d="M37 4.0039062C34.69525 4.0037812 32.389766 4.8822188 30.634766 6.6367188L25.634766 11.636719C23.142766 14.128719 22.430516 17.727281 23.478516 20.863281L27.070312 17.271484C27.220312 16.244484 27.673891 15.253844 28.462891 14.464844L33.462891 9.4648438C34.437891 8.4908438 35.72 8.0019531 37 8.0019531C38.28 8.0019531 39.561156 8.4898437 40.535156 9.4648438C42.484156 11.414844 42.484156 14.586156 40.535156 16.535156L35.535156 21.535156C34.746156 22.324156 33.756516 22.776734 32.728516 22.927734L29.134766 26.521484C30.062766 26.831484 31.029047 26.996094 31.998047 26.996094C34.303047 26.996094 36.608281 26.118281 38.363281 24.363281L43.363281 19.363281C46.873281 15.854281 46.872281 10.145719 43.363281 6.6367188C41.608281 4.8827187 39.30475 4.0040313 37 4.0039062 z M 30.960938 16.980469 A 2.0002 2.0002 0 0 0 29.585938 17.585938L17.585938 29.585938 A 2.0002 2.0002 0 1 0 20.414062 32.414062L32.414062 20.414062 A 2.0002 2.0002 0 0 0 30.960938 16.980469 z M 18.449219 23.023438C15.997141 22.898656 13.506469 23.765766 11.636719 25.634766L6.6367188 30.634766C3.1277188 34.143766 3.1277187 39.854281 6.6367188 43.363281C8.3917188 45.117281 10.696 45.994141 13 45.994141C15.304 45.994141 17.608281 45.116328 19.363281 43.361328L24.363281 38.361328C26.855281 35.869328 27.569484 32.270766 26.521484 29.134766L22.927734 32.728516C22.777734 33.755516 22.324156 34.746156 21.535156 35.535156L16.535156 40.535156C14.586156 42.485156 11.413844 42.485156 9.4648438 40.535156C7.5158438 38.585156 7.5158438 35.413844 9.4648438 33.464844L14.464844 28.464844C15.253844 27.675844 16.244484 27.221312 17.271484 27.070312L20.863281 23.478516C20.079281 23.216516 19.266578 23.065031 18.449219 23.023438 z" />
                    </svg>
                </div>
                <input type="url" name="linkMsg" id="urlInput" required placeholder="Enter A Link">
                <h2>Type In Link</h2>
            </label>
            <div class="tool-send-btns">
                <p id="toolSendClose" onclick="closeTools('link','showToolSend')">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30">
                        <path d="M7.9785156 5.9804688 A 2.0002 2.0002 0 0 0 6.5859375 9.4140625L12.171875 15L6.5859375 20.585938 A 2.0002 2.0002 0 1 0 9.4140625 23.414062L15 17.828125L20.585938 23.414062 A 2.0002 2.0002 0 1 0 23.414062 20.585938L17.828125 15L23.414062 9.4140625 A 2.0002 2.0002 0 0 0 21.960938 5.9804688 A 2.0002 2.0002 0 0 0 20.585938 6.5859375L15 12.171875L9.4140625 6.5859375 A 2.0002 2.0002 0 0 0 7.9785156 5.9804688 z" />
                    </svg>
                </p>
                <button type="submit" name="sendLink">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30">
                        <path d="M6 3 A 2 2 0 0 0 4 5L4 11 A 2 2 0 0 0 5.3398438 12.884766 A 2 2 0 0 0 6 13 A 2 2 0 0 0 6.0214844 13L18 15L6.0214844 17.001953 A 2 2 0 0 0 6 17 A 2 2 0 0 0 5.3378906 17.115234 A 2 2 0 0 0 4 19L4 25 A 2 2 0 0 0 6 27 A 2 2 0 0 0 6.9921875 26.734375L6.9941406 26.734375L27.390625 15.921875L27.392578 15.917969 A 1 1 0 0 0 28 15 A 1 1 0 0 0 27.390625 14.078125L6.9941406 3.265625 A 2 2 0 0 0 6 3 z" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
    <?php if ((!isset($_GET['c'])) || $rowfriend == 0 || $chatid == null) { ?>
        <div class="chat-ui no-chat-ui">
            <div class="no-chat-svg">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32">
                    <path d="M4 4L4 20L8 20L8 24L17.648438 24L24 29.080078L24 24L28 24L28 8L24 8L24 4L4 4 z M 6 6L22 6L22 8L8 8L8 9L8 18L6 18L6 6 z M 10 10L26 10L26 22L22 22L22 24.917969L18.351562 22L10 22L10 10 z M 15 13 A 1 1 0 0 0 15 15 A 1 1 0 0 0 15 13 z M 21 13 A 1 1 0 0 0 21 15 A 1 1 0 0 0 21 13 z M 15.607422 17.205078L14.392578 18.794922C14.392578 18.794922 15.914756 20 18 20C20.085244 20 21.607422 18.794922 21.607422 18.794922L20.392578 17.205078C20.392578 17.205078 19.296756 18 18 18C16.703244 18 15.607422 17.205078 15.607422 17.205078 z" />
                </svg>
            </div>
            <h1>Welcome To Tag-Chat App</h1>
            <p>Chat With Friends In Text🅰️, Emojis🤪, Videos📽️ And Much More...Just "Tag-Chat" Them</p>
        </div>
    <?php } else { ?>
        <div class="chat-ui <?php if (isset($_GET['c'])) {
                                echo "show-chat-ui";
                            } ?>">
            <div class="chat-ui-top">
                <div class="chat-ui-top-left">
                    <a href="./" class="chat-ui-top-left-backbutton">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50">
                            <path d="M32.136719 3.0625C31.875 3.0625 31.628906 3.167969 31.441406 3.351563L10.359375 24.265625C9.964844 24.65625 9.960938 25.289063 10.351563 25.679688L31.265625 46.765625C31.65625 47.15625 32.289063 47.160156 32.679688 46.769531L38.703125 40.796875C39.097656 40.40625 39.101563 39.773438 38.710938 39.378906L24.476563 25.03125L38.828125 10.796875C39.21875 10.40625 39.222656 9.773438 38.832031 9.382813L32.859375 3.359375C32.667969 3.164063 32.40625 3.058594 32.136719 3.0625Z" />
                        </svg>
                        <div class="backbtn-count">
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM messages WHERE to_user = $sessId AND seen = '0'");
                            echo mysqli_num_rows($query);
                            ?>
                        </div>
                    </a>
                    <a href="../profile/?user=<?php echo $user ?>" class="chat-ui-top-left-main">
                        <div class="people-img <?php if ($friendP == '#') {
                                                    echo 'no-profile';
                                                } ?>">
                            <?php
                            if ($friendP == '#') {
                            ?>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 16 16">
                                    <path d="M8 2C6.347656 2 5 3.347656 5 5C5 6.652344 6.347656 8 8 8C9.652344 8 11 6.652344 11 5C11 3.347656 9.652344 2 8 2 Z M 8 8C5.246094 8 3 10.246094 3 13L4 13C4 10.785156 5.785156 9 8 9C10.214844 9 12 10.785156 12 13L13 13C13 10.246094 10.753906 8 8 8 Z M 8 3C9.109375 3 10 3.890625 10 5C10 6.109375 9.109375 7 8 7C6.890625 7 6 6.109375 6 5C6 3.890625 6.890625 3 8 3Z" />
                                </svg>
                            <?php } else { ?>
                                <img src="../../../assets/users/<?php echo $friendP ?>" alt="<?php echo $friendP ?>'s_profile_picture">
                            <?php } ?>
                            <?php if (($available == '1') and ($friendVisible == '1') and ($friendActive == '1')) { ?>
                                <span></span>
                            <?php } ?>
                        </div>
                        <div class="chat-ui-top-left-info">
                            <h2>
                                <?php echo $friendU ?>
                                <?php if ($friendVerify == '1') { ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24">
                                        <path d="M21.228,12l0.622-1.92c0.465-1.437-0.182-3-1.527-3.687l-1.797-0.918l-0.918-1.797c-0.687-1.345-2.25-1.993-3.687-1.527 L12,2.772L10.08,2.15c-1.437-0.465-3,0.182-3.687,1.527L5.474,5.474L3.677,6.393C2.332,7.08,1.685,8.643,2.15,10.08L2.772,12 L2.15,13.92c-0.465,1.437,0.182,3,1.527,3.687l1.797,0.918l0.918,1.797c0.687,1.345,2.25,1.993,3.687,1.527L12,21.228l1.92,0.622 c1.437,0.465,3-0.182,3.687-1.527l0.918-1.797l1.797-0.918c1.345-0.687,1.993-2.25,1.527-3.687L21.228,12z M11,16.414l-3.707-3.707 l1.414-1.414L11,13.586l5.293-5.293l1.414,1.414L11,16.414z" />
                                    </svg>
                                <?php } ?>
                            </h2>
                            <?php if (($available == '1') and ($friendVisible == '1') and ($friendActive == '1')) { ?>
                                <p>Active</p>
                                <?php } else {
                                if (($available == '1') && ($friendVisible == '1') && ($friendActive == '0')) { ?>
                                    <p><?php last_seen($friendSeen) ?></p>
                            <?php }
                            } ?>

                        </div>
                    </a>
                </div>
                <!-- <div class="chat-ui-top-right">
                    <div class="menu-btn" id="menuBtn" onclick="menuOptionsOn()">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50">
                            <path d="M25 3C21.699219 3 19 5.699219 19 9C19 12.300781 21.699219 15 25 15C28.300781 15 31 12.300781 31 9C31 5.699219 28.300781 3 25 3 Z M 25 19C21.699219 19 19 21.699219 19 25C19 28.300781 21.699219 31 25 31C28.300781 31 31 28.300781 31 25C31 21.699219 28.300781 19 25 19 Z M 25 35C21.699219 35 19 37.699219 19 41C19 44.300781 21.699219 47 25 47C28.300781 47 31 44.300781 31 41C31 37.699219 28.300781 35 25 35Z" />
                        </svg>
                        <div class="menu-btn-abs" id="menuOptions">
                            <a href="">
                                Pin
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32">
                                    <path d="M20.53125 2.5625L19.84375 3.5L14.9375 10.1875C12.308594 9.730469 9.527344 10.472656 7.5 12.5L6.78125 13.1875L12.09375 18.5L4 26.59375L4 28L5.40625 28L13.5 19.90625L18.8125 25.21875L19.5 24.5C21.527344 22.472656 22.269531 19.691406 21.8125 17.0625L28.5 12.15625L29.4375 11.46875 Z M 20.78125 5.625L26.375 11.21875L20.15625 15.78125L19.59375 16.1875L19.78125 16.84375C20.261719 18.675781 19.738281 20.585938 18.59375 22.1875L9.8125 13.40625C11.414063 12.261719 13.324219 11.738281 15.15625 12.21875L15.8125 12.40625L16.21875 11.84375Z" />
                                </svg>
                            </a>
                            <a href="">
                                Unfriend
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z" />
                                </svg>
                            </a>
                            <a href="">
                                Archive
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48">
                                    <path d="M8.5 5 A 1.50015 1.50015 0 0 0 8.2050781 7.9707031C14.141318 9.1580428 16.771994 12.859175 18.121094 16.960938C19.259757 20.422894 19.26013 23.812407 19.144531 26L11.5 26 A 1.50015 1.50015 0 0 0 10.439453 28.560547L24.439453 42.560547 A 1.50015 1.50015 0 0 0 26.560547 42.560547L40.560547 28.560547 A 1.50015 1.50015 0 0 0 39.5 26L31.714844 26C31.418399 23.342281 30.656717 18.972916 27.808594 14.574219C24.57487 9.5799927 18.629736 5.1401785 8.8144531 5.0371094C8.8069831 5.0356094 8.8024039 5.0307869 8.7949219 5.0292969L8.7949219 5.0332031C8.6869895 5.0321348 8.6088769 5 8.5 5 z M 17.244141 9.6875C20.958329 11.206563 23.567159 13.545736 25.289062 16.205078C28.121174 20.579045 28.80951 25.605232 28.957031 27.609375 A 1.50015 1.50015 0 0 0 30.453125 29L35.878906 29L25.5 39.378906L15.121094 29L20.615234 29 A 1.50015 1.50015 0 0 0 22.109375 27.640625C22.304498 25.556671 22.538354 20.789675 20.970703 16.023438C20.238319 13.79672 19.005698 11.585426 17.244141 9.6875 z" />
                                </svg>
                            </a>
                            <div onclick="scrollUp()">
                                Go To First Message
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24">
                                    <path d="M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10S17.5,2,12,2z M13.3,16.6h-1.8V9.5l-2.2,0.7V8.7l3.8-1.4h0.2V16.6z M20,12c0,4.418-3.582,8-8,8s-8-3.582-8-8s3.582-8,8-8S20,7.582,20,12z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div> -->
                <p id="alert" class="alert">
                    Message Copied To Clipboard
                </p>
            </div>
            <div class="chat-ui-messages <?php if ($rowMessage <= 0) {
                                                echo 'start-chat';
                                            } ?>" id="messs">
                <?php if ($rowMessage == 0) { ?>
                    <div class="start-chat">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32">
                            <path d="M3 5L3 23L8 23L8 28.09375L9.625 26.78125L14.34375 23L29 23L29 5 Z M 5 7L27 7L27 21L13.65625 21L13.375 21.21875L10 23.90625L10 21L5 21 Z M 12.71875 9.28125L11.28125 10.71875L14.5625 14L11.28125 17.28125L12.71875 18.71875L16 15.4375L19.28125 18.71875L20.71875 17.28125L17.4375 14L20.71875 10.71875L19.28125 9.28125L16 12.5625Z" />
                        </svg>
                    </div>
                    <h1>No Messages Between You And @<?php echo $friendU ?></h1>
                    <button onclick="hi()">
                        Say Hi
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30">
                            <path d="M14.667969 2.0039062C13.972357 2.0542734 13.383563 2.5882656 13.289062 3.3066406L12.013672 13.083984L11 13L10.472656 13L8.9785156 5.2128906C8.8225156 4.3998906 8.0356562 3.8664375 7.2226562 4.0234375C6.4096563 4.1794375 5.87525 4.9662969 6.03125 5.7792969L8 16.029297L8 17.736328L10.574219 15.537109C11.671219 14.599109 13.286953 14.707344 14.251953 15.777344C15.167953 16.793344 15.149938 18.367328 14.210938 19.361328L11.863281 21.84375C11.765281 21.94775 11.632 22 11.5 22C11.376 22 11.25325 21.955281 11.15625 21.863281C10.95625 21.674281 10.947719 21.35725 11.136719 21.15625L13.482422 18.675781C14.065422 18.057781 14.078766 17.078266 13.509766 16.447266C12.907766 15.780266 11.903656 15.716828 11.222656 16.298828L7.6523438 19.347656L7.0488281 19.949219C5.8568281 21.140219 5.6724219 23.008156 6.6074219 24.410156L7.515625 25.773438C8.443625 27.164437 10.004781 28 11.675781 28L19 28C21.209 28 23 26.209 23 24L23 19.488281C22.581 19.804281 22.065 20 21.5 20C20.678 20 19.956 19.598328 19.5 18.986328C19.044 19.598328 18.322 20 17.5 20C16.119 20 15 18.881 15 17.5L15 13.378906L16.265625 3.6953125C16.372625 2.8743125 15.793656 2.1216719 14.972656 2.0136719C14.870031 2.0002969 14.767342 1.9967109 14.667969 2.0039062 z M 17.5 12C16.672 12 16 12.672 16 13.5L16 17.5C16 18.328 16.672 19 17.5 19C18.328 19 19 18.328 19 17.5L19 13.5C19 12.672 18.328 12 17.5 12 z M 21.5 13C20.672 13 20 13.672 20 14.5L20 17.5C20 18.328 20.672 19 21.5 19C22.328 19 23 18.328 23 17.5L23 14.5C23 13.672 22.328 13 21.5 13 z" />
                        </svg>
                    </button>
                <?php } else { ?>
                    <?php
                    while ($fetchMessage = mysqli_fetch_array($getmessage)) {
                        $message = $fetchMessage['message'];
                        $from = $fetchMessage['from_user'];
                        $to = $fetchMessage['to_user'];
                        $msgtype = $fetchMessage['type'];
                        $msgdate = $fetchMessage['date'];
                        $msgseen = $fetchMessage['seen'];
                    ?>
                        <div class="chat-ui-<?php if ($from == $sessId) {
                                                echo 'right';
                                            } else {
                                                echo 'left';
                                            } ?> chat-all-card">
                            <?php if ($from != $sessId) { ?>

                                <div class="chat-ui-right-img chat-ui-img">
                                    <?php if($friendP == '#'){?>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 16 16">
                                            <path d="M8 2C6.347656 2 5 3.347656 5 5C5 6.652344 6.347656 8 8 8C9.652344 8 11 6.652344 11 5C11 3.347656 9.652344 2 8 2 Z M 8 8C5.246094 8 3 10.246094 3 13L4 13C4 10.785156 5.785156 9 8 9C10.214844 9 12 10.785156 12 13L13 13C13 10.246094 10.753906 8 8 8 Z M 8 3C9.109375 3 10 3.890625 10 5C10 6.109375 9.109375 7 8 7C6.890625 7 6 6.109375 6 5C6 3.890625 6.890625 3 8 3Z" />
                                        </svg>
                                    <?php }else{?>
                                    <img src="../../../assets/users/<?php echo $friendP?>" alt="<?php $friendP?>'s Profile Picture">
                                    <?php } ?>
                                </div>
                                <div class="chat-ui-right-message message-card">
                                    <?php
                                    if ($msgtype == '1') {
                                    ?>
                                        <p class="message-text">
                                            <?php echo $message ?>
                                        </p>
                                    <?php } else if ($msgtype == '2') { ?>
                                        <div class="audio-card">
                                            <audio controls>
                                                <source src="../../../assets/messages/audios/<?php echo $message ?>">
                                                Sorry, Your Browser Doesn't Support Videos
                                            </audio>
                                        </div>
                                    <?php } else if ($msgtype == '3') { ?>
                                        <video controls>
                                            <source src="../../../assets/messages/videos/<?php echo $message ?>">
                                            Sorry, Your Browser Doesn't Support Videos
                                        </video>
                                    <?php } else if ($msgtype == '4') { ?>
                                        <div class="image-card">
                                            <img src="../../../assets/messages/images/<?php echo $message?>" alt="Picture From <?php echo $friendU?>">
                                        </div>
                                    <?php } else if ($msgtype == '5') { ?>
                                        <!-- <p class="message-text"> -->
                                            <a href="<?php echo $message ?>" target="_blank" class="message-text"><?php echo $message ?></a>
                                        <!-- </p> -->
                                    <?php } ?>
                                    <div class="chat-ui-right-message message-options">
                                        <p class="composer">
                                            <?php echo '@ '.$friendU?>
                                        </p>
                                        <p class="time">
                                            <?php echo $msgdate?>
                                        </p>
                                        <!-- <?php if ($msgtype == '1' ) { ?>
                                            <button class="copy-btn" title="Copy Message">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24">
                                                    <path d="M4 2C2.895 2 2 2.895 2 4L2 18L4 18L4 4L18 4L18 2L4 2 z M 8 6C6.895 6 6 6.895 6 8L6 20C6 21.105 6.895 22 8 22L20 22C21.105 22 22 21.105 22 20L22 8C22 6.895 21.105 6 20 6L8 6 z M 8 8L20 8L20 20L8 20L8 8 z" />
                                                </svg>
                                            </button>
                                        <?php } ?> -->
                                    </div>

                                </div>

                        </div>
                    <?php } else { ?>
                        <div class="chat-ui-right-message message-card">
                            <?php
                                if ($msgtype == '1') {
                            ?>
                                <p class="message-text">
                                    <?php echo $message ?>
                                </p>
                            <?php } else if ($msgtype == '2') { ?>
                                <div class="audio-card">
                                    <audio controls>
                                        <source src="../../../assets/messages/audios/<?php echo $message ?>">
                                        Sorry, Your Browser Doesn't Support Videos
                                    </audio>
                                </div>
                            <?php } else if ($msgtype == '3') { ?>
                                <video controls>
                                    <source src="../../../assets/messages/videos/<?php echo $message ?>">
                                    Sorry, Your Browser Doesn't Support Videos
                                </video>
                            <?php } else if ($msgtype == '4') { ?>
                                <div class="image-card">
                                    <img src="../../../assets/messages/images/<?php echo $message?>" alt="Picture From <?php echo $friendU?>">
                                </div>
                            <?php } else if ($msgtype == '5') { ?>
                                <!-- <p class="message-text"> -->
                                    <a href="<?php echo $message ?>" target="_blank" class="message-text"><?php echo $message ?></a>
                                <!-- </p> -->
                            <?php } ?>
                            <div class="chat-ui-right-message message-options">
                                <!-- <?php if ($msgtype == '1' ) { ?>
                                    <button class="copy-btn" title="Copy Message">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24">
                                            <path d="M4 2C2.895 2 2 2.895 2 4L2 18L4 18L4 4L18 4L18 2L4 2 z M 8 6C6.895 6 6 6.895 6 8L6 20C6 21.105 6.895 22 8 22L20 22C21.105 22 22 21.105 22 20L22 8C22 6.895 21.105 6 20 6L8 6 z M 8 8L20 8L20 20L8 20L8 8 z" />
                                        </svg>
                                    </button>
                                <?php } ?> -->
                                <p class="read">
                                    <?php if($msgseen == '0'){?>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24">
                                            <path d="M20.292969 5.2929688L9 16.585938L4.7070312 12.292969L3.2929688 13.707031L9 19.414062L21.707031 6.7070312L20.292969 5.2929688 z"/>
                                        </svg>
                                    <?php }else{?>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24">
                                        <path d="M15.980469 6.9902344 A 1.0001 1.0001 0 0 0 15.292969 7.2929688L11.455078 11.130859 A 1.0001 1.0001 0 1 0 12.869141 12.544922L16.707031 8.7070312 A 1.0001 1.0001 0 0 0 15.980469 6.9902344 z M 21.980469 6.9902344 A 1.0001 1.0001 0 0 0 21.292969 7.2929688L12 16.585938L8.7070312 13.292969 A 1.0001 1.0001 0 1 0 7.2929688 14.707031L11.292969 18.707031 A 1.0001 1.0001 0 0 0 12.707031 18.707031L22.707031 8.7070312 A 1.0001 1.0001 0 0 0 21.980469 6.9902344 z M 1.9902344 12.990234 A 1.0001 1.0001 0 0 0 1.2929688 14.707031L4.5449219 17.960938 A 1.0012744 1.0012744 0 1 0 5.9609375 16.544922L2.7070312 13.292969 A 1.0001 1.0001 0 0 0 1.9902344 12.990234 z" />
                                    </svg>
                                    <?php } ?>
                                </p>
                                <p class="time">
                                    <?php echo $msgdate?>
                                </p>
                                <p class="composer">
                                    You
                                </p>
                            </div>

                        </div>
                        <div class="chat-ui-right-img chat-ui-img">
                            <?php if($profimg == '#'){?>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 16 16">
                                    <path d="M8 2C6.347656 2 5 3.347656 5 5C5 6.652344 6.347656 8 8 8C9.652344 8 11 6.652344 11 5C11 3.347656 9.652344 2 8 2 Z M 8 8C5.246094 8 3 10.246094 3 13L4 13C4 10.785156 5.785156 9 8 9C10.214844 9 12 10.785156 12 13L13 13C13 10.246094 10.753906 8 8 8 Z M 8 3C9.109375 3 10 3.890625 10 5C10 6.109375 9.109375 7 8 7C6.890625 7 6 6.109375 6 5C6 3.890625 6.890625 3 8 3Z" />
                                </svg>
                            <?php }else{?>
                            <img src="../../../assets/users/<?php echo $profimg?>" alt="My Profile Picture">
                            <?php } ?>
                        </div>
            </div>
    <?php }
                        } ?>
<?php } ?>
        </div>
        <div class="chat-ui-typer">
            <div class="type-input">
                <form method="POST">
                    <div class="message-tools">
                        <input type="text" name="messageText" id="messageType" required placeholder="Type Your Message...">
                        <div class="other-message-tools">
                            <div class="message-tools-main" id="optionsBtn">
                                <p>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 128 128">
                                        <path d="M64 6.0507812C49.15 6.0507812 34.3 11.7 23 23C0.4 45.6 0.4 82.4 23 105C34.3 116.3 49.2 122 64 122C78.8 122 93.7 116.3 105 105C127.6 82.4 127.6 45.6 105 23C93.7 11.7 78.85 6.0507812 64 6.0507812 z M 64 12C77.3 12 90.600781 17.099219 100.80078 27.199219C121.00078 47.499219 121.00078 80.500781 100.80078 100.80078C80.500781 121.10078 47.500781 121.10078 27.300781 100.80078C7.0007813 80.500781 6.9992188 47.499219 27.199219 27.199219C37.399219 17.099219 50.7 12 64 12 z M 64 42C62.3 42 61 43.3 61 45L61 61L45 61C43.3 61 42 62.3 42 64C42 65.7 43.3 67 45 67L61 67L61 83C61 84.7 62.3 86 64 86C65.7 86 67 84.7 67 83L67 67L83 67C84.7 67 86 65.7 86 64C86 62.3 84.7 61 83 61L67 61L67 45C67 43.3 65.7 42 64 42 z" />
                                    </svg>
                                </p>
                            </div>
                            <div class="message-tools-abs" id="options">
                                <p onclick="showTools('image','showToolSend')">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48">
                                        <path d="M11.5 6C8.4802259 6 6 8.4802259 6 11.5L6 36.5C6 39.519774 8.4802259 42 11.5 42L36.5 42C39.519774 42 42 39.519774 42 36.5L42 11.5C42 8.4802259 39.519774 6 36.5 6L11.5 6 z M 11.5 9L36.5 9C37.898226 9 39 10.101774 39 11.5L39 31.955078L32.988281 26.138672 A 1.50015 1.50015 0 0 0 32.986328 26.136719C32.208234 25.385403 31.18685 25 30.173828 25C29.16122 25 28.13988 25.385387 27.361328 26.138672L25.3125 28.121094L19.132812 22.142578C18.35636 21.389748 17.336076 21 16.318359 21C15.299078 21 14.280986 21.392173 13.505859 22.140625 A 1.50015 1.50015 0 0 0 13.503906 22.142578L9 26.5L9 11.5C9 10.101774 10.101774 9 11.5 9 z M 30.5 13C29.125 13 27.903815 13.569633 27.128906 14.441406C26.353997 15.313179 26 16.416667 26 17.5C26 18.583333 26.353997 19.686821 27.128906 20.558594C27.903815 21.430367 29.125 22 30.5 22C31.875 22 33.096185 21.430367 33.871094 20.558594C34.646003 19.686821 35 18.583333 35 17.5C35 16.416667 34.646003 15.313179 33.871094 14.441406C33.096185 13.569633 31.875 13 30.5 13 z M 30.5 16C31.124999 16 31.403816 16.180367 31.628906 16.433594C31.853997 16.686821 32 17.083333 32 17.5C32 17.916667 31.853997 18.313179 31.628906 18.566406C31.403816 18.819633 31.124999 19 30.5 19C29.875001 19 29.596184 18.819633 29.371094 18.566406C29.146003 18.313179 29 17.916667 29 17.5C29 17.083333 29.146003 16.686821 29.371094 16.433594C29.596184 16.180367 29.875001 16 30.5 16 z M 16.318359 24C16.578643 24 16.835328 24.09366 17.044922 24.296875 A 1.50015 1.50015 0 0 0 17.046875 24.298828L23.154297 30.207031L14.064453 39L11.5 39C10.101774 39 9 37.898226 9 36.5L9 30.673828L15.589844 24.298828C15.802764 24.093234 16.059641 24 16.318359 24 z M 30.173828 28C30.438806 28 30.692485 28.09229 30.902344 28.294922L39 36.128906L39 36.5C39 37.898226 37.898226 39 36.5 39L18.380859 39L29.447266 28.294922C29.654714 28.094207 29.910436 28 30.173828 28 z" />
                                    </svg>
                                </p>
                                <p onclick="showTools('video','showToolSend')">
                                    <svg xmlns=" http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24">
                                        <path d="M3 5C1.9069372 5 1 5.9069372 1 7L1 17C1 18.093063 1.9069372 19 3 19L16 19C17.093063 19 18 18.093063 18 17L18 14.080078L23 18.080078L23 5.9199219L18 9.9199219L18 7C18 5.9069372 17.093063 5 16 5L3 5 z M 3 7L16 7L16 17L3 17L3 7 z M 21 10.082031L21 13.917969L18.601562 12L21 10.082031 z" />
                                    </svg>
                                </p>
                                <p onclick="showTools('audio','showToolSend')">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24">
                                        <path d="M12,2c-4.962,0-9,4.038-9,9v8c0,1.105,0.895,2,2,2h3v-7H5v-3c0-3.86,3.14-7,7-7s7,3.14,7,7v3h-3v7h3c1.105,0,2-0.895,2-2v-8 C21,6.038,16.962,2,12,2z" />
                                    </svg>
                                </p>
                                <p onclick="showTools('link','showToolSend')">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24">
                                        <path d="M6 7C3.239 7 1 9.239 1 12C1 14.761 3.239 17 6 17L10 17L10 15L6 15C4.343 15 3 13.657 3 12C3 10.343 4.343 9 6 9L10 9L10 7L6 7 z M 14 7L14 9L18 9C19.657 9 21 10.343 21 12C21 13.657 19.657 15 18 15L14 15L14 17L18 17C20.761 17 23 14.761 23 12C23 9.239 20.761 7 18 7L14 7 z M 7 11L7 13L17 13L17 11L7 11 z" />
                                    </svg>
                                </p>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="sendMessageTxt">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30">
                            <path d="M6 3 A 2 2 0 0 0 4 5L4 11 A 2 2 0 0 0 5.3398438 12.884766 A 2 2 0 0 0 6 13 A 2 2 0 0 0 6.0214844 13L18 15L6.0214844 17.001953 A 2 2 0 0 0 6 17 A 2 2 0 0 0 5.3378906 17.115234 A 2 2 0 0 0 4 19L4 25 A 2 2 0 0 0 6 27 A 2 2 0 0 0 6.9921875 26.734375L6.9941406 26.734375L27.390625 15.921875L27.392578 15.917969 A 1 1 0 0 0 28 15 A 1 1 0 0 0 27.390625 14.078125L6.9941406 3.265625 A 2 2 0 0 0 6 3 z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        </div>
    <?php } ?>
    <script>
        var messageType = document.querySelector('#messageType');

        function hi() {
            messageType.value = 'Hey, <?php echo $friendN ?>!!';
        }
        var messagesDiv = document.getElementById("messs");
        window.addEventListener("load", scroller);

        function scroller() {
            messagesDiv.scrollTo(0, messagesDiv.scrollHeight)
        }

        function scrollUp() {
            messagesDiv.scrollTo(messagesDiv.scrollHeight, 0)
        }

        // var archives = document.getElementById("archived");
        // var archivesUl = archives.querySelector("ul");
        // archives.addEventListener("click", function() {
        //     archivesUl.classList.toggle("showArchives");
        // })
    </script>
    <script src="../../../js/app.js"></script>
    <script src="../../../js/theme.js"></script>
    <script src="../../../js/show.js"></script>
    <script>
        var messageCard = document.querySelectorAll(".message-card");
        messageCard.forEach(copy);

        function copy(ev) {
            var message = ev.querySelector(".message-text");
            var messageText = message.innerHTML;
            var copybtn = ev.querySelector(".copy-btn");
            copybtn.addEventListener("click", function() {
                navigator.clipboard.writeText(messageText);
                var alert = document.getElementById("alert");
                alert.classList.add("showalert");
                setTimeout(alertFunction, 1700);

                function alertFunction() {
                    alert.classList.remove("showalert");
                }
            });
        }
        
        var menuOptions = document.querySelector('#menuOptions');

        function menuOptionsOn() {
            menuOptions.classList.toggle('menu-btn-abs-show');
        }
    </script>
</body>
<?php
/*Messages Type
        1 -> Text
        2 -> Audio
        3 -> Video
        4 -> Image
        5 -> Link
    */
$day = date('l');
if ($day == 'Monday') {
    $day = "Mon";
} else if ($day == 'Tuesday') {
    $day = 'Tue';
} else if ($day == 'Wednesday') {
    $day = 'Wed';
} else if ($day == 'Thursday') {
    $day = 'Thu';
} else if ($day == 'Friday') {
    $day = 'Fri';
} else if ($day == 'Saturday') {
    $day = 'Sat';
} else if ($day == 'Sunday') {
    $day == 'Sun';
}
$date = date('d/m/Y H:i');
$allDate = $day . ", " . $date;
$seen = 0;
if (isset($_POST['sendMessageTxt'])) {
    $msg = $_POST['messageText'];
    $type = '1';
    $msgQuery = mysqli_query($conn, "INSERT INTO messages VALUES(NULL, '$sessId','$user','$msg' ,'$type', '$allDate','$seen')");
    if ($msgQuery) {
        echo "<script>window.location.href='./?c=$user'</script>";
    } else {
        die("" . mysqli_error($conn));
    }

    $checkanyInDm = mysqli_query($conn, "SELECT * FROM dms");
    if (mysqli_num_rows($checkanyInDm) > 0) {
        $fetchLastIndm = mysqli_query($conn, "SELECT * FROM dms ORDER BY latest DESC LIMIT 1");
        $getlatest = mysqli_fetch_array($fetchLastIndm);
        $lastin = $getlatest['latest'];
        $lastchat = $lastin + 1;
        $checkDM = mysqli_query($conn, "SELECT * FROM dms WHERE user1 = $sessId AND user2 = $chatid OR user1 = $chatid AND user2 = $sessId");

        if (mysqli_num_rows($checkDM) == 0) {
            $qqq = mysqli_query($conn, "INSERT INTO dms VALUES(NULL,'$sessId','$chatid','$lastchat')");
        } else {
            $qqq = mysqli_query($conn, "UPDATE dms SET latest = $lastchat WHERE user1 = $sessId AND user2 = $chatid OR user1 = $chatid AND user2 = $sessId ");
        }
    } else {
        $qqq = mysqli_query($conn, "INSERT INTO dms VALUES(NULL,'$sessId','$chatid','1')");
    }
}

if (isset($_POST['sendAudio'])) {
    $msg = $_FILES['audioFile']['name'];
    $tmp_n = $_FILES['audioFile']['tmp_name'];
    $path = '../../../assets/messages/audios/' . $msg;
    $move = move_uploaded_file($tmp_n, $path);
    $type = '2';
    $msgQuery = mysqli_query($conn, "INSERT INTO messages VALUES(NULL, '$sessId','$user','$msg' ,'$type', '$allDate','$seen')");
    if ($msgQuery) {
        echo "<script>window.location.href='./?c=$user'</script>";
    }
    
    
}

if (isset($_POST['sendVideo'])) {
    $msg = $_FILES['videoFile']['name'];
    $tmp_n = $_FILES['videoFile']['tmp_name'];
    $path = '../../../assets/messages/videos/' . $msg;
    $move = move_uploaded_file($tmp_n, $path);
    $type = '3';
    $msgQuery = mysqli_query($conn, "INSERT INTO messages VALUES(NULL, '$sessId','$user','$msg' ,'$type', '$allDate','$seen')");
    if ($msgQuery) {
        echo "<script>window.location.href='./?c=$user'</script>";
    } else {
        die("" . mysqli_error($conn));
    }
    $checkDM = mysqli_query($conn, "SELECT * FROM dms WHERE user1 = $sessId AND user2 = $chatid OR user1 = $chatid AND user2 = $sessId");
    
    if(mysqli_num_rows($checkDM) <= 0){
        $qqq = mysqli_query($conn, "INSERT INTO dms VALUES(NULL,'$sessId','$chatid')");
    }
}

if (isset($_POST['sendImg'])) {
    $msg = $_FILES['imgFile']['name'];
    $tmp_n = $_FILES['imgFile']['tmp_name'];
    $path = '../../../assets/messages/images/' . $msg;
    $move = move_uploaded_file($tmp_n, $path);
    $type = '4';
    $msgQuery = mysqli_query($conn, "INSERT INTO messages VALUES(NULL, '$sessId','$user','$msg' ,'$type', '$allDate','$seen')");
    if ($msgQuery) {
        echo "<script>window.location.href='./?c=$user'</script>";
    }
    $checkDM = mysqli_query($conn, "SELECT * FROM dms WHERE user1 = $sessId AND user2 = $chatid OR user1 = $chatid AND user2 = $sessId");
    
    if(mysqli_num_rows($checkDM) <= 0){
        $qqq = mysqli_query($conn, "INSERT INTO dms VALUES(NULL,'$sessId','$chatid')");
    }
}
if (isset($_POST['sendLink'])) {
    $msg = $_POST['linkMsg'];
    $type = '5';
    $msgQuery = mysqli_query($conn, "INSERT INTO messages VALUES(NULL, '$sessId','$user','$msg' ,'$type', '$allDate','$seen')");
    if ($msgQuery) {
        echo "<script>window.location.href='./?c=$user'</script>";
    }
    $checkDM = mysqli_query($conn, "SELECT * FROM dms WHERE user1 = $sessId AND user2 = $chatid OR user1 = $chatid AND user2 = $sessId");
    
    if(mysqli_num_rows($checkDM) <= 0){
        $qqq = mysqli_query($conn, "INSERT INTO dms VALUES(NULL,'$sessId','$chatid')");
    }
}
?>

</html>