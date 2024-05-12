<?php
function form($method, $action, $inner){
    return <<< EOF
    <form method='$method' action='$action'>
        <fieldset>
            $inner
        </fieldset>
        <button type='submit'>Отправь меня</button>
    </form>
    EOF;
}
?>
