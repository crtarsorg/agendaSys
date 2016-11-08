<?php include("menu.php");?> 
<div id="cont">

<h2>Events</h2>

<?php
$res = $mysqli->query("SELECT * FROM events LEFT JOIN locations ON events.eloc=locations.lid ORDER BY events.edate, events.etime ASC   ") ;

while($row = $res->fetch_object()){

//echo "<pre>";
//var_dump($row);
//echo "</pre>";

$respeak = $mysqli->query("  SELECT sname FROM `s2es` LEFT JOIN speakers ON s2es.spkid=speakers.sid WHERE evtid='".$row->eid."'   ") ;
$respeakres = mysqli_fetch_all($respeak,MYSQLI_ASSOC);

if($row->eact==1){ $actclass = "";} else {$actclass = "inactive";}

?>
    <div class="listevent <?php echo $actclass;?> ">
            <div class="eventtime">
                <h3><u><?php echo @date("d.m", @strtotime($row->edate));?></u></h3>
                <h3><?php echo @date("H:i", @strtotime($row->etime));?></h3>
                <a href="eventedit.php?eid=<?php echo $row->eid;?>">edit</a>
            </div>
            <div class="eventinfo">
                <h3><?php echo $row->ename;?></h3>
                <?php echo $row->lname;?><br>
                <?php echo $row->ladres;?><br>
                <?php echo $row->lcity;?><br>
            </div>
            <div class="eventspeakers">
                <h3>Speakers:</h3>
                <?php
                    echo implode(', ', array_map(function ($field) {
                        return $field['sname'];
                    }, $respeakres));

                ?>
            </div>

            <div class="clear"><p style="text-align: right"><b><?php if($row->eact==1){echo "Aktivan";} else {echo "NEAKTIVAN";}?></b> </p></div>
    </div>
    <hr>
<?php
}
?>




</div>








<?php include("footer.php")?>