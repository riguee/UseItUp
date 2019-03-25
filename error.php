<?php
if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
    echo $_SESSION['message'];
else:
    header( "location: index.php" );
endif;