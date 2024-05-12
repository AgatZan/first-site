<?php
if (empty($_SESSION))
    return require VUE . 'auth.php'; 
require COMPONENTS . 'head.php';
require COMPONENTS . 'main.php';
return head(
    'Chat'
    , require_once VUE . 'dialogs.php'
);

