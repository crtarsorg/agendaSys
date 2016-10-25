<?php include("menu.php")?>
<?php
//handle post
//update existing
if($_POST['action']=="update"){
    $resp = "updating... ";
    $sqlupd = "  UPDATE events SET ename = '".$_POST[naziv]."', edesc = '".$_POST[opis]."', eldesc = '".$_POST[opislong]."', edate = '".$_POST[date]."', etime = '".$_POST[time]."', eloc = '".$_POST[lokacija]."', eact = '".$_POST[act]."'  WHERE eid = '".$_POST[eid]."' ";
    //echo $sqlupd;
    if (!$mysqli->query($sqlupd)) { $resp =  "Error: ". $mysqli->error; } else { $resp.= "OK";}
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
                $reslok = $mysqli->query("SELECT lid,lname FROM locations  ") ;
                while($rowlok = $reslok->fetch_object()){
                    if($row->eloc==$rowlok->lid){$selected = ' selected="selected" '; } else {$selected = '  '; }

                ?>
                    <option  <?php echo $selected;?> value="<?php echo $rowlok->lid;?>"><?php echo $rowlok->lname;?></option>
                <?php } ?>
        </select>


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
    $( "#time" ).timepicker({ timeFormat: 'HH:mm:ss' });




});

</script>


<?php include("footer.php")?>