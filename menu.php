<?php 

$ucesnici = "menu-link";
$raspored = "menu-link";


   
if($active_link =="raspored"  )
  {
    $raspored = "menu-link-active";    
    $ucesnici = "menu-link";
  }
else if($active_link =="ucesnici"  ){
  $ucesnici = "menu-link-active";  
  $raspored = "menu-link";
}
?>
<div id="container-header-menu">
      <ul>
          <li id="menu-link-schedule" class="menu-link">              
                  <a href="index.php" class="<?php echo $raspored; ?>">Распоред</a>
                  
              
          </li>
          <li id="menu-speakers" class="<?php echo $ucesnici; ?>"><a href="ucesnici.php" class="">Говорници</a></li>
          


          <li class="menu-link" id="menu-search">
              <script type="text/javascript">
                 $( "#menu-search" ).load( "lista.php");
             </script>
          </li>


          <li class="share">
              
                  <a style="border: none;" href="https://www.facebook.com/sharer/sharer.php?display=popup&ref=plugin&src=like&u="
                     onclick="javascript:window.open(this.href + window.location.href.replace('#','%23'), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                     target="_blank" title="Share on Facebook"><img class="socialImg" src="img/fb.png"  style="width: 42px;">
                  </a>
          
                  <a style="border: none;" href="https://twitter.com/intent/tweet?text=#nedeljaparlamentarizma&tw_p=tweetbutton&url="
                     onclick="javascript:window.open( this.href +  window.location.href.replace('#','%23') + '&original_referer=' +  window.location.href.replace('#','%23') , '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                     target="_blank" title="Share on Twitter"><img class="socialImg" src="img/tw.jpg" style="width: 42px;">
                  </a>
          </li>
      </ul>
      <br class="s-clr">
  </div>
