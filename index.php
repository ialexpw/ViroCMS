<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $ViroLang = 'en';

    include 'app/viro.app.php';
    include 'app/lang/' . $ViroLang . '.php';

    # Simple templating
    if(Viro::LoggedIn()) {
        if(!isset($_GET['page']) || empty($_GET['page'])) {
            Viro::LoadView('dashboard');
        }else{
            Viro::LoadView($_GET['page']);
        }
    }else{
        Viro::LoadView('login');
    }
?>