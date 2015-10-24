<!DOCTYPE html>
<?php

    if ( $_GET['key'] ) {
        require_once 'include/Config.php';
        require_once 'include/Database.php';
        require_once 'include/URI.php';
        $hex = bin2hex($_GET['key']);
        $db = new Database($GLOBALS['host'], $GLOBALS['user'], 
                $GLOBALS['password'], $GLOBALS['database']);
        $uri = $db->getRecord($hex);
        if (empty($uri)) $uri = "//tiny.mashio.net/";
    }
    else {
        $uri = "//tiny.mashio.net/";
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Tiny Mashio</title>
        <script>
            window.location = "<?php echo $uri ?>";
        </script>
    </head>
    <body>
    </body>
</html>
