<?php include("menu.php")?>
<?php

//handle post
//insert new event
if($_POST['action']=="insert"){
    $sqlins = " INSERT INTO `events` (`eid`, `ename`, `edesc`, `eldesc`, `edate`, `etime`, `eloc`, `eact`, `elink`, `epartneri`, `etip`) VALUES (NULL, '".$_POST[naziv]."', '".$_POST[opis]."', '".$_POST[opislong]."', '".$_POST[date]."', '".$_POST[time]."', '".$_POST[lokacija]."', '".$_POST[act]."' , '".$_POST[elink]."', '".$_POST[epartneri]."', '".$_POST[etip]."'  ) ";
    if (!$mysqli->query($sqlins)) { $resp =  "Error: ". $mysqli->error; } else { $resp.= "New event added. <b><u>Do NOT REFRESH page or event will be inserted again.</u></b>"; $insnewid = $mysqli->insert_id; }


    //insert speakers
    if($_POST[speakers] && $insnewid ){
        foreach ($_POST[speakers] as $key => $value) {
            $sqlnewspeak = " INSERT INTO s2es  (`s2esid`, `evtid`, `spkid`, `s2esord`) VALUES (NULL, '".$insnewid."','".$value."','0')  ";
            if (!$mysqli->query($sqlnewspeak)) { $resp =  "<br>Error adding speaker: ". $mysqli->error; } else { $resp.= "<br>New speaker added.";}
        }
    } else {$resp.= "<br><b>No insert id</b>  OR <b>no speakers submitted</b>. Skipping speakers.";}


}


?>
<div id="cont">
<h2>Add Event</h2>
<p id="resp"><?php echo $resp;?>&nbsp;</p>

    <form action="eventadd.php" method="POST" enctype="multipart/form-data">
        <input id="action" type="hidden" name="action" value="insert">
        <input placeholder="Naziv"  id="naziv" name="naziv" size="100" value="<?php echo $_POST[naziv];?>" maxlength="200"><br>
        <input placeholder="Kratak opis" id="opis" name="opis" size="100" value="<?php echo $_POST[opis];?>" maxlength="200">        <br>
        <textarea class="widgEditor" placeholder="Opis dogadjaja" id="opislong" name="opislong" rows="5" cols="100"><?php echo $_POST[opislong];?></textarea>     <br>


        Datum: <input placeholder="Datum" id="date" name="date" size="10" value="<?php echo $_POST[date]?>" maxlength="200">
        Vreme: <input placeholder="Vreme" id="time" name="time" size="10" value="<?php echo $_POST[time];?>" maxlength="200">
        Aktivan (0 ili 1) <input placeholder="Aktivan" id="act" name="act" size="10" value="<?php echo $_POST[act];?>" maxlength="1">

        <h3>Lokacija</h3>

        <select id="lokacija" name="lokacija" size="1">
             <option  value=""></option>
            <?php
                $reslok = $mysqli->query("SELECT lid,lname, lcity FROM locations ORDER BY lcity  ") ;
                while($rowlok = $reslok->fetch_object()){
                    if($_POST[lokacija]==$rowlok->lid){$selected = ' selected="selected" '; } else {$selected = '  '; }

                ?>
                    <option  <?php echo $selected;?> value="<?php echo $rowlok->lid;?>"><?php echo $rowlok->lcity;?> <?php echo $rowlok->lname;?></option>
                <?php } ?>
        </select>

        <h3>Speakers</h3>

<?php
//get all speakers
$respeak = $mysqli->query("SELECT * FROM speakers  ") ;

while($rowspeak = $respeak->fetch_object()){

    if( @in_array($rowspeak->sid,$_POST[speakers])){$checked=" checked ";} else { $checked=" "; }

?>

        <label class="speakersinput" ><input  type="checkbox" <?php echo $checked;?> name="speakers[]" value="<?php echo $rowspeak->sid;?>"><?php echo $rowspeak->sname;?></input></label>
<?php
}
?>

        <h3>Tip dogadjaja</h3>
        <input placeholder="Tip dogadjaja"  id="etip" name="etip" size="100" value="<?php echo  $_POST[etip];?>" maxlength="300"><br>

        <h3>Partneri</h3>
        <textarea class="widgEditor" placeholder="Partneri" id="epartneri" name="epartneri" rows="5" cols="100"><?php echo $_POST[epartneri];?></textarea>     <br>

        <h3>Link</h3>
        <input placeholder="Link dogadjaja"  id="elink" name="elink" size="100" value="<?php echo $_POST[elink];?>" maxlength="200"><br>





        <p style="text-align: right"><input name="" type="submit" value="ADD NEW EVENT"></p>
    </form>
    <hr>

</div>


<script>

$( document ).ready(function() {
    console.log( "ready!" );

    $("form:odd").css( "background-color", "lightgrey" );
    $("form:even").css( "background-color", "darkgrey" );


    $( "#date" ).datepicker({ dateFormat: 'yy-mm-dd' } );
    $( "#time" ).timepicker({ timeFormat: 'HH:mm:ss' });




});

</script>


<?php include("footer.php")?>