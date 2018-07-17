<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include 'app/viro.app.php';

    $vApp = new Viro();

    # Simple templating
    if(!isset($_GET['page']) || empty($_GET['page'])) {
        if(Viro::LoggedIn()) {
            Viro::LoadView('overview');
        }else{
            Viro::LoadView('login');
        }
    }else{
        Viro::LoadView($_GET['page']);
    }
?>