

<html >

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta property="og:title" content="Програм Недеље парламентаризма"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="http://www.nedeljaparlamentarizma.rs/program/"/><meta property="og:site_name" content="Nedelja Parlamentarizma"/><meta property="og:image" content="http://nedeljaparlamentarizma.rs/wp-content/uploads/2016/11/np.png"/>

    
    <title>Програм Недеље парламентаризма</title>
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta http-equiv="Content-Script-Type" content="text/javascript">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="title" content="Program Nedelje parlamentarizma">
    
   
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-custom.css">
   
    <link href="//fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="style2.css?4">
    <link href="data:;base64,iVBORw0KGgo=" type="image/png">
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    
    
    
    <link rel="stylesheet" type="text/css" href="style.css">
    </style>
</head>

<body id="main-one" class="body-home body-embed">
    <!-- <div id="tip"><img src="/loading.gif" height="24" alt="Loading…"></div> -->
    <div id="body-outer">
        <div id="body" class="container container-noheader">
            <div id="body-inner">
                <div id="page-home" class="row">
                    <div id="top"></div>
                    <?php 

                    $active_link = "raspored"; 
                    include 'menu.php';

                    ?>

                    <div id="content-outer">
                        <div id="content" class="col-md-9">
                           <script type="text/javascript">
                               $("#content").load("content.php")
                           </script>
                        </div>
                    </div>
                    <div id="sidebar-outer">
                        <div id="sidebar" class="col-md-3">
                            <div id="sidebar-inner">

                            </div>
                           <script type="text/javascript">
                               $("#sidebar-inner").load("sidebar.php")
                           </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer-link" style="width:auto;text-align:center">
     
    </div>
    
    <div id="footer-external"></div>
  
    <script type="text/javascript" src="main.js"></script>
</body>

</html>
