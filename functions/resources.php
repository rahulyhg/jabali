<?php

class _hResources {
  var $h_alias; 
  var $h_author; 
  var $h_avatar; 
  var $h_category; 
  var $h_center; 
  var $h_code; 
  var $h_created; 
  var $h_custom; 
  var $h_desc; 
  var $h_email; 
  var $h_fav; 
  var $h_key; 
  var $h_level; 
  var $h_link; 
  var $h_location; 
  var $h_notes; 
  var $h_phone; 
  var $h_reading; 
  var $h_status; 
  var $h_style; 
  var $h_subtitle; 
  var $h_tags; 
  var $h_text; 
  var $h_type; 
  var $h_updated;


  function loginUser() {
  $user = $_POST['user'];
  $password = $_POST['password'];

  $conn = mysqli_connect( hDBHOST, hDBUSER, hDBPASS, hDBNAME );
  $sql = 'SELECT * FROM hUsers WHERE h_email='.$user.'';//OR h_username= '..$user.'';
    $result = mysqli_query($conn, $sql);
    if( $result->num_rows > 0 ) {
      while ($row = mysqli_fetch_assoc($result)) {

        if ($password = $row['h_password']) {
          $_SESSION['myAlias'] = $row['h_alias'];
          $_SESSION['myUsername'] = $row['h_username'];
          $_SESSION['myCode'] = $row['h_code'];
          $_SESSION['myEmail'] = $row['h_email'];
          $_SESSION['myCenter'] = $row['h_center'];
          $_SESSION['myCap'] = $row['h_cap'];
          $_SESSION['myLocation'] = $row['h_location'];
          $_SESSION['myAvatar'] = $row['h_avatar'];

          header('Location: ./portal/user?view='.$_SESSION['myCode'].'');
          exit();

        } else {
          echo "Wrong Password";
        }
      }

    } else {
      echo '<div>
      <p>User Does not exist</p>
      </div>';
    }
 }
  
 function emailUser($email, $subject, $key) {
   if($subject == "create") {
   } elseif($subject == "confirm") {
   } elseif($subject == "forgot") {
   } elseif($subject == "reset") {
   }
 }
  
  function createUser() {

    $date = date("YmdHms");
    if (isset($_SESSION['myEmail'])) {
      $email = $_SESSION['myEmail'];
    } else {
      $email = hEMAIL;
    }

    $h_alias = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_alias']); 
    $h_author = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_author']); 
    $h_avatar = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_avatar']); 
    $h_category = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_category']); 
    $h_center = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_center']);
    $h_key = str_shuffle(md5($email.$date));
    $h_code = substr($h_key, rand(0, 15), 16); 
    $h_created = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_created']); 
    $h_custom = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_custom']); 
    $h_desc = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_desc']); 
    $h_email = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_email']); 
    $h_fav = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_fav']); 
    $h_level = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_level']); 
    $h_link = hPORTAL."user?view=$h_key&action=view"; 
    $h_location = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_location']); 
    $h_notes = substr($h_desc, 250); 
    $h_phone = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_phone']); 
    $h_reading = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_reading']); 
    $h_status = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_status']); 
    $h_style = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_style']); 
    $h_subtitle = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_subtitle']); 
    $h_tags = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_tags']); 
    $h_text = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_text']); 
    $h_type = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_type']); 
    $h_updated = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_updated']);

    $createUser = mysqli_query($GLOBALS['conn'], "INSERT INTO husers (h_alias, h_author, h_avatar, h_category, h_center, h_code, h_created, h_custom, h_desc, h_email, h_fav, h_key, h_level, h_link, h_location, h_notes, h_phone, h_reading, h_status, h_style, h_subtitle, h_tags, h_text, h_type, h_updated) 
      VALUES ('".$h_alias."', '".$h_author."', '".$h_avatar."', '".$h_category."', '".$h_center."', '".$h_code."', '".$h_created."', '".$h_custom."', '".$h_desc."', '".$h_email."', '".$h_fav."', '".$h_key."', '".$h_level."', '".$h_link."', '".$h_location."', '".$h_notes."', '".$h_phone."', '".$h_reading."', '".$h_status."', '".$h_style."', '".$h_subtitle."', '".$h_tags."', '".$h_text."', '".$h_type."', '".$h_updated."'");
    // if (!$createUser ->conn_error) {
    //   echo '<div><p>User Created Successfuly!</p></div>';
    // } else {
    //   echo '<div><p>Error!</p>'.$createUser ->conn_error.'</div>';
    // }
  }

  function updateUser($h_code) {
    
    $date = date("YmdHms");
    if (isset($_SESSION['myEmail'])) {
      $email = $_SESSION['myEmail'];
    } else {
      $email = hEMAIL;
    }

    $h_alias = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_alias']); 
    $h_author = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_author']); 
    $h_avatar = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_avatar']); 
    $h_category = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_category']); 
    $h_center = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_center']);
    $h_key = strshuffle(md5($email.$date)); 
    $h_code = substr($h_key, rand(0, 15), 16); 
    $h_created = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_created']); 
    $h_custom = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_custom']); 
    $h_desc = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_desc']); 
    $h_email = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_email']); 
    $h_fav = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_fav']); 
    $h_level = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_level']); 
    $h_link = hPORTAL."user?view=$h_key&action=view"; 
    $h_location = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_location']); 
    $h_notes = subst($h_desc, 250); 
    $h_phone = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_phone']); 
    $h_reading = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_reading']); 
    $h_status = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_status']); 
    $h_style = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_style']); 
    $h_subtitle = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_subtitle']); 
    $h_tags = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_tags']); 
    $h_text = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_text']); 
    $h_type = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_type']); 
    $h_updated = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_updated']);    

    $updateUser = mysqli_query($GLOBALS['conn'], "UPDATE husers SET h_var='".$h_var."', h_var='".$h_var."' WHERE h_code='".$h_code."'");
    // if (!$updateUser ->conn_error) {
    //   echo '<div><p>User Created Successfuly!</p></div>';
    // } else {
    //   echo '<div><p>Error!</p>'.$updateUser ->conn_error.'</div>';
    // }
  }

  
  function deleteUser($h_code) {
    
    $deleteUser = mysqli_query($GLOBALS['conn'], "DELETE FROM husers WHERE h_code='".$h_code."'");
    if (!$createUser ->conn_error) {
      echo '<div><p>User Created Successfuly!</p></div>';
    } else {
      echo '<div><p>Error!</p>'.$deleteUser ->conn_error.'</div>';
    }
  }

  function getUsersBySort($by, $sort) {
    $getUsersBySort = mysqli_query($GLOBALS['conn'], "SELECT * FROM husers WHERE h_status = 'active' AND h_".$by." = '".$sort."' ORDER BY h_created DESC");
    if($getUsersBySort -> num_rows > 0) {
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">CODE</th>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
      while ($usersDetails = mysqli_fetch_assoc($getUsersBySort)){
        echo '
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">'
        .$usersDetails['h_code']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$usersDetails['h_username']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$usersDetails['h_email']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$usersDetails['h_center']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$usersDetails['h_location']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric"><a href="" ><i class="material-icons">phone</i></a> <a href="" ><i class="material-icons">message</i></a>  <a href="" ><i class="material-icons">edit</i></a> <a href="" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody>';
      } echo '
        </table></div>';
    } else {
      echo 'No Users Found';
    }
  }

  function getUsersType($type) {
      echo "<title>".ucfirst($type)."s List [ <?php getOption('name'); ?> ]</title>";
    $getUsersBy = mysqli_query($GLOBALS['conn'], "SELECT * FROM husers WHERE h_status = 'active' AND h_type='".$type."'");
    if($getUsersBy -> num_rows > 0) {
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
      while ($usersDetails = mysqli_fetch_assoc($getUsersBy)){
        echo '
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">'
        .$usersDetails['h_username']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$usersDetails['h_email']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$usersDetails['h_phone']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$usersDetails['h_center']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$usersDetails['h_location']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./user?view='.$usersDetails['h_code']. '" ><i class="material-icons">account_circle</i></a> <a href="tel:'.$usersDetails['h_phone']. '" ><i class="material-icons">phone</i></a> <a href="?user?view='.$_SESSION['myCode']. '&action=chat&by='.$usersDetails['h_code']. '" ><i class="material-icons">message</i></a>  <a href="./user?view='.$usersDetails['h_code']. '&action=edit" ><i class="material-icons">edit</i></a> <a href="./user?view='.$usersDetails['h_code']. '&action=delete" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody>';
      } echo '
        </table></div>';
    } else {
        echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
        echo '
        <tbody>
        <tr>
        <td><p>No '.ucfirst($type).'s Found</p></td>
        </tr>
        </tbody>';
         echo '
        </table></div>';
    }
  }

  function getUsers() {
      echo "<title>All Users [ <?php getOption('name'); ?> ]</title>";
    $getUsers = mysqli_query($GLOBALS['conn'], "SELECT * FROM husers WHERE h_status = 'active' ORDER BY h_created DESC");
    if($getUsers -> num_rows > 0) {
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
      while ($usersDetails = mysqli_fetch_assoc($getUsers)){
        echo '
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">'
        .$usersDetails['h_username']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$usersDetails['h_email']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$usersDetails['h_phone']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$usersDetails['h_center']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$usersDetails['h_location']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./user?view='.$usersDetails['h_code']. '" ><i class="material-icons">account_circle</i></a> <a href="tel:'.$usersDetails['h_phone']. '" ><i class="material-icons">phone</i></a> <a href="?user?view='.$_SESSION['myCode']. '&action=chat&by='.$usersDetails['h_code']. '" ><i class="material-icons">message</i></a>  <a href="./user?view='.$usersDetails['h_code']. '&action=edit" ><i class="material-icons">edit</i></a> <a href="./user?view='.$usersDetails['h_code']. '&action=delete" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody>';
      } echo '
        </table></div>';
    } else {
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
        echo '
        <tbody>
        <tr>
        <p>No Users Found</p>
        </tr>
        </tbody>';
         echo '
        </table></div>';
    }
  }

  function getUserCode($code) {
    $getUserCode = mysqli_query($GLOBALS['conn'], "SELECT * FROM husers WHERE h_code = '".$code."'");
    if($getUserCode -> num_rows > 0) {
      while ($userDetails = mysqli_fetch_assoc($getUserCode)){
        if ($_SESSION['myCode'] !== $userDetails['h_code']) {
          $greettype = 'Contact Details';
        } else {
          $name = explode(" ", $_SESSION['myAlias']);
          $greettype = '<b>Hello,</b> '.ucfirst($name[0]);
        }
        echo '<title>'.$userDetails['h_alias'].' [ '.getOption('name').' ]</title>';
        echo '<div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">'.ucfirst($userDetails['h_type']).' '.$userDetails['h_alias'].'</h2>

                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                                <a href="./user?view='.$userDetails['h_code'].'&fav='.$userDetails['h_code'].'" class="material-icons mdl-badge mdl-badge--overlap" data-badge="'.$userDetails['h_fav'].'">star</a>
                                <a href="./user?edit='.$userDetails['h_code'].'" ><i class="material-icons">edit</i></a>
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <h5> '.$greettype.'<h5>
                            <h6><b>Email:</b> <a href="mailto:'.$userDetails['h_email'].'">'.$userDetails['h_email'].'</a><br>
                            <b>Center:</b> <a href="./resource?center='.$userDetails['h_center'].'">'.$userDetails['h_center'].'</a><br>
                            <b>Location:</b> <a href="./resource?location='.$userDetails['h_location'].'">'.$userDetails['h_location'].'</a><br>
                            <b>Phone:</b> <a href="tel:'.$userDetails['h_phone'].'">'.$userDetails['h_phone'].'</a></h6>
                            
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
                            <img src="'.$userDetails['h_avatar'].'" width="100%">
                          </div>

                          <div><h6><b>Bio:</b> </h6>'.$userDetails['h_description'].'</div><br><br>
                          <div><h6><b>Joined:</b> '.$userDetails['h_created'].'</h6></div>
                        </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title">
                        <i class="material-icons">local_hospital</i>
                          '.$userDetails['h_center'].'
                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text mdl-button">
                                <i class="material-icons">person_pin_circle</i>
                                '.$userDetails['h_location'].'
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                            Notifications and latest chats go here
                        </div>
                    </div>
                </div>

                </div>';
      }
    } else {
      echo 'User Not Found';
    }
  }
 
}