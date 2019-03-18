<?php
if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
    echo $_SESSION['message'];
else:
    header( "location: Login.php" );
endif;