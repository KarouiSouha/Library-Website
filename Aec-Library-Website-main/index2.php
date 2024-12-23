<?php
    session_start();
    if(!isset($_SESSION['nom'])){
        header('Location: index.phtml');
    }

    include "index2.phtml";

?>