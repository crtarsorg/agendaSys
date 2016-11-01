<?php include("menu.php")?>
<?php

//echo "<pre>";
//var_dump($_POST);
//echo "</pre>";


//handle post
//update existing
if($_POST['action']=="update"){
    $resp = "updating data... ";
    $sqlupd = "  UPDATE events SET ename = '".$_POST[naziv]."', edesc = '".$_POST[opis]."', eldesc = '".$_POST[opislong]."', edate = '".$_POST[date]."', etime = '".$_POST[time]."', eloc = '".$_POST[lokacija]."', eact = '".$_POST[act]."', elink = '".$_POST[elink]."', epartneri = '".$_POST[epartneri]."'    WHERE eid = '".$_POST[eid]."' ";
    //echo $sqlupd;
    if (!$mysqli->query($sqlupd)) { $resp =  "Error: ". $mysqli->error; } else { $resp.= "OK";}

    //update speakers
    if(!$_POST[speakers]){
        if (!$mysqli->query("DELETE FROM s2es WHERE evtid='".$_POST[eid]."'  ")) { $resp =  "<br> Error removing speakers: ". $mysqli->error; } else { $resp.= "<br> Speakers removed.";}
    } else {
        if (!$mysqli->query("DELETE FROM s2es WHERE evtid='".$_POST[eid]."'  ")) { $resp =  "<br> Error removing OLD speakers: ". $mysqli->error; } else { $resp.= "<br> OLD speakers removed...";}
        //insert new speakers
        foreach ($_POST[speakers] as $key => $value) {
            $sqlnewspeak = " INSERT INTO s2es  (`s2esid`, `evtid`, `spkid`, `s2esord`) VALUES (NULL, '".$_POST[eid]."','".$value."','0')  ";
            if (!$mysqli->query($sqlnewspeak)) { $resp =  "<br>Error adding speaker: ". $mysqli->error; } else { $resp.= "<br>New speaker added.";}
        }
    }

}


?>
<div id="cont">
<h2>Event editor</h2>
<p id="resp"><?php echo $resp;?>&nbsp;</p>

<?php
$res = $mysqli->query("SELECT * FROM events WHERE eid='".$_GET[eid]."'  ") ;

while($row = $res->fetch_object()){
?>
    <form action="eventedit.php?eid=<?php echo $row->eid;?>" method="POST" enctype="multipart/form-data">
        <input id="action" type="hidden" name="action" value="update">
        <input id="eid" type="hidden" name="eid" value="<?php echo $row->eid;?>">
        <input placeholder="Naziv"  id="naziv" name="naziv" size="100" value="<?php echo $row->ename;?>" maxlength="200"><br>
        <input placeholder="Kratak opis" id="opis" name="opis" size="100" value="<?php echo $row->edesc;?>" maxlength="200">        <br>
        <textarea class="widgEditor" placeholder="Opis dogadjaja" id="opislong" name="opislong" rows="5" cols="100"><?php echo $row->eldesc;?></textarea>     <br>


        Datum: <input placeholder="Datum" id="date" name="date" size="10" value="<?php echo $row->edate;?>" maxlength="200">
        Vreme: <input placeholder="Vreme" id="time" name="time" size="10" value="<?php echo $row->etime;?>" maxlength="200">
        Aktivan (0 ili 1) <input placeholder="Aktivan" id="act" name="act" size="10" value="<?php echo $row->eact;?>" maxlength="1">

        <h3>Lokacija</h3>

        <select id="lokacija" name="lokacija" size="1">
             <option  value=""></option>
            <?php
                $reslok = $mysqli->query("SELECT lid,lname, lcity FROM locations ORDER BY lcity  ") ;
                while($rowlok = $reslok->fetch_object()){
                    if($row->eloc==$rowlok->lid){$selected = ' selected="selected" '; } else {$selected = '  '; }

                ?>
                    <option  <?php echo $selected;?> value="<?php echo $rowlok->lid;?>"><?php echo $rowlok->lcity;?> <?php echo $rowlok->lname;?></option>
                <?php } ?>
        </select>

        <h3>Speakers</h3>

<?php
//get speakers for event
$evspeak = $mysqli->query("SELECT spkid FROM s2es WHERE evtid='".$_GET[eid]."'  ") ;
$evarr = mysqli_fetch_all($evspeak,MYSQLI_ASSOC);
$evarrflat = array_map(function ($field) { return $field['spkid'];},$evarr);

//get all speakers
$respeak = $mysqli->query("SELECT * FROM speakers  ") ;

while($rowspeak = $respeak->fetch_object()){

    if( in_array($rowspeak->sid,$evarrflat)){$checked=" checked ";} else { $checked=" "; }

?>

        <label class="speakersinput" ><input  type="checkbox" <?php echo $checked;?> name="speakers[]" value="<?php echo $rowspeak->sid;?>"><?php echo $rowspeak->sname;?></input></label>
<?php
}
?>


        <h3>Partneri</h3>
        <textarea class="widgEditor" placeholder="Partneri" id="epartneri" name="epartneri" rows="5" cols="100"><?php echo $row->epartneri;?></textarea>     <br>

        <h3>Link</h3>
        <input placeholder="Link dogadjaja"  id="elink" name="elink" size="100" value="<?php echo $row->elink;?>" maxlength="200"><br>



        <p style="text-align: right"><input name="" type="submit" value="SUBMIT CHANGES"></p>
    </form>
    <hr>
<?php
}
?>

</div>


<script>

$( document ).ready(function() {
    console.log( "ready!" );

    $("form:odd").css( "background-color", "lightgrey" );
    $("form:even").css( "background-color", "darkgrey" );


    $( "#date" ).datepicker({ dateFormat: 'yy-mm-dd' } );
    //$( "#time" ).timepicker({ timeFormat: 'HH:mm:ss' });
    $( "#time" ).timepicker();




});

</script>


<?php include("footer.php")?>