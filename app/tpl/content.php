<?php
    $Connect = Viro::Connect();

    # SELECT Groups
    $getGroups = $Connect->prepare('SELECT * FROM "groups"');
    $getGroupsRes = $getGroups->execute();

    # Deleting a group
    if(isset($_GET['del']) && !empty($_GET['del'])) {
        # Group hash
        $rmHash = $_GET['del'];

        # Remove the group
        $rmGrp = $Connect->prepare('DELETE FROM "groups" WHERE g_hash = :g_hash');
        $rmGrp->bindValue(':g_hash', $rmHash);
        $rmGrp->execute();

        Viro::LoadPage('content');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="index, follow">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ViroCMS - Content</title>

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
            <div class="siimple-jumbotron-title">Content - Groups</div>
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
                        <!-- Breadcrumb menu -->
                        <div class="siimple-breadcrumb">
                            <div class="siimple-breadcrumb-item">Dashboard</div>
                            <div class="siimple-breadcrumb-item">Content</div>
                        </div>

                        <!-- Break line -->
                        <div class="siimple-rule"></div>

                        <a href="?page=create-group"><div class="siimple-btn siimple-btn--primary">Create Group</div></a><br /><br />
                        <div class="siimple-table siimple-table--striped">
                            <div class="siimple-table-header">
                                <div class="siimple-table-row">
                                    <div class="siimple-table-cell">Name</div>
                                    <div class="siimple-table-cell">Slug</div>
                                    <div class="siimple-table-cell">Owner</div>
                                    <div class="siimple-table-cell">Options</div>
                                </div>
                            </div>
                            <div class="siimple-table-body">
                                <?php
                                    while($aGroup = $getGroupsRes->fetchArray(SQLITE3_ASSOC)){
                                        # Lookup the owner
                                        $getGroupOwner = $Connect->prepare('SELECT * FROM "users" WHERE id = :userid LIMIT 1');
                                        $getGroupOwner->bindValue(':userid', $aGroup['g_owner']);
                                        $getOwnerRes = $getGroupOwner->execute();

                                        # Fetch the array
                                        $getOwnerRes = $getOwnerRes->fetchArray(SQLITE3_ASSOC);

                                        echo '<div class="siimple-table-row">';
                                        echo '<div class="siimple-table-cell">' . $aGroup['g_name'] . '</div>';
                                        echo '<div class="siimple-table-cell">' . $aGroup['g_slug'] . '</div>';
                                        echo '<div class="siimple-table-cell">' . $getOwnerRes['username'] . '</div>';
                                        echo '<div class="siimple-table-cell"><a href="?page=content-zones&hash=' . $aGroup['g_hash'] . '">View Zones</a> | <a href="?page=content&del=' . $aGroup['g_hash'] . '">Delete</a></div>';
                                        echo '</div>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="siimple-footer siimple-footer--extra-large">
            &copy; 2018 ViroCMS - <?php echo Viro::Version(); ?>.
        </div>
    </body>
</html>