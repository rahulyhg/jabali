<?php
session_start();

if (isset($_POST['create'])) {

    include 'functions/jabali.php';
    connectDb();

    $date = date('YmdHms');
    if (isset($_SESSION['myEmail'])) {
      $email = $_SESSION['myEmail'];
    } else {
      $email = hEMAIL;
    }

    $hash = str_shuffle(md5($email.$date));
    $abbr = substr($_POST['lname'], 0,2);

    $h_alias = $_POST['fname'].' '.$_POST['lname'];
    $h_author = substr($hash, 20);
    $h_avatar = hIMAGES.'avatar.svg';
    $h_center = $_POST['h_center'];
    $h_code = substr($hash, 20);
    $h_created = date('Ymd');
    $h_email = $_POST['h_email'];
    $h_gender = strtolower($_POST['h_gender']);
    $h_key = $hash;
    $h_level = $_POST['h_level'];
    $h_link = hPORTAL."user?view=$h_code";
    $h_location = strtolower( $_POST['h_location'] );
    $h_notes = "Account created on ".$date;
    $h_password = md5($_POST['h_password']);
    $h_phone = $_POST['h_phone'];
    $h_status = "active"; //Sort emailuser();, Change to "pending"
    $h_style = "zahra";
    $h_type = strtolower( $_POST['h_type'] );
    $h_username = strtolower($_POST['fname'].$abbr);

    if (mysqli_query($GLOBALS['conn'], "INSERT INTO husers (h_alias, h_author, h_avatar, h_center, h_code, h_created, h_email, h_gender, h_key, h_level, h_link, h_location, h_notes, h_password, h_phone, h_status, h_style, h_type, h_username) 
    VALUES ('".$h_alias."', '".$h_author."', '".$h_avatar."', '".$h_center."', '".$h_code."', '".$h_created."', '".$h_email."', '".$h_gender."', '".$h_key."', '".$h_level."', '".$h_link."', '".$h_location."', '".$h_notes."', '".$h_password."', '".$h_phone."', '".$h_status."', '".$h_style."', '".$h_type."', '".$h_username."')")) {
        header("Location: ./register?create=success");
      } else {
        header("Location: ./register?create=fail");
      }

} elseif (isset($_POST['resource'])) {
    # code...
} elseif (isset($_POST['request'])) {
    # code...
} else {
    include 'header.php'; ?>
<title>Register [ <?php getOption('name'); ?> ]</title>
<div style="padding-top:40px;" >
    <div id="login_div">
        <center><?php 
        if (isset($_GET['create'])) {
            if ($_GET['create'] == "success") { ?>
                <div id="success" class="alert mdl-color--green">
                    <span>Success!<br>Check your email for a confirmation link</span>
                </div><?php
            } elseif ($_GET['create'] == "fail") { ?>
            <div id="fail" class="alert mdl-color--red">
                <span>Oops!<br>We Ran Into A Problem. Please Try Again</span>
            </div><?php }
        } 
        frontlogo(); ?>
        </center>

        <center>
        <ul id="tabs-swipe-demo" style="border-radius: 5px;" class="tabs">
            <li class="tab col s3"><a class="active" href="#test-swipe-1">Create Account</a></li>
            <li class="tab col s3"><a href="#test-swipe-2">Add Resource</a></li>
            <li class="tab col s3"><a href="#test-swipe-3">Request Service</a></li>
        </ul>
        </center>

        <div id="test-swipe-1" class="col s12">
            <form name="registerUser" method="POST" action="">

            <div class="input-field">
            <i class="material-icons prefix">label</i>
            <input id="fname" name="fname" type="text">
            <label for="fname">First Name</label>
            </div>
                   
            <div class="input-field">
            <i class="material-icons prefix">label_outline</i>
            <input id="lname" name="lname" type="text">
            <label for="lname">Last Name</label>
            </div>

            <div class="input-field">
            <i class="material-icons prefix">mail</i>
            <input class="validate" id="email" name="h_email" type="email">
            <label for="email" data-error="Please enter a valid email" data-success="OK!" class="center-align">Email Address</label>
            </div>

            <div class="input-field">
            <i class="material-icons prefix">phone</i>
            <input  id="h_phone" name="h_phone" type="text">
            <label for="h_phone" data-error="wrong" data-success="right" class="center-align">Phone Number</label>
            </div>

            <div class="input-field">
            <i class="material-icons prefix">lock</i>
            <input id="password" name="h_password" type="text">
            <label for="password">Password</label>
            </div>

            <div class="input-field inline mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fullwidth">
                              <i class="material-icons prefix">perm_identity</i>
                               <input class="mdl-textfield__input" id="h_type" name="h_type" type="text" readonly tabIndex="-1" placeholder="<?php if (isset($_GET['create'])) {
                                 echo ucwords($_GET['create']);
                                } else {
                                  echo 'Type';
                                } ?>" />
                                 <ul class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php primaryColor($_SESSION['myCode']); ?>" for="h_type">
                                   <li class="mdl-menu__item" data-val="doctor">Doctor</li>
                                   <li class="mdl-menu__item" data-val="manager">Manager</li>
                                   <li class="mdl-menu__item" data-val="nurse">Nurse</li>
                                   <li class="mdl-menu__item" data-val="patient">Patient</li>
                                 </ul>
                              </div>

                            <div class="input-field mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                              <i class="material-icons prefix">room</i>
                            <input class="mdl-textfield__input" type="text" id="counties" name="h_location" readonly tabIndex="-1" placeholder="Location">
                            <ul for="counties" class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php primaryColor($_SESSION['myCode']); ?>" style="max-height: 250px !important; overflow-y: auto;">
                                <?php 
                                $county_list = "baringo, bomet, bungoma, busia, elgeyo-marakwet, embu, garissa, homa bay, isiolo, kakamega, kajiado, kapenguria, kericho, kiambu, kilifi, kirinyanga, kisii, kisumu, kitui, kwale, laikipia, lamu, machakos, makueni, mandera, marsabit, meru, migori, mombasa, muranga, nairobi, nakuru, nandi, narok, nyamira, nyandarua, nyeri, ol kalou, samburu, siaya, taita-taveta, tana river, tharaka-nithi, trans-nzoia, turkana, uasin-gishu, vihiga, wajir, west pokot";
                                $counties = explode(",", $county_list);
                                for ($c=0; $c < count($counties); $c++) {
                                    $label = ucwords($counties[$c]);
                                    echo '<li class="mdl-menu__item" data-val="'.$counties[$c].'">'.$label.'</li>';
                                }
                                 ?>
                            </ul>
                            </div>

            <div class="input-field inline">
            <i class="material-icons prefix">local_hospital</i>
            <input id="h_center" name="h_center" type="text">
            <label for="h_center">Center</label>
            </div>

            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" name="create"><i class="material-icons">send</i> CREATE ACCOUNT</button>

            <br>
            </form>
        </div>

        <div id="test-swipe-2" class="col s12">
            <form name="registerResource" method="POST" action="">
            <div class="input-field">
            <i class="mdi-social-person-outline prefix"></i>
            <input class="validate" id="email" name="h_email" type="email">
            <label for="email" data-error="wrong" data-success="right" class="center-align">Enter Your Email</label>
            </div>

            <div class="input-field">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="fname" name="fname" type="text">
            <label for="fname">Your Name</label>
            </div>
                   
            <div class="input-field">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="lname" name="lname" type="text">
            <label for="lname">Resource Name</label>
            </div>

            <div class="input-field">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="h_type" name="h_type" type="text">
            <label for="h_type">Type</label>
            </div>

            <div class="input-field">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="h_center" name="h_center" type="text">
            <label for="h_center">Center</label>
            </div>

            <input type="hidden" name="register"/>

            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" name="register">REGISTER RESOURCE</button>

            <br>
            </form>
        </div>


        <div id="test-swipe-3" class="col s12">
            <form name="registerService" method="POST" action="">
            <div class="input-field">
            <i class="mdi-social-person-outline prefix"></i>
            <input class="validate" id="email" name="h_email" type="email">
            <label for="email" data-error="wrong" data-success="right" class="center-align">Email Address</label>
            </div>

            <div class="input-field">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="fname" name="fname" type="text">
            <label for="fname">First Name</label>
            </div>
                   
            <div class="input-field">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="lname" name="lname" type="text">
            <label for="lname">Last Name</label>
            </div>

            <div class="input-field">
            <i class="mdi-action-lock-outline prefix"></i>
            </div>

            <div class="input-field">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="h_center" name="h_center" type="text">
            <label for="h_center">Center</label>
            </div>

            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" name="request">REQUEST SERVICE</button>
            <br>
            </form>
        </div>
    </div>   
</div><?php
    include 'footer.php';
} ?>
