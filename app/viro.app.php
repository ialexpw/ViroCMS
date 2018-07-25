<?php
    # Start the session
    if(!headers_sent()) {
		session_start();
    }
    
    # ViroCMS Class
    class Viro {
        public static function Connect() {
            $db = new SQLite3('app/db/viro.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

            return $db;
        }

        public static function InstallDatabase() {
            $db = new SQLite3('app/db/viro.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

            # Users table
            $db->query('CREATE TABLE IF NOT EXISTS users (
                id integer PRIMARY KEY AUTOINCREMENT,
                username varchar,
                email varchar,
                password varchar,
                level integer,
                last_login varchar,
                active integer
            )');

            # Groups table
            $db->query('CREATE TABLE IF NOT EXISTS groups (
                id integer PRIMARY KEY AUTOINCREMENT,
                name varchar,
                slug varchar,
                hash varchar,
                owner integer,
                created varchar
            )');

            # Zones table
            $db->query('CREATE TABLE IF NOT EXISTS zones (
                id integer PRIMARY KEY AUTOINCREMENT,
                name varchar,
                slug varchar,
                hash varchar,
                group_id integer,
                created varchar
            )');

            # Content table
            $db->query('CREATE TABLE IF NOT EXISTS content (
                id integer PRIMARY KEY AUTOINCREMENT,
                content varchar,
                hash varchar,
                zone_id integer,
                group_id integer,
                created varchar,
                updated varchar
            )');

            # Articles table
            $db->query('CREATE TABLE IF NOT EXISTS articles (
                id integer PRIMARY KEY AUTOINCREMENT,
                title varchar,
                author varchar,
                content varchar,
                hash varchar,
                created varchar,
                updated varchar
            )');

            $db->close();
        }

        public static function GenerateData() {
            $db = new SQLite3('app/db/viro.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

            $db->exec('BEGIN');

            $adUser = password_hash("password", PASSWORD_DEFAULT);

            # Admin user
            $db->query('INSERT INTO "users" ("username", "email", "password", "level", "last_login", "active")
                        VALUES ("admin", "cms@viro.app", "' . $adUser . '", "5", "0", "1")');

            # Generated group
            $db->query('INSERT INTO "groups" ("name", "slug", "hash", "owner", "created")
                        VALUES ("Main Group", "main-group", "grphash", "1", "0")');

            # Generated zone
            $db->query('INSERT INTO "zones" ("name", "slug", "hash", "group_id", "created")
                        VALUES ("Header Zone", "header-zone", "znehash", "1", "0")');

            # Generated content
            $db->query('INSERT INTO "content" ("content", "hash", "zone_id", "group_id", "created")
                        VALUES ("Test Content", "conhash", "1", "1", "0")');

            $db->exec('COMMIT');

            $db->close();
        }

        public static function LoggedIn() {
            if(!isset($_SESSION['Logged_In']) || !isset($_SESSION['User'])) {
				return 0;
			}else{
				return 1;
			}
        }

        public static function LoadView($view) {
            if(file_exists('app/tpl/' . $view . '.php')) {
                include 'app/tpl/' . $view . '.php';
            }else{
                include 'app/tpl/404.php';
            }
        }

        public static function LoadPage($page) {
            header("Location: ?page=" . $page);
        }

        public static function Version() {
            return "v0.1-alpha";
        }
    }
?>