<?php  
include '../inc/config.php';
include '../inc/jabali.php';
include './header.php';

$jJson = file_get_contents( hROOT."/package.json" );
$jD = json_decode( $jJson, true );
$curr_version = $jD['version'];

$nJson = file_get_contents( "http://jabali.mauko.co.ke/package.json" );
$nJD = json_decode( $nJson, true );
$new_version = $nJD['version']; ?>
<title>Update Jabali [ <?php showOption( 'name' ); ?> ]</title>

<?php if( isset( $_GET['new'] ) ) {
	$xZip = fopen( hABS."uploads/temp/jabali.zip", "w" );
    if ( $xZip) {
      file_put_contents( $xZip, fopen( "http://code.mauko.co.ke/dl/jabali.zip", "r" ) );
    }

    $install = new ZipArchive();
    $xT = $install -> open( $xZip );

    if ( $xT === TRUE ) {
      $install -> extractTo( hABS );
      $install -> close();
    } else {
      echo "Error Updating Jabali!";
    }
} ?>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
		<?php if ( $curr_version == $new_version) {
			echo '<center><h3>You have the latest Version of Jabali</h3><img src="'.hIMAGES.'404.jpg" width="500px"><h5>You don\'t have to do anything else</h5></center>';
		} elseif ( $curr_version > $new_version) {
			echo $curr_version."<br>";
			echo $new_version;
			echo "You are using a development Version of Jabali. <br>
			Found some bugs? Tell us!";
		} elseif ( $curr_version < $new_version) { ?>
		<div class="mdl-card__title">
	      <span class="mdl-card__title-text">Jabali <?php _show_( $new_version ); ?> is Available!</span>
	        <div class="mdl-layout-spacer"></div>
	        <div class="mdl-card__subtitle-text mdl-button mdl-button--icon">
	            <a id="updatenow" href="./update?new=true">
	            	<i class="material-icons">system_update_alt</i>
	            </a><div class="mdl-tooltip" for="updatenow">Update Now</div>
	        </div><div class="mdl-card__subtitle-text mdl-button mdl-button--icon">
	            <a id="dlnow" href="<?php _show_( $nJD['download'] ); ?>">
	            	<i class="material-icons">file_download</i>
	            </a><div class="mdl-tooltip" for="dlnow">Download Jabali</div>
	        </div>
	    </div>
	    <div class="mdl-card__supporting-text">
	        <ul class="collapsible popout" data-collapsible="accordion">
	            <li>
	              <div class="collapsible-header active"><i class="material-icons">label</i>
	                  <b>CHANGELOG</b><a class="alignright" href="<?php _show_( $nJD['website'] ); ?>">
	            	<i class="material-icons">open_in_new</i>
	            </a>
	              </div>
	              <div class="collapsible-body">
	              <?php _show_( $nJD['description'] ); ?>
	              </div>
	            </li>
	            <li>
	              <div class="collapsible-header"><i class="material-icons">label_outline</i>
	                  <b>CONTRIBUTORS</b>
	              </div>
	              <div class="collapsible-body mdl-grid"><div class="mdl-cell">
	              <p>Lead Dev: <?php _show_( $nJD['author'] ); ?></p>
	              <a class="fa fa-facebook" href="<?php _show_( $nJD['social']['facebook'] ); ?>"></a>
	              <a class="fa fa-twitter" href="<?php _show_( $nJD['social']['twitter'] ); ?>"></a>
	              <a class="fa fa-github" href="<?php _show_( $nJD['social']['github'] ); ?>"></a>
	              <a class="fa fa-envelope" href="mailto:<?php _show_( $nJD['social']['email'] ); ?>"></a>
	              </div></div>
	            </li>
	      </ul>
	    </div><?php 
		} ?>
	</div>

</div><?php 
include './footer.php';
?>