<?php
function form_with_err($method, $action, $reg, $inner, $err){
    return <<< EOF
    <form method='$method' action='$action'>
        <fieldset>
            <legend>$err</legend>
            $inner
        </fieldset>
        <button type='submit'>Отправь меня</button>
    </form>
    EOF;
}
