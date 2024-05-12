<?php
function require_rel($d,$path){
    require_once realpath($d . '/' . $path);
}
