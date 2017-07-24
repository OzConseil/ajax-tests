<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Ajax tests</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="scripts.js"></script>
</head>

<body>
<div class="title">
    <h1>Ajax tests</h1>
</div>

<div class="content">
    <div class="commands">
        <h2>Commands</h2>

        <h3>Say Hello</h3>
        <form id="sayHelloForm" action="ajax.php" method="post">
            <input type="hidden" name="action" value="say-hello">
            <input type="submit" value="Test">
        </form>

        <h3>Get page content</h3>
        <form id="getPageContent" action="ajax.php" method="post">
            <input type="hidden" name="action" value="get-page-content">
            <input type="text" name="page-url" placeholder="Enter the page url here" size="50"><br />
            <input type="submit" value="Test">
        </form>

        <h3>PHP debug</h3>
        <form id="phpDebug" action="ajax.php" method="post">
            <input type="hidden" name="action" value="php-debug">
            <input type="submit" value="Test">
        </form>

        <h3>Undefined command</h3>
        <form id="undefinedCommand" action="ajax.php" method="post">
            <input type="hidden" name="action" value="undefined-command">
            <input type="submit" value="Test">
        </form>
    </div>

    <div class="results">
        <h2>Result</h2>

        <div id="statusWrapper">
            <h3>Status : </h3>
            <p></p>
        </div>

        <div id="messageWrapper">
            <h3>Message : </h3>
            <p></p>
        </div>

        <div id="dataWrapper">
            <h3>Data : </h3>
            <pre></pre>
        </div>

        <div id="debugWrapper">
            <h3>Debug : </h3>
            <div></div>
        </div>
    </div>
</div>
</body>
</html>
