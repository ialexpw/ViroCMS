<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

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
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Viro - Overview</title>
        <!-- Spectre.css CSS -->
        <link rel="stylesheet" href="app/tpl/css/spectre.min.css">
        <link rel="stylesheet" href="app/tpl/css/spectre-exp.min.css">
        <link rel="stylesheet" href="app/tpl/css/spectre-icons.min.css">
    </head>

    <body>
        <div class="container">
            <div class="columns">
                <div class="column col-2"></div>
                <div class="column col-8">
                    <header class="navbar">
                        <section class="navbar-section">
                            <a href="#" class="btn btn-link">Docs</a>
                            <a href="#" class="btn btn-link">Examples</a>
                        </section>
                        <section class="navbar-center">
                            <h4>Viro <small class="label">CMS</small></h4>
                        </section>
                        <section class="navbar-section">
                            <a href="#" class="btn btn-link">Twitter</a>
                            <a href="#" class="btn btn-link">GitHub</a>
                        </section>
                    </header>
                </div>
                <div class="column col-2"></div>
            </div>

            <br />

            <div class="columns">
                <div class="column col-3"></div>
                <div class="column col-6">
                    <h4>Group Overview</h4>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><abbr title="Group name">Name</abbr></th>
                                <th><abbr title="Group slug">Slug</abbr></th>
                                <th><abbr title="Group owner">Owner</abbr></th>
                                <th><abbr title="Group actions">Actions</abbr></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                while($aGroup = $getGroupsRes->fetchArray(SQLITE3_ASSOC)){
                                    # Lookup the owner
                                    $getGroupOwner = $Connect->prepare('SELECT * FROM "users" WHERE id = :userid LIMIT 1');
                                    $getGroupOwner->bindValue(':userid', $aGroup['owner']);
                                    $getOwnerRes = $getGroupOwner->execute();

                                    # Fetch the array
                                    $getOwnerRes = $getOwnerRes->fetchArray(SQLITE3_ASSOC);

                                    echo '<tr>';
                                    echo '<td>' . $aGroup['name'] . '</td>';
                                    echo '<td>' . $aGroup['slug'] . '</td>';
                                    echo '<td>' . $getOwnerRes['username'] . '</td>';
                                    echo '<td>';
                                    echo '<div class="btn-group btn-group-block">';
                                    echo '<button class="btn btn-sm">View</button>';
                                    echo '<button class="btn btn-sm">Edit</button>';
                                    echo '<button class="btn btn-sm">Delete</button>';
                                    echo '</div>'; 
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="column col-3"></div>
            </div>
        </div>
    </body>
</html>