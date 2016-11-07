
<style type="text/css">
    .boja1{background-color: #2077B4; } 
.boja2{background-color: #B0E0F8; } 
.boja3{background-color: #7660AA; } 
.boja4{background-color: #D67896; } 
.boja5{background-color: #CB99C5; } 
.boja6{background-color: #FEDDBD; } 
.boja7{background-color: #FFDF80; } 
.boja8{background-color: #DFBD2C; } 
.boja9{background-color: #A3D17C; } 
.boja10{background-color: #54B954; } 


.boja11{background-color: #2BBAA6 ; } 
.boja12{background-color: #1CBECF ; } 
.boja13{background-color: #7DCCC3 ; } 
.boja14{background-color: #F37F6D ; } 
.boja15{background-color: #F8B8A9 ; } 
.boja16{background-color: #CBBF8E ; } 
.boja17{background-color: #C7C6C6 ; } 
.boja18{background-color: #9E9893 ; } 
.boja19{background-color: #4E777F ; } 
.boja20{background-color: #626262 ; } 
.boja21{background-color: #8CC63E ; } 
.boja22{background-color: #D3423B ; } 
</style>



    <div id="sidebar-filters" class="sidebar-section vevent" itemscope="" itemtype="http://schema.org/Event">
        <div id="sidebar-filters-type">
            <ul>
                <li id="sidebar-search">
                    <form  method="get">
                        <input type="text" id="searchFi" name="s" class="" placeholder="Претрага" style="color: rgb(204, 204, 204);"> 
                        <!-- <input id="s-submit" type="submit" value="Search" class="button-submit" style="font-size: 10px;"> -->
                        <br style="clear:both">

                        <button id="btnPretraga" type="button">Претрага</button>
                        <button id="btnReset" type="button">Ресет</button>
                    </form>
                </li>
                <li class="ev_tags" id="sidebar-filters-dates">
                    <a class="url" href="/">
                       <!--  <span style="overflow:hidden;text-indent:-5000px" class="box summary">Opis</span> -->
                        <span class="dtstart"> 7<span class="value-title" title="2016-11-07"></span></span>-<span class="dtend">13. новембар 2016.<span class="value-title" title="2016-11-13"></span></span>
                    </a>
                    <div class="popover">
                        <div class="popover-content">
                            <div class="arrow"><span></span></div>
                            <div class="popover-body">
                                <div class="popover-body-inner datumi">
                                    <ul>
                                        <li><a href="#" date="2016-11-07"><b>Понедељак</b>, 7. новембар</a></li>
                                        <li><a href="#" date="2016-11-08"><b>Уторак</b>, 8. новембар</a></li>
                                        <li><a href="#" date="2016-11-09"><b>Среда</b>, 9. новембар</a></li>
                                        <li><a href="#" date="2016-11-10"><b>Четвртак</b>, 10. новембар</a></li>
                                        <li><a href="#" date="2016-11-11"><b>Петак</b>, 11. новембар</a></li>
                                        <li><a href="#" date="2016-11-12"><b>Субота</b>, 12. новембар</a></li>
                                        <li><a href="#" date="2016-11-13"><b>Недеља</b>, 13. новембар</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li id="sidebar-filters-venues">

                    <a href="#" mesto="svi"><span class="box"></span> Сви догађаји</a>
                    <!-- nemam pojma da li se negde koristi ovaj id -->
                </li>

                <?php  
                    include 'misc.php';
                    
                    $var_podaci = file_get_contents("http://program.nedeljaparlamentarizma.rs/api/events") ;                 
                    $niz_podataka = json_decode($var_podaci);


                    $niz = listaMesta( $niz_podataka );



                    foreach ($niz as $key  => $value) {
                        $temp_vals = boja_i_grad( $value);    

                        $boja = $temp_vals[0];
                        $grad = $temp_vals[1];
                        $val_te = $key + 1;

                        echo <<<LA
                        <li id="type-{$$val_te}" class="lev1 ">
                        <a href="#" mesto="$grad" title="Pogledajte sva dešavanja ovom gradu"><span class="box $boja"></span>$value</a>
                        </li>
LA;

                    }
                    
                   
                ?>

                <li style="clear:left"></li>

                <?php                      

                    $niz_event_tipova = tipovi( $niz_podataka  );

                          

                    foreach ($niz_event_tipova as $value) {
                        $temp_tip = tipovi_dogadjaja( $value );
                        echo <<<TIP
                        <li class="lev1 ev_tags" id="filter-menutag-temp_tip"> <a href="#" tag="$temp_tip"  title="$value"><span class="box"></span>$value</a>
                        </li>
TIP;
                    }

                ?>

           

            </ul>
        </div>
    </div>
    <hr>




<script type="text/javascript">
    
    function resetAll() {
        $("#content div").show();
        $(".container-inner span:[mesto]").show();
        $("span.event").show();
    }

    function sakrivanjeOstalih() { //sakrivanje ostalih eleemnata osim spanova
        $(".jedan_dan").each(function(ind, el){
                var temp_nesakriveni = $(el).children().find("span.event:not(:hidden)");
                if ( temp_nesakriveni.length == 0  ) {
                    $(el).hide();
                }
            })

        $(".jedan_period").each(function(ind, el){
            var temp_nesakriveni = $(el).children().find("span.event:not(:hidden)");
            if ( temp_nesakriveni.length == 0  ) {
                $(el).hide();
            }
        })          
    }


    $(function() {
        $('#btnPretraga').on("click", function(ev) {
          ev.preventDefault();
          
        
          var pojam_pretraga = $('#searchFi').val();

          resetAll();

          $("span.event").filter(function() { 
            
            return ( $(this).text().indexOf( pojam_pretraga) == -1); 

            }).hide();

          sakrivanjeOstalih();
          
        }) //pretraga

        $("#btnReset").click(function(ev) {
            resetAll();
        })



        $("[mesto]").click(function(ev) {
        
            ev.preventDefault();
            var mesto = $(this).attr('mesto') ; 
            
            resetAll() ; //prikaziSve
                       //.css('opacity','1'); //prikazi sve
            if(mesto != "svi")
            $(".container-inner span.event:not([mesto='"+mesto+"'])").hide()
            //.css('opacity','0.3');//sakrij druge
            
            sakrivanjeOstalih();
        
        }) //"[mesto]"

        $("[tag]").click(function(ev) {
        
            ev.preventDefault();
            var tag = $(this).attr('tag') ; 
            
            resetAll() ; //prikaziSve
                       //.css('opacity','1'); //prikazi sve
            if(tag != "svi")
            $(".container-inner span.event:not([tag='"+tag+"'])").hide()
            //.css('opacity','0.3');//sakrij druge
            
            sakrivanjeOstalih();
        
        }) //"[tag]"


        $(".datumi li a").click(function(ev) {
        
            ev.preventDefault();
            var date = $(this).attr('date') ; 
            
            $(".jedan_dan").show(); //prikaz svih
                       
            
            $(".jedan_dan:not([date='"+date+"'])").hide()
            //.css('opacity','0.3');//sakrij druge
            
            //sakrivanjeOstalih();
        
        }) //"[datumi]"

    }); //on load


</script>