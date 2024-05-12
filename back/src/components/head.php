<?php

function head($title, $inner_body){
    return <<< EOF
<!DOCTYPE html>
<html lang="en">
        <head>
            <meta charset='utf-8'>
            <title>$title</title>
            <link rel="stylesheet" href="/main.css"/>
        </head>
        <body>
            $inner_body
        </body>
</html>
EOF;
}
?>