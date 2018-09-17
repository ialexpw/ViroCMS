<?php
    include 'app/viro.app.php';

    # Only from CLI
    if(php_sapi_name() === 'cli') {
        # No arguments
        if(empty($argv[1])) {
            die('Missing arguments');
        }

        # Check command line
        if(strtolower($argv[1]) == 'backup') {
            Viro::Backup();
            die("Backup created.\n");
        }
    }else{
        die('CLI Only');
    }
?>