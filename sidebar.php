




    <div id="sidebar-filters" class="sidebar-section vevent" itemscope="" itemtype="http://schema.org/Event">
        <div id="sidebar-filters-type">
            <ul>
                <li id="sidebar-search">
                    <form  method="get">
                        <input type="text" id="searchFi" name="s" class="" placeholder="Pretraga" style="color: rgb(204, 204, 204);"> 
                        <!-- <input id="s-submit" type="submit" value="Search" class="button-submit" style="font-size: 10px;"> -->
                        <br style="clear:both">

                        <button id="btnPretraga" type="button">Pretraga</button>
                        <button id="btnReset" type="button">Reset</button>
                    </form>
                </li>
                <li class="ev_tags" id="sidebar-filters-dates">
                    <a class="url" href="/">
                       <!--  <span style="overflow:hidden;text-indent:-5000px" class="box summary">Opis</span> -->
                        <span class="dtstart">Novembar  7<span class="value-title" title="2016-11-07"></span></span>-<span class="dtend"> 13, 2016<span class="value-title" title="2016-11-13"></span></span>
                    </a>
                    <div class="popover">
                        <div class="popover-content">
                            <div class="arrow"><span></span></div>
                            <div class="popover-body">
                                <div class="popover-body-inner datumi">
                                    <ul>
                                        <li><a href="#" date="2016-11-07"><b>Ponedeljak</b>, 7. novembar</a></li>
                                        <li><a href="#" date="2016-11-08"><b>Utorak</b>, 8. novembar</a></li>
                                        <li><a href="#" date="2016-11-09"><b>Sreda</b>, 9. novembar</a></li>
                                        <li><a href="#" date="2016-11-10"><b>Četvrtak</b>, 10. novembar</a></li>
                                        <li><a href="#" date="2016-11-11"><b>Petak</b>, 11. novembar</a></li>
                                        <li><a href="#" date="2016-11-12"><b>Subota</b>, 12. novembar</a></li>
                                        <li><a href="#" date="2016-11-13"><b>Nedelja</b>, 13. novembar</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li id="sidebar-filters-venues">

                    <a href="#" mesto="svi"><span class="box"></span> Svi dogadjaji</a>
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
                        <li class="lev1 ev_tags" id="filter-menutag-temp_tip"> <a href="#" tag="temp_tip"  title="$value"><span class="box"></span>$value</a>
                        </li>
TIP;
                    }

                ?>

               <!--  <li class="lev1 ev_tags" id="filter-menutag-company"> <a href="#" tag="sto"  title="Okrugli sto"><span class="box"></span>Okrugli sto</a>
               </li>
               
               <li class="lev1 ev_tags" id="filter-menutag-audience"><a href="#" tag="radionica"  title="Radionica"><span class="box"></span>Radionica</a>
               </li>
               
               <li class="lev1 ev_tags" id="filter-menutag-subject"><a href="#" tag="debata"  title="Debata"><span class="box"></span>Debata</a>
               </li> -->

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