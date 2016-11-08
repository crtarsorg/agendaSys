<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3"> <br><br>
<?php
if(!defined('Installer')) {die('Direct access not permitted');}

if($_POST['action']=="newconfig"){createConfig();}

if (file_exists("admin/config.php")) { checkConn(); } else  { startInstaller(); }









function startInstaller(){
?>
            <form id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" >
                <div class="fb-text form-group field-dbhost"><label for="dbhost" class="fb-text-label">DB host <span class="required">*</span> <span class="tooltip-element" tooltip="In most cases &quot;localhost&quot; will be just fine">?</span></label> <input type="text" required="" placeholder="Database host" class="form-control" name="dbhost" id="dbhost" aria-required="true"></div>
                <div class="fb-text form-group field-dbname"><label for="dbname" class="fb-text-label">DB name <span class="required">*</span> <span class="tooltip-element" tooltip="Database name">?</span></label> <input type="text" required="" placeholder="Database name" class="form-control" name="dbname" id="dbname" aria-required="true"></div>
                <div class="fb-text form-group field-dbuser"><label for="dbuser" class="fb-text-label">DB user <span class="required">*</span> </label> <input type="text" required="" placeholder="Database username" class="form-control" name="dbuser" id="dbuser" aria-required="true"></div>
                <div class="fb-password form-group field-dbpass"><label for="dbpass" class="fb-password-label">DB pass <span class="required">*</span> <span class="tooltip-element" tooltip="Enter database password">?</span></label> <input type="password" required="" placeholder="Database password" class="form-control" name="dbpass" id="dbpass" aria-required="true"></div>
                <div class="fb-button form-group field-button-submit"><button type="submit" class="button-input btn btn-default" name="button-submit" style="default" id="button-submit">SUBMIT</button></div>
                <input type="hidden" name="action" value="newconfig">
            </form>
<?php

}


function createConfig(){
    //check again for existing working config.php
    if (file_exists("admin/config.php")) {
        require("admin/config.php");
        if ($mysqli && !$mysqli->connect_errno) { echo 'Everything is OK. Why would you create another config file?. You should <b><u>REALLY</u></b> JUST delete "install" folder on the server'; die(); }
        }
    //proceed with file creation
    $newConf='<?php
$hostname_mysqlcon = "'.$_POST['dbhost'].'";
$database_mysqlcon = "'.$_POST['dbname'].'";
$username_mysqlcon = "'.$_POST['dbuser'].'";
$password_mysqlcon = "'.$_POST['dbpass'].'";

$mysqli = @new mysqli($hostname_mysqlcon, $username_mysqlcon, $password_mysqlcon,$database_mysqlcon);
@$mysqli->set_charset("utf8");
?>';

    file_put_contents('admin/config.php', $newConf);
    checkConn();

}





function checkConn(){
    include("admin/config.php");

    if (!$mysqli || $mysqli->connect_errno) {
        echo ('Connect failed: <b>' . $mysqli->connect_error.'</b>');
        echo ('<br>You credentials are not valid. You should recreate your config file. Complete form below.<br><br> ');
        startInstaller();
        die();
    } else {
        echo ('Everything is OK. You should <b><u>REALLY</u></b> delete "install" folder on the server');
        die();
    }

}




?>
        </div>
    </div>
</div>