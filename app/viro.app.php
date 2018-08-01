<?php
    # Start the session
    if(!headers_sent()) {
		session_start();
    }

    # ViroCMS Class
    class Viro {
        /*

        */
        public static function Connect() {
            $db = new SQLite3('app/db/viro.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            return $db;
        }

        /*

        */
        public static function InstallDatabase() {
            $db = new SQLite3('app/db/viro.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

            # Users table
            $db->query('CREATE TABLE IF NOT EXISTS users (
                id integer PRIMARY KEY AUTOINCREMENT,
                username varchar,
                email varchar,
                password varchar,
                read varchar,
                write varchar,
                users varchar,
                tools varchar,
                last_login varchar,
                active integer
            )');

            # Groups table
            $db->query('CREATE TABLE IF NOT EXISTS groups (
                id integer PRIMARY KEY AUTOINCREMENT,
                g_name varchar,
                g_slug varchar,
                g_hash varchar,
                g_owner integer,
                created varchar
            )');

            # Zones table
            $db->query('CREATE TABLE IF NOT EXISTS zones (
                id integer PRIMARY KEY AUTOINCREMENT,
                z_name varchar,
                z_slug varchar,
                z_hash varchar,
                g_hash varchar,
                z_owner varchar,
                created varchar
            )');

            # Content table
            $db->query('CREATE TABLE IF NOT EXISTS content (
                id integer PRIMARY KEY AUTOINCREMENT,
                content varchar,
                c_hash varchar,
                z_hash varchar,
                g_hash varchar,
                created varchar,
                edit_by varchar,
                updated varchar
            )');

            # Articles table
            $db->query('CREATE TABLE IF NOT EXISTS articles (
                id integer PRIMARY KEY AUTOINCREMENT,
                title varchar,
                author varchar,
                content varchar,
                a_hash varchar,
                created varchar,
                updated varchar,
                published integer
            )');

            # Backups table
            $db->query('CREATE TABLE IF NOT EXISTS backups (
                id integer PRIMARY KEY AUTOINCREMENT,
                title varchar,
                author varchar,
                created varchar
            )');

            $db->close();
        }

        /*

        */
        public static function GenerateData() {
            $db = new SQLite3('app/db/viro.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

            $db->exec('BEGIN');

            $adUser = password_hash("password", PASSWORD_DEFAULT);

            # Admin user
            $db->query('INSERT INTO "users" ("username", "email", "password", "read", "write", "users", "tools", "last_login", "active")
                        VALUES ("admin", "cms@viro.app", "' . $adUser . '", "on", "on", "on", "on", "0", "1")');

            # Generated group
            $db->query('INSERT INTO "groups" ("g_name", "g_slug", "g_hash", "g_owner", "created")
                        VALUES ("Main Group", "main-group", "grphash", "1", "0")');

            # Generated zone
            $db->query('INSERT INTO "zones" ("z_name", "z_slug", "z_hash", "g_hash", "z_owner", "created")
                        VALUES ("Header Zone", "header-zone", "znehash", "grphash", "1", "0")');

            # Generated content
            $db->query('INSERT INTO "content" ("content", "c_hash", "z_hash", "g_hash", "created", "edit_by", "updated")
                        VALUES ("Test Content", "conhash", "znehash", "grphash", "0", "1", "0")');

            # Generated articles
            $db->query('INSERT INTO "articles" ("title", "author", "content", "a_hash", "created", "updated")
                        VALUES ("Test Title", "1", "Test content here", "cnhash", "0", "0")');

            $db->exec('COMMIT');

            $db->close();
        }

        /*

        */
        public static function Content($content) {
            $db = new SQLite3('app/db/viro.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

            # SELECT the content
            $getContent = $db->prepare('SELECT * FROM "content" WHERE c_hash = :c_hash');
            $getContent->bindValue(':c_hash', $content);
            $getContentRes = $getContent->execute();

            # Get content
            $getContentRes = $getContentRes->fetchArray(SQLITE3_ASSOC);

            # echo the content
            echo $getContentRes['content'];
        }

        /*

        */
        public static function Permission($page) {
            $db = new SQLite3('app/db/viro.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

            $usrID = $_SESSION['UserID'];

            # SELECT the user
            $getUser = $db->prepare('SELECT * FROM "users" WHERE id = :id');
            $getUser->bindValue(':id', $usrID);
            $getUserRes = $getUser->execute();

            # Get user
            $getUserRes = $getUserRes->fetchArray(SQLITE3_ASSOC);

            # Check permission
            if($getUserRes[$page] == 'on') {
                return true;
            }else{
                return false;
            }
        }

        /*

        */
        public static function Backup() {
            return;
        }

        /*

        */
        public static function Restore($id) {
            return;
        }

        /*

        */
        public static function Translate($string, $lang) {
            echo $lang[$string];
        }

        /*

        */
        public static function Clean($string) {
            $string = str_replace(' ', '-', $string);
            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
         
            return preg_replace('/-+/', '-', $string);
         }

         /*

        */
        public static function LoggedIn() {
            if(!isset($_SESSION['UserID']) || !isset($_SESSION['Username'])) {
				return 0;
			}else{
				return 1;
			}
        }

        /*

        */
        public static function LoadView($view) {
            if(file_exists('app/tpl/' . $view . '.php')) {
                include 'app/tpl/' . $view . '.php';
            }else{
                include 'app/tpl/404.php';
            }
        }

        /*

        */
        public static function LoadPage($page) {
            header("Location: ?page=" . $page);
        }

        /*

        */
        public static function Version() {
            return "v0.1-alpha";
        }
    }
?>