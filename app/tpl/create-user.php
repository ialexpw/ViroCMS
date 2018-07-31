<?php
    $Connect = Viro::Connect();

    # Permissions
    if(!Viro::Permission('users')) {
        Viro::LoadPage('access');
    }

    # POSTing the form
    if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        # New user details
        $usr = $_POST['username'];
        $eml = $_POST['email'];
        $psw = password_hash($_POST['password'], PASSWORD_DEFAULT);

        # Current time
        $ts = time();

        # Insert the user
        $stmt = $Connect->prepare('INSERT INTO "users" ("username", "email", "password", "read", "write", "users", "tools", "last_login", "active")
                    VALUES (:username, :email, :password, "on", "off", "off", "off", "0", "' . $ts . '")');

        # Bind
        $stmt->bindValue(':username', $usr);
        $stmt->bindValue(':email', $eml);
        $stmt->bindValue(':password', $psw);
        $stmt->execute();

        Viro::LoadPage('users');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="index, follow">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ViroCMS - Create Group</title>

        <!-- Styles -->
        <link rel="stylesheet" href="app/tpl/css/siimple.css">
        <link rel="stylesheet" href="app/tpl/css/all.css">
        <link rel="stylesheet" href="app/tpl/css/viro.css">
    </head>

    <body>
        <div class="siimple-navbar siimple-navbar--extra-large siimple-navbar--dark">
            <div class="siimple-navbar-title">ViroCMS</div>
            <div class="siimple--float-right">
                <div class="siimple-navbar-item">Profile</div>
                <div class="siimple-navbar-item">Logout</div>
            </div>
        </div>

        <div class="siimple-jumbotron siimple-jumbotron--extra-large siimple-jumbotron--light">
            <div class="siimple-jumbotron-title">Create user</div>
            <div class="siimple-jumbotron-detail">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  
            </div>
        </div>

        <div class="siimple-content siimple-content--extra-large">
            <div class="siimple-grid">
                <div class="siimple-grid-row">
                    <div class="siimple-grid-col siimple-grid-col--3">
                        <div class="siimple-list siimple-list--hover">
                            <div class="siimple-list-item">
                                <a href="?page=dashboard">
                                    <div class="siimple-list-title">Dashboard <div class="siimple--float-right"><i class="fas fa-home"></i></div></div>
                                </a>
                            </div>
                            <div class="siimple-list-item">
                                <a href="?page=content">
                                    <div class="siimple-list-title">Content <div class="siimple--float-right"><i class="far fa-edit"></i></div></div>
                                </a>
                            </div>
                            <div class="siimple-list-item">
                                <a href="?page=articles">
                                    <div class="siimple-list-title">Articles <div class="siimple--float-right"><i class="far fa-newspaper"></i></div></div>
                                </a>
                            </div>
                            <div class="siimple-list-item">
                                <a href="?page=users">
                                    <div class="siimple-list-title">User management <div class="siimple--float-right"><i class="far fa-user-circle"></i></div></div>
                                </a>
                            </div>
                            <div class="siimple-list-item">
                                <a href="?page=tools">
                                    <div class="siimple-list-title">Backup &amp; restore <div class="siimple--float-right"><i class="fas fa-sync-alt"></i></div></div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="siimple-grid-col siimple-grid-col--9">
                        <div class="siimple-breadcrumb">
                            <div class="siimple-breadcrumb-item">Dashboard</div>
                            <div class="siimple-breadcrumb-item">Users</div>
                            <div class="siimple-breadcrumb-item">Create</div>
                        </div>

                        <!-- Break line -->
                        <div class="siimple-rule"></div>

                        <form action="?page=create-user" method="post">
                            <div class="siimple-field">
                                <div class="siimple-field-label">Username</div>
                                <input type="text" class="siimple-input" style="width:375px;" name="username" placeholder="jdoe1">
                                <!--<div class="siimple-field-helper">This field cannot be empty or contain special characters</div>-->
                            </div>
                            <div class="siimple-field">
                                <div class="siimple-field-label">Email</div>
                                <input type="email" class="siimple-input" style="width:375px;" name="email" placeholder="jdoe@example.com">
                                <!--<div class="siimple-field-helper">This field cannot be empty or contain special characters</div>-->
                            </div>
                            <div class="siimple-field">
                                <div class="siimple-field-label">Password</div>
                                <input type="password" class="siimple-input" style="width:375px;" name="password" placeholder="jdoe123">
                                <!--<div class="siimple-field-helper">This field cannot be empty or contain special characters</div>-->
                            </div>
                            <div class="siimple-field">
                                <button type="submit" class="siimple-btn siimple-btn--blue" value="Create group">Create user</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="siimple-footer siimple-footer--extra-large">
            &copy; 2018 ViroCMS - <?php echo Viro::Version(); ?>.
        </div>
    </body>
</html>