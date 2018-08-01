<?php
    /**
     * install.php
     *
     * Installer for ViroCMS, creating the SQLite database and tables
     *
     * @package    ViroCMS
     * @author     Alex White (https://github.com/ialexpw)
     * @copyright  2018 ViroCMS
     * @license    https://github.com/ialexpw/ViroCMS/blob/master/LICENSE  MIT License
     * @link       https://viro.app
     */

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include 'app/viro.app.php';

    $vApp = new Viro();

    Viro::InstallDatabase();
    Viro::GenerateData();
?>