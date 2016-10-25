<?php include("config.php")?>
<!DOCTYPE html>
<HTML>
  <HEAD>

    <title>Agenda</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">  -->

    <!-- Helpers JS -->
    <script src="js/jscolor/jscolor.js"></script>
    <script src="js/widgeditor/widgEditor.js"></script>



    <!-- Helpers CSS -->
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/widgeditor/widgEditor.css" rel="stylesheet" type="text/css">


  </HEAD>
  <BODY>


<ul id="mainmenu">
    <li><a class="menuactive" href="index.php">Home</a></li>
    <li><a href="events.php">Events</a></li>
    <li><a href="speakers.php">Speakers</a></li>
    <li><a href="locations.php">Locations</a></li>
</ul>

<script>

$( document ).ready(function() {
//highlight menu item
var docloc = document.location.href.match(/[^\/]+$/)[0];

    if($('a[href$="'+docloc+'"]')) {
        $("#mainmenu a").removeClass("menuactive");
        $('a[href$="'+docloc+'"]').addClass("menuactive");

        }

});

</script>