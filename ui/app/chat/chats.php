<?php
// include ('../../../admins/chatdb.php');
$sessid = $_SESSION['chatId'];
$sessAvailable = $_SESSION['chatAvailability'];
if (isset($_GET['c'])) {
    $chatid = $_GET['c'];
}
?>
<div class="people" id="myChat">
    <div class="people-top people-pad" id="myChatSearch">
        <div class="people-top-top">
            <h2>Chats</h2>
            <!-- <button>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26 26">
                    <path d="M12 3C11.398438 3 11 3.398438 11 4L11 11L4 11C3.398438 11 3 11.398438 3 12L3 14C3 14.601563 3.398438 15 4 15L11 15L11 22C11 22.601563 11.398438 23 12 23L14 23C14.601563 23 15 22.601563 15 22L15 15L22 15C22.601563 15 23 14.601563 23 14L23 12C23 11.398438 22.601563 11 22 11L15 11L15 4C15 3.398438 14.601563 3 14 3Z" />
                </svg>
            </button> -->
        </div>
        <div class="people-search">
            <input type="text" onkeyup="search('peopleSearch','chats-people')" id="peopleSearch" name="people-search" placeholder="Search Here...">
        </div>
    </div>
    <!-- <div class="archived people-group people-pad" id="archived">
        <button>
            Archived Chats
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48">
                <path d="M8.5 5 A 1.50015 1.50015 0 0 0 8.2050781 7.9707031C14.141318 9.1580428 16.771994 12.859175 18.121094 16.960938C19.259757 20.422894 19.26013 23.812407 19.144531 26L11.5 26 A 1.50015 1.50015 0 0 0 10.439453 28.560547L24.439453 42.560547 A 1.50015 1.50015 0 0 0 26.560547 42.560547L40.560547 28.560547 A 1.50015 1.50015 0 0 0 39.5 26L31.714844 26C31.418399 23.342281 30.656717 18.972916 27.808594 14.574219C24.57487 9.5799927 18.629736 5.1401785 8.8144531 5.0371094C8.8069831 5.0356094 8.8024039 5.0307869 8.7949219 5.0292969L8.7949219 5.0332031C8.6869895 5.0321348 8.6088769 5 8.5 5 z M 17.244141 9.6875C20.958329 11.206563 23.567159 13.545736 25.289062 16.205078C28.121174 20.579045 28.80951 25.605232 28.957031 27.609375 A 1.50015 1.50015 0 0 0 30.453125 29L35.878906 29L25.5 39.378906L15.121094 29L20.615234 29 A 1.50015 1.50015 0 0 0 22.109375 27.640625C22.304498 25.556671 22.538354 20.789675 20.970703 16.023438C20.238319 13.79672 19.005698 11.585426 17.244141 9.6875 z" />
            </svg>
        </button>
        <ul class="people-cards">
            <li class="people-card">
                <a href="" class="people-card-in">
                    <div class="people-card-left">
                        <div class="people-img">
                            <img src="../../../assets/avatar-1.jpg" alt="User">
                            <span></span>
                        </div>
                        <div class="names">
                            John Doe
                        </div>
                    </div>
                    <div class="people-info-last">
                        <div class="count">
                            4
                        </div>
                    </div>
                </a>
            </li>
            <li class="people-card">
                <a href="" class="people-card-in">
                    <div class="people-card-left">
                        <div class="people-img">
                            <img src="../../../assets/avatar-1.jpg" alt="User">
                            <span></span>
                        </div>
                        <div class="names">
                            John Doe
                        </div>
                    </div>
                    <div class="people-info-last">
                        <div class="count">
                            4
                        </div>
                    </div>
                </a>
            </li>
            <li class="people-card">
                <a href="" class="people-card-in">
                    <div class="people-card-left">
                        <div class="people-img">
                            <img src="../../../assets/avatar-1.jpg" alt="User">
                            <span></span>
                        </div>
                        <div class="names">
                            John Doe
                        </div>
                    </div>
                    <div class="people-info-last">
                        <div class="count">
                            4
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div> -->
    <div class="dm-people people-group people-pad">
        <h3>Direct Messages</h3>
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM messages WHERE from_user = $sessid OR to_user = $sessid");
        if (mysqli_num_rows($sql) == 0) {
        ?>
            <p>Your DMs Will Appear Here...</p>
        <?php } else { ?>

            <ul class="people-cards" id="chats-people">
                <?php

                $sql = mysqli_query($conn, "SELECT * FROM dms WHERE user1 = $sessid OR user2 = $sessid ORDER BY latest DESC");
                while ($fee = mysqli_fetch_array($sql)) {
                    $userr1 = $fee['user1'];
                    $userr2 = $fee['user2'];

                    if ($userr1 == $sessid) {
                        $userr = $userr2;
                    }

                    if ($userr2 == $sessid) {
                        $userr = $userr1;
                    }
                    $getDM = mysqli_query($conn, "SELECT * FROM user WHERE id = $userr");
                    $fetchDM = mysqli_fetch_array($getDM);

                    $dmimg = $fetchDM['profileimg'];
                    $dmusername = $fetchDM['username'];
                    $dmnames = $fetchDM['names'];
                    $dmverify = $fetchDM['verified'];
                    $dmactive = $fetchDM['active'];
                    $dmavailable = $fetchDM['active_availability'];

                    $checkMes = mysqli_query($conn, "SELECT * FROM messages WHERE from_user = $userr AND to_user = $sessid AND seen = 0");

                ?>
                    <li class="people-card <?php if ($chatid == $userr) {
                                                echo "activeDM";
                                            } ?>">
                        <a href="../dashboard/?c=<?php echo $userr ?>" class="people-card-in">
                            <div class="people-card-left">
                                <div class="people-img">
                                    <?php
                                    if ($dmimg == '#') {
                                    ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 16 16">
                                            <path d="M8 2C6.347656 2 5 3.347656 5 5C5 6.652344 6.347656 8 8 8C9.652344 8 11 6.652344 11 5C11 3.347656 9.652344 2 8 2 Z M 8 8C5.246094 8 3 10.246094 3 13L4 13C4 10.785156 5.785156 9 8 9C10.214844 9 12 10.785156 12 13L13 13C13 10.246094 10.753906 8 8 8 Z M 8 3C9.109375 3 10 3.890625 10 5C10 6.109375 9.109375 7 8 7C6.890625 7 6 6.109375 6 5C6 3.890625 6.890625 3 8 3Z" />
                                        </svg>
                                    <?php } else { ?>
                                        <img src="../../../assets/users/<?php echo $dmimg?>" alt="<?php $dmusername ?>'s Profile Picture">
                                    <?php } ?>
                                    <?php if($available == '1' && $dmactive == '1' && $dmavailable == '1'){?>
                                    <span></span>
                                    <?php } ?>
                                </div>
                                <div class="user">
                                    <div class="names">
                                        <?php echo $dmusername ?>
                                    </div>
                                    <?php if ($dmverify == '1') { ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24">
                                            <path d="M21.228,12l0.622-1.92c0.465-1.437-0.182-3-1.527-3.687l-1.797-0.918l-0.918-1.797c-0.687-1.345-2.25-1.993-3.687-1.527 L12,2.772L10.08,2.15c-1.437-0.465-3,0.182-3.687,1.527L5.474,5.474L3.677,6.393C2.332,7.08,1.685,8.643,2.15,10.08L2.772,12 L2.15,13.92c-0.465,1.437,0.182,3,1.527,3.687l1.797,0.918l0.918,1.797c0.687,1.345,2.25,1.993,3.687,1.527L12,21.228l1.92,0.622 c1.437,0.465,3-0.182,3.687-1.527l0.918-1.797l1.797-0.918c1.345-0.687,1.993-2.25,1.527-3.687L21.228,12z M11,16.414l-3.707-3.707 l1.414-1.414L11,13.586l5.293-5.293l1.414,1.414L11,16.414z" />
                                        </svg>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="people-info-last">
                                <!-- <div class="pinned">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32">
                                        <path d="M20.53125 2.5625L19.84375 3.5L14.9375 10.1875C12.308594 9.730469 9.527344 10.472656 7.5 12.5L6.78125 13.1875L12.09375 18.5L4 26.59375L4 28L5.40625 28L13.5 19.90625L18.8125 25.21875L19.5 24.5C21.527344 22.472656 22.269531 19.691406 21.8125 17.0625L28.5 12.15625L29.4375 11.46875 Z M 20.78125 5.625L26.375 11.21875L20.15625 15.78125L19.59375 16.1875L19.78125 16.84375C20.261719 18.675781 19.738281 20.585938 18.59375 22.1875L9.8125 13.40625C11.414063 12.261719 13.324219 11.738281 15.15625 12.21875L15.8125 12.40625L16.21875 11.84375Z" />
                                    </svg>
                                </div> -->
                                <div class="count">
                                    <?php echo mysqli_num_rows($checkMes); ?>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
</div>