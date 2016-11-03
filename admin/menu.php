<?php include("config.php");?>
<!DOCTYPE html>
<HTML>
  <HEAD>
    <meta charset="utf-8">
    <title>Agenda</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


    <!-- Helpers JS -->
    <script src="js/jscolor/jscolor.js"></script>
    <script src="js/widgeditor/widgEditor.js"></script>
    <script src="js/timepicker/jquery.ui.timepicker.js"></script>



    <!-- Helpers CSS -->
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/widgeditor/widgEditor.css" rel="stylesheet" type="text/css">
    <link href="css/timepicker/jquery.ui.timepicker.css" rel="stylesheet" type="text/css">


  </HEAD>
  <BODY>


<ul id="mainmenu">
    <li><a class="menuactive" href="index.php">Home</a></li>
    <li><a href="events.php">Events</a></li>
    <li><a href="eventadd.php">Add Event</a></li>
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

//tip dogadjaja - select autocomplete
        var availableEvents = [
                    "Дебата",
                    "Инфо сесија",
                    "Панел дискусија",
                    "Округли сто",
                    "Неформални састанак",
                    "Едукативна радионица",
                    "Дан отворених врата",
                    "Трибина",
                    "Презентација",
                    "Улична акција",
                    "Симулација седнице"
                ];

        $( "#etip" ).autocomplete({
            source: availableEvents,minLength: 0
        }).focus(function(){
            $(this).data("ui-autocomplete").search("");
        });


});

</script>