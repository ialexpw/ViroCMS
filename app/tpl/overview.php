<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if(!Viro::LoggedIn()) {
        //Viro::LoadView('login');
    }

    $Connect = Viro::Connect();

    # SELECT Groups
    $getGroups = $Connect->prepare('SELECT * FROM "groups"');
    $getGroupsRes = $getGroups->execute();
?>
<!DOCTYPE html>
<html class="has-navbar-fixed-top">
    <head>
        <title>Viro - Overview</title>
        <link rel="stylesheet" href="app/tpl/css/bulma.min.css">
        <script defer src="app/tpl/js/fontawesome.js"></script>
    </head>

    <body>
<nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
<div class="navbar-brand">
<a class="navbar-item" href="https://bulma.io">
<img src="https://bulma.io/images/bulma-logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
</a>

<a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
<span aria-hidden="true"></span>
<span aria-hidden="true"></span>
<span aria-hidden="true"></span>
</a>
</div>

<div id="navbarExampleTransparentExample" class="navbar-menu">
<div class="navbar-start">
<a class="navbar-item" href="https://bulma.io/">
Home
</a>
<div class="navbar-item has-dropdown is-hoverable">
<a class="navbar-link" href="/documentation/overview/start/">
Docs
</a>
<div class="navbar-dropdown is-boxed">
<a class="navbar-item" href="/documentation/overview/start/">
Overview
</a>
<a class="navbar-item" href="https://bulma.io/documentation/modifiers/syntax/">
Modifiers
</a>
<a class="navbar-item" href="https://bulma.io/documentation/columns/basics/">
Columns
</a>
<a class="navbar-item" href="https://bulma.io/documentation/layout/container/">
Layout
</a>
<a class="navbar-item" href="https://bulma.io/documentation/form/general/">
Form
</a>
<hr class="navbar-divider">
<a class="navbar-item" href="https://bulma.io/documentation/elements/box/">
Elements
</a>
<a class="navbar-item is-active" href="https://bulma.io/documentation/components/breadcrumb/">
Components
</a>
</div>
</div>
</div>

<div class="navbar-end">
<div class="navbar-item">
<div class="field is-grouped">
<p class="control">
<a class="bd-tw-button button" data-social-network="Twitter" data-social-action="tweet" data-social-target="http://localhost:4000" target="_blank" href="https://twitter.com/intent/tweet?text=Bulma: a modern CSS framework based on Flexbox&amp;hashtags=bulmaio&amp;url=http://localhost:4000&amp;via=jgthms">
<span class="icon">
<i class="fab fa-twitter"></i>
</span>
<span>
Tweet
</span>
</a>
</p>
<p class="control">
<a class="button is-primary" href="https://github.com/jgthms/bulma/releases/download/0.7.1/bulma-0.7.1.zip">
<span class="icon">
<i class="fas fa-download"></i>
</span>
<span>Download</span>
</a>
</p>
</div>
</div>
</div>
</div>
</nav>
        <section class="section">
            <div class="container">
                <h4 class="title is-4">Group Overview</h4>
                <table class="table is-bordered is-striped is-hoverable is-fullwidth">
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
                                echo '<tr>';
                                echo '<td>' . $aGroup['name'] . '</td>';
                                echo '<td>' . $aGroup['slug'] . '</td>';
                                echo '<td>' . $aGroup['owner'] . '</td>';
                                echo '<td>Test</td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </body>
</html>