<?php

//echo "<pre>";
//var_dump($_GET[request]);
//echo "</pre>";

$req = $_GET[request];

//serve all events
if(preg_match('"^events(/?)$"', $req, $matches)){
    listAllEvents();
}
//serve  event with ID
if(preg_match('"^events/[0-9]+(/?)$"', $req, $matches)){
    listSingleEvent(explode("/",$req)[1]);
}
//list speakers for event with ID
if(preg_match('"^events/[0-9]+/speakers(/?)$"', $req, $matches)){
    listEventSpeakers(explode("/",$req)[1]);
}
//serve all events
if(preg_match('"^speakers(/?)$"', $req, $matches)){
    echo "speakers " .$req ;
}
//serve  event with ID
if(preg_match('"^speakers/[0-9]+(/?)$"', $req, $matches)){
    echo "single speaker " .$req ;
}



function listAllEvents(){
    include("../admin/config.php"); // ovo je namerno u svakoj funkciji
    $res = mysqli_fetch_all($mysqli->query("SELECT * FROM events LEFT JOIN locations ON events.eloc=locations.lid ORDER BY events.edate, events.etime ASC   "),MYSQLI_ASSOC) ;
    echo json_encode($res);

}

function listSingleEvent($evtid){
    include("../admin/config.php"); // ovo je namerno u svakoj funkciji
    $res = mysqli_fetch_all($mysqli->query("SELECT * FROM events LEFT JOIN locations ON events.eloc=locations.lid WHERE eid='".$evtid."' ORDER BY events.edate, events.etime ASC   "),MYSQLI_ASSOC) ;
    echo json_encode($res);

}
function listEventSpeakers($evtid){
    include("../admin/config.php"); // ovo je namerno u svakoj funkciji
    $res = mysqli_fetch_all($mysqli->query("SELECT * FROM s2es LEFT JOIN speakers ON s2es.spkid=speakers.sid WHERE evtid='".$evtid."'  "),MYSQLI_ASSOC ) ;
    echo json_encode($res);
}













?>