<?php 


    function listaMesta($podaci)
    {
        $samo_gradovi = array_map(function ($el)
        {
            return $el->grad;
        } , $podaci);

        $samo_gradovi = array_unique($samo_gradovi);

        return $samo_gradovi;      
    }


    function ucesnik( $value='' )
    {

        $slika_ucesnika = "https://placeholdit.imgix.net/~text?txtsize=28&bg=0099ff&txtclr=ffffff&txt=Neki kul header ovde&w=320&h=320&fm=png";
        $link_ucesnik ="http://www.google.com";
        $ime_ucesnika = "Mario Maric";
        $biografija = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est hic error cum quia, minus impedit voluptatibus laborum deleniti ab ipsum vitae quasi ratione, soluta tempora fugiat nostrum totam odit a!";

        return <<<ORD
            <div class="ucesnik">
                <a  href="$link_ucesnik">
                    <img class="avatar" src="$slika_ucesnika" alt="avatar">                            
                </a>
                <h2><a href="$link_ucesnik">$ime_ucesnika</a></h2>
               
                <div class="event-details-role-bio">$biografija</div>
            </div>

ORD;
    }

    function detalji_eventa( $id_event )
    {


        $opis_dogadjaja ="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est hic error cum quia, minus impedit voluptatibus laborum deleniti ab ipsum vitae quasi ratione, soluta tempora fugiat nostrum totam odit a!";
        
        $koordinate_mesta = "20, 44";

        $korisnici = "";

        for ($i=0; $i < rand(2,7) ; $i++) { 
            $korisnici .= ucesnik();
        } 


        $temp_sadrzaj = <<<TEMP_SADR

        <div class="">
    
            <hr style="clear:both">

            <div class="tip-roles">
                
                <div class="event-details-roles has-avatars">
                    
                    <div class="scrollable-details">
                        <div class="tip-description">
                        $opis_dogadjaja
                        </div>
                    </div>
                    
                    <hr style="clear:both">

                    <strong>Učesnici</strong>
                    
                    $korisnici    

                </div>
                <br class="s-clr">
            </div>
            <hr style="clear:both">
            
            <div class="event-type">
                $koordinate_mesta
            </div>
            
        </div>

TEMP_SADR;

    return $temp_sadrzaj;
    }


    function boja_i_grad( $grad_val='' )
    {
        #problem je kako numerisati boje kad im se salje samo jedna vrednost
        
        # verovatno treba niz svih gradova i, na osnovu indeksa staviti da bude ta boja 

        /*$grad_val = strtolower($grad_val);
        $grad_val = str_replace(' ','_',$grad_val);
        //replace ćčšžđ
        $grad_val = str_replace(array('ć','č','š','ž','đ'), array('c','c','s','z','dj'), $grad_val);*/

        $temp_vals =  array( );

        switch ($grad_val) {
            case "Beograd": $boja = 'boja1'; $mesto="beograd";  break;
            case "Nis": $boja = 'boja2'; $mesto="nis"; break;
            case "Subotica": $boja = 'boja3'; $mesto="subotica"; break;
            case "Novi Sad": $boja = 'boja4'; $mesto="novi_sad"; break;
            case "Uzice": $boja = 'boja5'; $mesto="uzice"; break;
            case "Prijepolje": $boja = 'boja6'; $mesto="prijepolje"; break;
            case "Leskovac": $boja = 'boja7'; $mesto="leskovac"; break;
             
            default:
                    # code...
                    break;
        }   

        $temp_vals[] = $boja;
        $temp_vals[] = $mesto;

        return $temp_vals;

    }

?>