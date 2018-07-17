<?php
    include 'app/viro.app.php';

    $vApp = new Viro();

    Viro::InstallDatabase();
    Viro::GenerateData();
?>