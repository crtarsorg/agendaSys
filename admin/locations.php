<?php include("menu.php")?>
<?php
//handle post
//update existing
if($_POST['action']=="update"){
    $resp = "updating... ";
    //UPDATE `agenda`.`locations` SET `lname` = 'Lobi2', `ldesc` = 'Lobi na glavnom ulazu2', `lcoordx` = '44.802473', `lcoordy` = '20.466343', `lcolor` = '#FF0003', `ladres` = 'Trg Nikole Pašića 133', `lcity` = 'Beograd3', `lstate` = '3' WHERE `locations`.`lid` = 1;
    $sqlupd = "  UPDATE locations SET lname = '".$_POST[naziv]."', ldesc = '".$_POST[opis]."', lcoordx = '".$_POST[cx]."', lcoordy = '".$_POST[cy]."', lcolor = '".$_POST[color]."', ladres = '".$_POST[adresa]."', lcity = '".$_POST[grad]."', lstate = '".$_POST[drzava]."' WHERE lid = '".$_POST[lid]."' ";
    if (!$mysqli->query($sqlupd)) { $resp =  "Error: ". $mysqli->error; } else { $resp.= "OK";}
}

//insert NEW
if($_POST['action']=="addnew"){
    $resp = "adding new... ";
    //INSERT INTO `agenda`.`locations` (`lid`, `lname`, `ldesc`, `lcoordx`, `lcoordy`, `lcolor`, `ladres`, `lcity`, `lstate`) VALUES (NULL, 'name', 'desc', '44.802472', '20.466341', 'color', 'adresa', 'grad', 'drzava');
    $sqlins = "INSERT INTO `locations` (`lid`, `lname`, `ldesc`, `lcoordx`, `lcoordy`, `lcolor`, `ladres`, `lcity`, `lstate`) VALUES (NULL, '".$_POST[naziv]."', '".$_POST[opis]."', '".$_POST[cx]."', '".$_POST[cy]."', '".$_POST[color]."', '".$_POST[adresa]."', '".$_POST[grad]."', '".$_POST[drzava]."') ";
    if (!$mysqli->query($sqlins)) { $resp =  "Error: ". $mysqli->error; } else { $resp.= "OK";}
}
?>
<div id="cont">
<h2>Locations</h2>
<p id="resp"><?php echo $resp;?>&nbsp;</p>
<h2 id="addnewlocation">Add new location:</h2>

<!-- Dodaj novi -->
<div id="addnew">
    <form action="locations.php" method="POST" enctype="multipart/form-data">
        <input id="action" type="hidden" name="action" value="addnew">
        <input placeholder="Naziv lokacije"  id="naziv" name="naziv" size="100" value="<?php echo $row->lname;?>" maxlength="200"><br>
        <textarea placeholder="Opis lokacije" id="opis" name="opis" rows="5" cols="100"><?php echo $row->ldesc;?></textarea>     <br>
        <input placeholder="Adresa lokacije" id="adresa" name="adresa" size="100" value="<?php echo $row->ladres;?>" maxlength="200">        <br>
        <input placeholder="Grad" id="grad" name="grad" size="100" value="<?php echo $row->lcity;?>" maxlength="200">                  <br>
        <input placeholder="Država" id="drzava" name="drzava" size="100" value="<?php echo $row->lstate;?>" maxlength="200">            <br>
        <br>
        <input placeholder="Latitude X" id="cx" name="cx" size="10" value="44.802472" maxlength="10">
        <input placeholder="Latitude X" id="cy" name="cy" size="10" value="20.466341" maxlength="10">  <a href="https://www.google.rs/maps/?q=loc:44.8025302,20.4667893" target="_blank">Nadjite koordinate</a>    <br>
        <input placeholder="Hex boja FF0000" class="jscolor" id="color" name="color" size="10" value="<?php echo $row->lcolor;?>" maxlength="10">  <br><br>
        <p style="text-align: right"><input name="" type="submit" value="ADD NEW LOCATION"></p>
    </form>

</div>

<?php
$res = $mysqli->query("SELECT * FROM locations ORDER BY lid DESC") ;

while($row = $res->fetch_object()){
?>
    <form action="locations.php" method="POST" enctype="multipart/form-data">
        <input id="action" type="hidden" name="action" value="update">
        <input id="lid" type="hidden" name="lid" value="<?php echo $row->lid;?>">
        <input placeholder="Naziv lokacije"  id="naziv" name="naziv" size="100" value="<?php echo $row->lname;?>" maxlength="200"><br>
        <textarea class="widgEditor" placeholder="Opis lokacije" id="opis<?php echo $row->lid;?>" name="opis" rows="5" cols="100"><?php echo $row->ldesc;?></textarea>     <br>
        <input placeholder="Adresa lokacije" id="adresa" name="adresa" size="100" value="<?php echo $row->ladres;?>" maxlength="200">        <br>
        <input placeholder="Grad" id="grad" name="grad" size="100" value="<?php echo $row->lcity;?>" maxlength="200">                  <br>
        <input placeholder="Država" id="drzava" name="drzava" size="100" value="<?php echo $row->lstate;?>" maxlength="200">            <br>
        <br>
        <input placeholder="Latitude X" id="cx" name="cx" size="10" value="<?php echo $row->lcoordx;?>" maxlength="10">
        <input placeholder="Latitude X" id="cy" name="cy" size="10" value="<?php echo $row->lcoordy;?>" maxlength="10">  <a href="https://www.google.rs/maps/?q=loc:44.8025302,20.4667893" target="_blank">Nadjite koordinate</a>    <br>
        <input placeholder="Hex boja FF0000" class="jscolor" id="color" name="color" size="10" value="<?php echo $row->lcolor;?>" maxlength="10">  <br><br>
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

    $("#addnewlocation").click(function(){
        $("#addnew").toggle();
        })

    $("form:odd").css( "background-color", "lightgrey" );
    $("form:even").css( "background-color", "darkgrey" );

});

</script>


<?php include("footer.php")?>