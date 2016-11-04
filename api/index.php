<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

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
//list all speakers
if(preg_match('"^speakers(/?)$"', $req, $matches)){
    listAllSpeakers();
}
//list single speaker
if(preg_match('"^speakers/[0-9]+(/?)$"', $req, $matches)){
    listSingleSpeakerDetails(explode("/",$req)[1]);
}
//serve all speakers with their events
if(preg_match('"^speakerswithevents(/?)$"', $req, $matches)){
    speakersWithEvents();
}


function listAllEvents(){
    checkCache("listAllEvents");
        include("../admin/config.php"); // ovo je namerno u svakoj funkciji
        $res = mysqli_fetch_all($mysqli->query("SELECT * FROM events LEFT JOIN locations ON events.eloc=locations.lid ORDER BY events.edate, events.etime ASC   "),MYSQLI_ASSOC) ;
    createCache("listAllEvents",json_encode($res));
    //echo json_encode($res);
}
function listSingleEvent($evtid){
    checkCache("listSingleEvent");
        include("../admin/config.php"); // ovo je namerno u svakoj funkciji
        $res = mysqli_fetch_all($mysqli->query("SELECT * FROM events LEFT JOIN locations ON events.eloc=locations.lid WHERE eid='".$evtid."' ORDER BY events.edate, events.etime ASC   "),MYSQLI_ASSOC) ;
    createCache("listSingleEvent",json_encode($res));
    //echo json_encode($res);
}
function listEventSpeakers($evtid){
    checkCache("listEventSpeakers");
        include("../admin/config.php"); // ovo je namerno u svakoj funkciji
        $res = mysqli_fetch_all($mysqli->query("SELECT * FROM s2es LEFT JOIN speakers ON s2es.spkid=speakers.sid WHERE evtid='".$evtid."'  "),MYSQLI_ASSOC ) ;
    createCache("listEventSpeakers",json_encode($res));
    //echo json_encode($res);
}
function listAllSpeakers(){
    checkCache("listAllSpeakers");
        include("../admin/config.php"); // ovo je namerno u svakoj funkciji
        $res = mysqli_fetch_all($mysqli->query("SELECT * FROM speakers  "),MYSQLI_ASSOC) ;
    createCache("listAllSpeakers",json_encode($res));
    //echo json_encode($res);
}
function listSingleSpeakerDetails($evtid){
    checkCache("listSingleSpeakerDetails");
        include("../admin/config.php"); // ovo je namerno u svakoj funkciji
        $res = mysqli_fetch_all($mysqli->query("SELECT * FROM speakers WHERE sid='".$evtid."'   "),MYSQLI_ASSOC) ;
    createCache("listSingleSpeakerDetails",json_encode($res));
    //echo json_encode($res);
}
function speakersWithEvents(){
    checkCache("speakersWithEvents");
        include("../admin/config.php"); // ovo je namerno u svakoj funkciji
        $res = mysqli_fetch_all($mysqli->query("  SELECT speakers.*,events.eid,events.ename FROM `speakers` LEFT JOIN `s2es` ON speakers.sid=s2es.spkid LEFT JOIN `events` ON s2es.evtid=events.eid ORDER BY `speakers`.`sname` ASC  "),MYSQLI_ASSOC) ;
    createCache("speakersWithEvents",json_encode($res));
    //echo json_encode($res);
}





//HELPERS
function createCache($call, $data){
    $fp = fopen($call.".json", 'w');
    fwrite($fp, $data);
    fclose($fp);

    echo $data;
}

function checkCache($call){
    $flife=10; //seconds

    if(file_exists($call.".json")){

        clearstatcache();
        $age = time()-filemtime($call.".json");
        if($age>$flife) {
            //go back and make query
            return;
        }else {
            //serve cached file
            echo file_get_contents($call.".json");
            die();
        }

    } else {
        //go back and make query
        return;
    }



}



?>