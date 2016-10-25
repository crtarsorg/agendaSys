<?php include("menu.php")?>
<?php
//handle post
//update existing
if($_POST['action']=="update"){
    $resp = "updating... ";
    //if new image uploaded
    if($_FILES["simage"]["name"]){
        $imgftype = pathinfo(basename($_FILES["simage"]["name"]),PATHINFO_EXTENSION);
        if (move_uploaded_file($_FILES["simage"]["tmp_name"], "../spkimages/".$_POST[sid].".".strtolower($imgftype)  )) {
            $resp .= " File uploaded. "; $updimage= ", simg='".$_POST[sid].".".strtolower($imgftype)."' ";   } else {  $resp .= " Error uploading your file. "; }
    }

    $sqlupd = "  UPDATE speakers SET sname = '".$_POST[sname]."', sdesc = '".$_POST[sdesc]."' ".$updimage."  WHERE sid = '".$_POST[sid]."' ";
    if (!$mysqli->query($sqlupd)) { $resp =  " Error: ". $mysqli->error; } else { $resp.= " OK ";}
}

//insert NEW
if($_POST['action']=="addnew"){
    $resp = "adding new... ";
    $sqlins = "INSERT INTO speakers (`sid`, `sname`, `sdesc`) VALUES (NULL, '".$_POST[sname]."', '".$_POST[sdesc]."' ) ";
    if (!$mysqli->query($sqlins)) { $resp =  "Error: ". $mysqli->error; } else {
        $resp.= "OK";
        //if image
        if($_FILES["simage"]["name"]){
            $insid = $mysqli->insert_id;
            $imgftype = pathinfo(basename($_FILES["simage"]["name"]),PATHINFO_EXTENSION);
            move_uploaded_file($_FILES["simage"]["tmp_name"], "../spkimages/".$insid.".".strtolower($imgftype)  );
            $sqlupdimg = "  UPDATE speakers SET simg = '".$insid.".".strtolower($imgftype)."'   WHERE sid = '".$insid."' ";
            //echo $sqlupdimg;
            $mysqli->query($sqlupdimg);
        }


        }
}
?>
<div id="cont">
<h2>Speakers</h2>
<p id="resp"><?php echo $resp;?>&nbsp;</p>
<h2 id="addnewlocation">Add new speaker:</h2>

<!-- Dodaj novi -->
<div id="addnew">
    <form action="speakers.php" method="POST" enctype="multipart/form-data">
        <input id="action" type="hidden" name="action" value="addnew">
        <input id="sid" type="hidden" name="sid" value="<?php echo $row->sid;?>">
        <input placeholder="Speaker name"  id="sname" name="sname" size="100" value="<?php echo $row->sname;?>" maxlength="200"><br>
        <textarea class="widgEditor" placeholder="Speaker description" id="sdesc<?php echo $row->sid;?>" name="sdesc" rows="5" cols="100"><?php echo $row->sdesc;?></textarea>     <br>
        <input type="file" name="simage" id="simage" > <br>
        <p style="text-align: right"><input name="" type="submit" value="ADD NEW SPEAKER"></p>
    </form>

</div>

<?php
$res = $mysqli->query("SELECT * FROM speakers ORDER BY sid DESC") ;

while($row = $res->fetch_object()){
?>
    <form action="speakers.php" method="POST" enctype="multipart/form-data">
        <input id="action" type="hidden" name="action" value="update">
        <input id="sid" type="hidden" name="sid" value="<?php echo $row->sid;?>">
        <input placeholder="Speaker name"  id="sname" name="sname" size="100" value="<?php echo $row->sname;?>" maxlength="200"><br>
        <textarea class="widgEditor" placeholder="Speaker description" id="sdesc<?php echo $row->sid;?>" name="sdesc" rows="5" cols="100"><?php echo $row->sdesc;?></textarea>     <br>
        <img  class="speakerimage" src="../spkimages/<?php echo $row->simg;?>" alt="" /><input type="file" name="simage" id="simage" > <br>
        <p style="text-align: right"><input name="" type="submit" value="EDIT SPEAKER INFO"></p>
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