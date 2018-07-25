<?php
    $Connect = Viro::Connect();

    # SELECT Groups
    $getGroups = $Connect->prepare('SELECT * FROM "groups"');
    $getGroupsRes = $getGroups->execute();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="index, follow">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Viro - Create Group</title>        
        <link rel="stylesheet" href="app/tpl/css/siimple.css">
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
            <div class="siimple-jumbotron-title">Welcome!</div>
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
                                <div class="siimple-list-title">Dashboard</div>
                            </div>
                            <div class="siimple-list-item">
                                <div class="siimple-list-title">Content</div>
                            </div>
                            <div class="siimple-list-item">
                                <div class="siimple-list-title">Articles</div>
                            </div>
                            <div class="siimple-list-item">
                                <div class="siimple-list-title">User management</div>
                            </div>
                            <div class="siimple-list-item">
                                <div class="siimple-list-title">Backup &amp; restore</div>
                            </div>
                        </div>
                    </div>

                    <div class="siimple-grid-col siimple-grid-col--9">
                        <div class="siimple-breadcrumb">
                            <div class="siimple-breadcrumb-item">Dashboard</div>
                            <div class="siimple-breadcrumb-item">Create group</div>
                        </div>

                        <!-- Break line -->
                        <div class="siimple-rule"></div>

                        <div class="siimple-field">
                            <div class="siimple-field-label">Group name</div>
                            <input type="text" class="siimple-input siimple-input--fluid" placeholder="Example group">
                            <div class="siimple-field-helper">This field can't be empty</div>
                        </div>
                        <div class="siimple-field">
                            <div class="siimple-btn siimple-btn--blue">Create group</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="siimple-footer siimple-footer--extra-large">
            &copy; 2018 ViroCMS.
        </div>
    </body>
</html>