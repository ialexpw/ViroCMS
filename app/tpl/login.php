<?php
    if(Viro::LoggedIn()) {
        Viro::LoadView('overview');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Viro - Login</title>
        <link rel="stylesheet" href="app/tpl/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
    </head>

    <body>
        <p>Login</p>
        <section class="section">
            <div class="container">
                <h1 class="title">
                    Hello World
                </h1>
                <p class="subtitle">
                    My first website with <strong>Bulma</strong>!
                </p>

                <a class="button">
                    Button
                </a>

                <a class="button is-primary">
                    Primary button
                </a>

                <a class="button is-large">
                    Large button
                </a>

                <a class="button is-loading">
                    Loading button
                </a>
            </div>
        </section>
    </body>
</html>