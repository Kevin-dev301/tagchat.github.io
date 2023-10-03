<?php
// session_start();
include "../../../../admins/chatdb.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tag Chat</title>
    <link rel="stylesheet" href="../../../css/settings/main.css">
</head>
<body style="background: #4EAC6D;">



<?php
    include("../nav.php");
    ?>
     <div class="abs-img">
                    <img src="./auth-img.png" alt="Login" style="width: 100%; height:100%;"draggable="false">
                </div>
<div class="settings-main-ui" id="Ref"style="width:100%">
        <div class="settings-header w-header">
            <h1>
                <span id="closeSetBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50">
                        <path d="M32.136719 3.0625C31.875 3.0625 31.628906 3.167969 31.441406 3.351563L10.359375 24.265625C9.964844 24.65625 9.960938 25.289063 10.351563 25.679688L31.265625 46.765625C31.65625 47.15625 32.289063 47.160156 32.679688 46.769531L38.703125 40.796875C39.097656 40.40625 39.101563 39.773438 38.710938 39.378906L24.476563 25.03125L38.828125 10.796875C39.21875 10.40625 39.222656 9.773438 38.832031 9.382813L32.859375 3.359375C32.667969 3.164063 32.40625 3.058594 32.136719 3.0625Z" />
                    </svg>
                </span>
                Create Your Account With Tag Chat
            </h1>
        </div>
        <div class="settings-all">
            <div class="settings-all-crd">
                <div class="settings-all-crd-top">
                    <h2>Account</h2>
                    <p> Personal Information</p>
                </div>
                <div class="settings-all-crd-main">
                    <form action="../../../handles/" method="POST">
                        <div class="form-main">
                            <div class="form-crd">
                                <label>Names</label>
                                <input type="text" name="upName" placeholder="Your Tag-Chat Names" required >
                            </div>
                            <div class="form-crd">
                                <label>Username</label>
                                <input type="text" name="upUserName" pattern="[0-9a-z_]+" placeholder="Your Tag-Chat Username" required>
                            </div>

                            <div class="form-crd">
                                <label>Email</label>
                                <input type="email" name="upEmail" placeholder="Your Email" required >
                            </div>
                            <div class="form-crd">
                                <label>Birth Date</label>
                                <input type="date" >
                            </div>

                            <div class="form-crd">
                                <label>Gender</label>
                                <input type="text" >
                            </div>
                            <div class="form-crd">
                                <label>Location</label>
                                <input type="text"  name="location">
                            </div>

                            <div class="form-crd">
                                <label>About Descr.</label>
                                <textarea name="upDescr" placeholder="Your About"></textarea>
                            </div>
                        </div>

                        <div class="settings-all-crd-btns">
                            <button type="submit" name="updateAcc">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="settings-all-crd">
                <div class="settings-all-crd-top">
                    <h2>Profile</h2>
                    <p>Update Profile & Cover Photos</p>
                </div>
                <div class="settings-all-crd-main img-section">
                    <form action="../../../handles/" method="POST" enctype="multipart/form-data">
                        <div class="form-main">
                            <div class="form-crd">
                                <label>Profile (Click Below)</label>
                                <input type="file" name="upProfImg" id="updateProfile" onchange="changer(event)" accept="image/*">
                                <label for="updateProfile" class="for-label">
                                  
                                        <img src="../../../assets/img/imgPre.svg" alt="Default Profile" id="profilePreview">
                                  
                                        <img src="../../../assets/users/ alt="profile_Image" id="profilePreview">
                                   
                                </label>
                            </div>
                        </div>

                        <div class="settings-all-crd-btns">
                            <button type="reset" onclick="resetPreviews1()">Reset</button>
                            <button type="submit" name="upProfile">Save Changes</button>
                        </div>
                    </form>

                    <form action="../../../handles/" method="POST" enctype="multipart/form-data">
                        <div class="form-main">

                            <div class="form-crd">
                                <label>Cover (Click Below)</label>
                                <input type="file" name="updCoverImg" id="updateCover" onchange="changerCover(event)">
                                <label for="updateCover" class="for-label-lg "accept="image/*">
                                <img src="../../../assets/img/imgPre.svg" alt="Default Profile" id="profilePreview">
                                <!-- <img src="../../../assets/users/" alt="cover_image" id="coverPreview"> -->
          
                                </label>
                            </div>
                        </div>

                        <div class="settings-all-crd-btns">
                            <button type="reset" onclick="resetPreviews2()">Reset</button>
                            <button type="submit" name="upCover">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="settings-all-crd">
                <div class="settings-all-crd-top">
                    <h2>Password</h2>
                    <p>Update Your Password</p>
                </div>
                <div class="settings-all-crd-main">
                    <form action="../../../handles/" method="POST">
                        <div class="form-main">
                            <div class="form-crd">
                                <label>Current Password (Not Shown For Security Reasons)</label>
                                <input type="password" name="currentPw" placeholder="Your Current Password" id="">
                            </div>
                            <div class="form-crd">
                                <label>New Password</label>
                                <input type="password" name="newPw" placeholder="Your New Password" id="">
                            </div>
                            <div class="form-crd">
                                <label>Repeat New Password</label>
                                <input type="password" name="repNewPw" placeholder="Repeat New Password" id="">
                            </div>
                        </div>

                        <div class="settings-all-crd-btns">
                            <button type="submit" name="upPw">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="settings-all-crd">
                <div class="settings-all-crd-top">
                    <h2>Social Networks</h2>
                    <p>Update Your Social Medias</p>
                </div>
                <div class="settings-all-crd-main">
                    <form action="../../../handles/" method="POST">
                        <div class="form-main">
                            <div class="form-crd">
                                <label>Facebook</label>
                                <input type="text" name="upFb"  placeholder="Your Facebook Url" id="">
                            </div>
                            <div class="form-crd">
                                <label>Instagram</label>
                                <input type="text" name="upIg"  placeholder="Your Instagram Link" id="">
                            </div>
                            <div class="form-crd">
                                <label>Twitter</label>
                                <input type="text" name="upTl"  placeholder="Your Twitter Link" id="">
                            </div>
                            <div class="form-crd">
                                <label>Linked In</label>
                                <input type="text" name="upLn"  placeholder="Your Linkedin Profile Link" id="">
                            </div>
                            <div class="form-crd">
                                <label>Youtube</label>
                                <input type="text" name="upYt"  placeholder="Your Youtube Channel Link" id="">
                            </div>
                            <div class="form-crd">
                                <label>Website</label>
                                <input type="text" name="upWeb"  placeholder="Your Website" id="">
                            </div>
                        </div>

                        <div class="settings-all-crd-btns">
                            <button type="submit" name="upSocials">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="settings-all-crd">
                <div class="settings-all-crd-top">
                    <h2>Privacy</h2>
                    <p>Update Your Privacy Security</p>
                </div>
                <div class="settings-all-crd-main">
                    <form action="../../../handles/" method="POST">
                        <div class="form-main">
                            <div class="form-crd">
                                <label>Last Seen</label>
                                <select name="visibility">
                                    <option value="1">Friends</option>
                                    <option value="0">No One</option>
                                </select>
                            </div>
                        </div>

                        <div class="settings-all-crd-btns">
                            <button type="submit" name="upVisibility">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../js/show.js"></script>
    <script src="../../../js/app.js"></script>
    <script src="../../../js/tabs.js"></script>
    <script src="../../../js/theme.js"></script>
    <script>
        var setting = document.querySelector("#settingBar");
        var openSet = document.querySelector("#openSetBtn");
        var closeSet = document.querySelector("#closeSetBtn");
        openSet.addEventListener('click', function() {
            setting.classList.add('showSetting');
        })

        closeSet.addEventListener('click', function() {
            setting.classList.remove('showSetting');
        })

        var imgPre = document.getElementById('profilePreview');
        var imgPreDv = document.getElementById('profPreviewDv');

        function changer(event) {
            var imgLink = URL.createObjectURL(event.target.files[0]);
            imgPreDv.style.padding = '0';
            imgPre.src = imgLink;
        }

        var coverPre = document.getElementById('coverPreview');
        var covPreDv = document.getElementById('coverPreviewDv');

        function changerCover(event) {
            var covLink = URL.createObjectURL(event.target.files[0]);
            coverPre.src = covLink;
            coverPre.style.width = '100%';
            coverPre.style.height = '100%';
        }

        function resetPreviews1() {
            imgPre.src = '../../../assets/img/imgPre.svg';
            imgPreDv.style.padding = '15px';
        }

        function resetPreviews2() {
            coverPre.src = '../../../assets/img/imgPre.svg';
            coverPre.style.width = '40px';
            coverPre.style.height = '40px';
        }
    </script>
</body>
</html>