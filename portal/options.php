<?php

include './header.php';


if (isset($_POST['mystyle'])) {
    $theme = mysqli_real_escape_string($GLOBALS['conn'], $_POST['theme']);
    mysqli_query($GLOBALS['conn'], "UPDATE husers SET h_style = '".$theme."'");
}

if (isset($_POST['preferences'])) {
    $date = date(Ymd);
    mysqli_query($GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['name']."', h_updated = '".$date."' WHERE h_code='name'");
    mysqli_query($GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['description']."', h_updated = '".$date."'  WHERE h_code='description'");
    mysqli_query($GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['email']."', h_updated = '".$date."'  WHERE h_code='email'");
    mysqli_query($GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['copyright']."', h_updated = '".$date."'  WHERE h_code='copyright'");
    mysqli_query($GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['header_logo']."', h_updated = '".$date."'  WHERE h_code='header_logo'");
    mysqli_query($GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['home_logo']."', h_updated = '".$date."'  WHERE h_code='home_logo'");
    mysqli_query($GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['tos']."', h_updated = '".$date."'  WHERE h_code='tos'");
}

if (isset($_GET['page'])) {
    if ($_GET['page'] == "general") {
        ?><title>General Site Options [ <?php getOption('name'); ?> ]</title>
        <div class="mdl-grid" >

        <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor($_SESSION['myCode']); ?>">
        <div class=" mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
        <form name="optionForm" method="POST" action="">

                <div class="input-field">
                    <input id="name" type="text" name="name" value="<?php getOption('name'); ?>">
                    <label for="name" data-error="wrong" data-success="right" class="center-align">Site Name </label>
                </div>

                <div class="input-field">
                    <textarea id="description" name="description" cols="3" ><?php getOption("description"); ?></textarea>
                    <label for="description" data-error="wrong" data-success="right" class="center-align">Site Description </label>
                </div>

                <div class="input-field">
                    <input id="email" type="text" name="email" value="<?php getOption('email'); ?>">
                    <label for="email" data-error="wrong" data-success="right" class="center-align">Admin Email </label>
                </div>

                <div class="input-field">
                    <input id="copyright" type="text" name="copyright" value="<?php getOption('copyright'); ?>">
                    <label for="copyright" data-error="wrong" data-success="right" class="center-align">Footer Copyright </label>
                </div>

        </div>

        <div class=" mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-grid">
        <script>
           function chooseHeader() {
              $("#header_logo").click();
           }

           function chooseHome() {
              $("#home_logo").click();
           }
        </script>

                <div class="input-field inline mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp">
                    <div style="height:0px;overflow:hidden">
                        <input id="header_logo" type="file" name="header_logo" value="<?php getOption('header_logo'); ?>">
                    </div>
                    <img src="<?php show( hIMAGES."logo.png" ); ?>" width="75%" onclick="chooseHeader();">
                    <label for="header_logo" data-error="wrong" data-success="right" class="center-align">Header Logo (100x80px) <span><i class="material-icons">edit</i></span></label>
                </div>

                <div class="input-field inline mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp">
                    <div style="height:0px;overflow:hidden">
                    <input id="home_logo" type="file" name="home_logo" value="<?php getOption("home_logo"); ?>">
                    </div>
                    <img src="<?php show( hIMAGES."logo.png" ); ?>" width="100%" onclick="chooseHome();">
                    <label for="home_logo" data-error="wrong" data-success="right">Home Logo (250x80px) <span><i class="material-icons">edit</i></span></label>
                </div>

        </div>
        </div>

        <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor($_SESSION['myCode']); ?>">
            <div class=" mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">

                <div class="input-field">
                    <textarea id="h_tos" name="tos" cols="3" ><?php getOption('tos'); ?></textarea>
                            <script>CKEDITOR.replace( "h_tos" );</script>
                    <label for="h_tos" data-error="wrong" data-success="right" class="center-align">Terms of Service </label>
                </div>
                <br>
                <button class="mdl-button mdl-button--fab" type="submit" name="preferences"><i class="material-icons">save</i></button>
            </div>
        </form>
        </div>
            <?php
        ?> </div>
    <?php
    } elseif ($_GET['page'] == "shop") {
        ?><title>Shop Options [ <?php getOption('name'); ?> ]</title>
        <div class="mdl-grid" >

        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card">
        <div class=" mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">
        <form name="optionForm" method="POST" action="" class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor($_SESSION['myCode']); ?>">
        <div class="mdl-card__title">
        <i class="mdi mdi-cellphone"></i>
          <span class="mdl-button">M-PESA Settings</span>
        </div>
        <div class="mdl-card__supporting-text mdl-card--expand">
                <span><b>Required Fields Are Marked *</b></span><br>

                <div class="input-field">
                    <input id="merchant" type="text" name="merchant" value="<?php getOption('name'); ?>">
                    <label for="merchant" data-error="wrong" data-success="right" class="center-align">Merchant Name *</label>
                </div>

                <div class="input-field">
                    <input id="endpoint" type="text" name="endpoint" value="<?php show( hROOT.'callback' ); ?>">
                    <label for="endpoint" data-error="wrong" data-success="right" class="center-align">Callback URL *</label>
                </div>

                <div class="input-field">
                    <input id="paybill" type="text" name="paybill" value="<?php getOption('paybill'); ?>">
                    <label for="paybill" data-error="wrong" data-success="right" class="center-align">Paybill Number *</label>
                </div>

                <div class="input-field">
                    <input id="timestamp" type="text" name="timestamp" value="<?php getOption('timestamp'); ?>">
                    <label for="timestamp" data-error="wrong" data-success="right" class="center-align">Timestamp *</label>
                </div>

                <div class="input-field">
                    <input id="sag" type="text" name="sag" value="<?php getOption('sag'); ?>">
                    <label for="sag" data-error="wrong" data-success="right" class="center-align">SAG Password *</label>
                </div>

                <input type="hidden" name="endpoint" value="https://safaricom.co.ke/mpesa_online/lnmo_checkout_server.php?wsdl">
                <input type="hidden" name="method" value="POST">

                <br>
                <button class="mdl-button mdl-button--fab" type="submit" name="mpesa"><i class="material-icons">save</i></button>
        </div>
        </form>
        </div>
        <br>
        <div class=" mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">
        <form name="optionForm" method="POST" action="" class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor($_SESSION['myCode']); ?>">
        <div class="mdl-card__title">
        <i class="fa fa-paypal"></i>
          <span class="mdl-button">Paypal Settings</span>
        </div>
        <div class="mdl-card__supporting-text mdl-card--expand">

                <div class="input-field inline">
                    <input id="name" type="email" name="name" value="<?php getOption('email'); ?>">
                    <label for="name" data-error="wrong" data-success="right" class="center-align">Paypal Email </label>
                </div>

                <div class="input-field inline">
                <button class="mdl-button mdl-button--fab" type="submit" name="paypal"><i class="material-icons">save</i></button>
                </div>

        </div>
        </form>

        <br>

        <form name="optionForm" method="POST" action="" class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor($_SESSION['myCode']); ?>">
        <div class="mdl-card__title">
        <i class="fa fa-cc-stripe"></i>
          <span class="mdl-button">Stripe Settings</span>
        </div>
        <div class="mdl-card__supporting-text mdl-card--expand">

                <div class="input-field inline">
                    <input id="name" type="email" name="name" value="<?php getOption('email'); ?>">
                    <label for="name" data-error="wrong" data-success="right" class="center-align">Stripe Email </label>
                </div>
                
                <div class="input-field inline">
                <button class="mdl-button mdl-button--fab" type="submit" name="stripe"><i class="material-icons">save</i></button>
                </div>
        </div>
        </form>

        <br>

        <form name="optionForm" method="POST" action="" class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor($_SESSION['myCode']); ?>">
        <div class="mdl-card__title">
        <i class="fa fa-cc-stripe"></i>
          <span class="mdl-button">Stripe Settings</span>
        </div>
        <div class="mdl-card__supporting-text mdl-card--expand">

                <div class="input-field inline">
                    <input id="name" type="email" name="name" value="<?php getOption('email'); ?>">
                    <label for="name" data-error="wrong" data-success="right" class="center-align">Stripe Email </label>
                </div>
                
                <div class="input-field inline">
                <button class="mdl-button mdl-button--fab align-right" type="submit" name="stripe"><i class="material-icons">save</i></button>
                </div>
        </div>
        </form>
        </div>

        </div>
        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor($_SESSION['myCode']); ?>">
                        <div class="mdl-card__title">
                        <i class="material-icons">info_outline</i>
                          <span class="mdl-button">Shop Settings Help</span>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                        <ul class="collapsible popout" data-collapsible="accordion">
                        <li>
                          <div class="collapsible-header active"><i class="material-icons">message</i>Setting Up M-PESA</div>
                          <div class="collapsible-body">
                          <span><b>Required Constants</b></span>
                            <ul>
                                <li>Paybill Number</li>
                                <li>Paybill Number</li>
                                <li>Get Paybill Number</li>
                                <li>Get Paybill Number</li>
                                <li>Get Paybill Number</li>
                            </ul>
                            <span>More details can be found on <a href="https://safaricom.co.ke">Safaricom's website.</a></span>
                          </div>
                        </li>
                        <li>
                          <div class="collapsible-header"><i class="fa fa-paypal"></i>Paypal Settings</div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                          <div class="collapsible-header"><i class="material-icons">chat_bubble</i>M-PESA Settings</div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                          <div class="collapsible-header"><i class="material-icons">description</i>M-PESA Settings</div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                      </ul>
                        </div>
                    </div>
                </div>
        </div><?php
    } elseif ($_GET['page'] == "color") {

        function isTheme ($theme) {
            $themes = mysqli_query($GLOBALS['conn'], "SELECT h_style FROM husers WHERE h_code = '".$_SESSION['myCode']."'");
            if ($themes -> num_rows > 0) {
                while ($mytheme = mysqli_fetch_assoc($themes)) {
                    if ($theme == $mytheme['h_style']) {
                        echo 'checked';
                    }
                }
            }
        }
?>
    <title>Theme Color Options [ <?php getOption('name'); ?> ]</title>
    <div class="mdl-grid mdl-cell mdl-cell--12-col" >
        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor($_SESSION['myCode']); ?>">
        	<div class=" mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
        		<style type="text/css">
                .cholder {
                    display: inline-flex;
                    }

                .ccolor {
                    height: 30px;
                    width: 50px;
                    border-radius: 8%;
                    border: white 1px solid;
                }

                .clabel {
                    padding-left: 20px;
                }

                </style>

                <h4>Select Theme</h4>
                <form name="themeForm" method="POST" action="">

                    <div class="input-field inline">
                        <input type="radio" id="zahra" name="theme" value="zahra" <?php isTheme ('zahra'); ?>>
                        <label for="zahra"><p class="cholder" for="zahra">
                            <span class="ccolor mdl-color--teal"></span><span class="ccolor csec mdl-color--red"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="zahra">Zahra's Fade</div>

                    <div class="input-field inline">
                        <input type="radio" id="love" name="theme" value="love" <?php isTheme ('love'); ?>>
                        <label for="love"><p class="cholder" for="love">
                            <span class="ccolor mdl-color--cyan"></span><span class="ccolor csec mdl-color--pink"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="love">Love, Olive</div>

                    <div class="input-field inline">
                        <input type="radio" id="wizz" name="theme" value="wizz" <?php isTheme ('wizz'); ?>>
                        <label for="wizz"><p class="cholder" for="wizz">
                            <span class="ccolor mdl-color--yellow"></span><span class="ccolor csec mdl-color--black"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="wizz">The Wizz</div>

                    <div class="input-field inline">
                        <input type="radio" id="pint" name="theme" value="pint" <?php isTheme ('pint'); ?>>
                        <label for="pint"><p class="cholder" for="pint">
                            <span class="ccolor mdl-color--blue"></span><span class="ccolor csec mdl-color--pink"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="pint">The Bluepint</div>

                    <div class="input-field inline">
                        <input type="radio" id="stack" name="theme" value="stack" <?php isTheme ('stack'); ?>>
                        <label for="stack"><p class="cholder" for="stack">
                            <span class="ccolor mdl-color--grey"></span><span class="ccolor csec mdl-color--brown"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="stack">Needle in a Haystack</div>

                    <div class="input-field inline">
                        <input type="radio" id="indie" name="theme" value="indie" <?php isTheme ('indie'); ?>>
                        <label for="indie"><p class="cholder" for="indie">
                            <span class="ccolor mdl-color--indigo"></span><span class="ccolor csec mdl-color--brown"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="indie">Indie Go</div>

                    <div class="input-field inline">
                        <input type="radio" id="haze" name="theme" value="haze" <?php isTheme ('haze'); ?>>
                        <label for="haze"><p class="cholder" for="haze">
                            <span class="ccolor mdl-color--purple"></span><span class="ccolor csec mdl-color--green"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="haze">Purple Haze</div>

                    <div class="input-field inline">
                        <input type="radio" id="hot" name="theme" value="hot" <?php isTheme ('hot'); ?>>
                        <label for="hot"><p class="cholder" for="hot">
                            <span class="ccolor mdl-color--red"></span><span class="ccolor csec mdl-color--blue"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="hot">Red Host</div>

                    <div class="input-field inline">
                        <input type="radio" id="princess" name="theme" value="princess" <?php isTheme ('princess'); ?>>
                        <label for="princess"><p class="cholder" for="princess">
                            <span class="ccolor mdl-color--pink"></span><span class="ccolor csec mdl-color--blue"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="princess">Princess Zahra</div>

                    <div class="input-field inline">
                        <input type="radio" id="sky" name="theme" value="sky" <?php isTheme ('sky'); ?>>
                        <label for="sky"><p class="cholder" for="sky">
                            <span class="ccolor mdl-color--light-blue"></span><span class="ccolor csec mdl-color--brown"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="sky">Blue Sky</div>

                    <div class="input-field inline">
                        <input type="radio" id="greene" name="theme" value="greene" <?php isTheme ('greene'); ?>>
                        <label for="greene"><p class="cholder" for="greene">
                            <span class="ccolor mdl-color--green"></span><span class="ccolor csec mdl-color--red"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="greene">Green E</div>

                    <div class="input-field inline">
                        <input type="radio" id="vegan" name="theme" value="vegan" <?php isTheme ('vegan'); ?>>
                        <label for="vegan"><p class="cholder" for="vegan">
                            <span class="ccolor mdl-color--light-green"></span><span class="ccolor csec mdl-color--brown"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="vegan">Vegan</div>

                    <div class="input-field inline">
                        <input type="radio" id="lemon" name="theme" value="lemon" <?php isTheme ('lemon'); ?>>
                        <label for="lemon"><p class="cholder" for="lemon">
                            <span class="ccolor mdl-color--lime"></span><span class="ccolor csec mdl-color--brown"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="lemon">Life's Lemons</div>

                    <div class="input-field inline">
                        <input type="radio" id="wait" name="theme" value="wait" <?php isTheme ('wait'); ?>>
                        <label for="wait"><p class="cholder" for="wait">
                            <span class="ccolor mdl-color--amber"></span><span class="ccolor csec mdl-color--brown"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="wait">Wait A Minute</div>

                    <div class="input-field inline">
                        <input type="radio" id="orange" name="theme" value="orange" <?php isTheme ('wait'); ?>>
                        <label for="orange"><p class="cholder" for="orange">
                            <span class="ccolor mdl-color--orange"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="orange">Orange Tan</div>

                    <div class="input-field inline">
                        <input type="radio" id="sun" name="theme" value="sun" <?php isTheme ('sun'); ?>>
                        <label for="sun"><p class="cholder" for="sun">
                            <span class="ccolor mdl-color--deep-orange"></span><span class="ccolor csec mdl-color--cyan"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="sun">Orange Sun</div>

                    <div class="input-field inline">
                        <input type="radio" id="earth" name="theme" value="earth" <?php isTheme ('earth'); ?>>
                        <label for="earth"><p class="cholder" for="earth">
                            <span class="ccolor mdl-color--brown"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="earth">Down To Earth</div>
                    

                    <div class="input-field inline">
                        <input type="radio" id="ghost" name="theme" value="ghost" <?php isTheme ('ghost'); ?>>
                        <label for="ghost"><p class="cholder" for="ghost">
                            <span class="ccolor mdl-color--blue-grey"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="ghost">Ghosting Blues</div>
                    

                    <div class="input-field inline">
                        <input type="radio" id="zebra" name="theme" value="zebra" <?php isTheme ('zebra'); ?>>
                        <label for="zebra"><p class="cholder" for="zebra">
                            <span class="ccolor mdl-color--white"></span><span class="ccolor csec mdl-color--black"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="zebra">Zebra's Cross</div>
                    

                    <div class="input-field inline">
                        <input type="radio" id="prince" name="theme" value="prince" <?php isTheme ('prince'); ?>>
                        <label for="prince"><p class="cholder" for="prince">
                            <span class="ccolor mdl-color--deep-purple"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="prince">Dark Prince</div>
                    

                    <div class="input-field"><br>
                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" type="submit" name="mystyle" style="float:right;"><i class="material-icons">save</i></button>
                    </div>
                </form>
        	</div>
            <div class=" mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
                <h4>Custom Styling</h4>

                <form name="themeForm" method="POST" action="" class="">

                    <div class="input-field">
                        <input id="secondary" type="text" name="secondary">
                        <label for="secondary" data-error="wrong" data-success="right" class="center-align">Accent Color </label>
                    </div>

                    <div class="input-field">
                        <input id="textp" type="text" name="textp">
                        <label for="textp" data-error="wrong" data-success="right" class="center-align">Text Primary Color </label>
                    </div>

                    <div class="input-field">
                        <input id="texts" type="text" name="texts">
                        <label for="texts" data-error="wrong" data-success="right" class="center-align">Text Secondary Color </label>
                    </div>

                    <div class="input-field">
                        <textarea id="customs" name="customs" cols="3" ></textarea>
                        <label for="customs" data-error="wrong" data-success="right" class="center-align">Custom CSS </label>
                    </div>

                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" type="submit" name="custom" style="float:right;"><i class="material-icons">save</i></button>
                </form>
            </div>
        </div>

        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-grid mdl-shadow--2dp mdl-color--<?php primaryColor($_SESSION['myCode']); ?>">
            <div class="mdl-cell mdl-cell--12-col mdl-card">
                <div class="mdl-card__title">
                    <div class="mdl-card__title-text">
                        Color Palette
                    </div>
                </div>
                <div class="mdl-card_supporting-text"><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--red"></span><span class="clabel"> Red</span><span class="clabel"> ( red )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--pink"></span><span class="clabel"> Pink</span><span class="clabel"> ( pink )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--purple"></span><span class="clabel"> Purple</span><span class="clabel"> ( purple )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--deep-purple"></span><span class="clabel"> Deep Purple</span><span class="clabel"> ( deep-purple )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--indigo"></span><span class="clabel"> Indigo</span><span class="clabel"> ( indigo )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--blue"></span><span class="clabel"> Blue</span><span class="clabel"> ( blue )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--light-blue"></span><span class="clabel"> Light Blue</span><span class="clabel"> ( light-blue )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--cyan"></span><span class="clabel"> Cyan</span><span class="clabel"> ( cyan )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--teal"></span><span class="clabel"> Teal</span><span class="clabel"> ( teal )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--green"></span><span class="clabel"> Green</span><span class="clabel"> ( green )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--light-green"></span><span class="clabel"> Light Green</span><span class="clabel"> ( light-green )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--lime"></span><span class="clabel"> Lime</span><span class="clabel"> ( green )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--yellow"></span><span class="clabel"> Yellow</span><span class="clabel"> ( yellow )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--amber"></span><span class="clabel"> Amber</span><span class="clabel"> ( amber )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--orange"></span><span class="clabel"> Orange</span><span class="clabel"> ( orange )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--deep-orange"></span><span class="clabel"> Deep Orange</span><span class="clabel"> ( deep-orange )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--brown"></span><span class="clabel"> Brown</span><span class="clabel"> ( brown )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--grey"></span><span class="clabel"> Grey</span><span class="clabel"> ( grey )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--blue-grey"></span><span class="clabel"> Blue Grey</span><span class="clabel"> ( blue-grey )</span>
                    </p><br>
                </div>
            </div>
        </div>
    </div>
<?php
    }
}

include './footer.php';