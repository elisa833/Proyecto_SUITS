<?php
    session_start(); 
    session_unset();
    session_destroy();
    
    echo json_encode([1,"Session finalizada"]);
?>