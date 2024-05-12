<?php
function user_panel($main, $redact, $quit){
    return <<< EOF
        <div class='user-panel'>
            <a href='$main'>На главную</a>
            <a id='redact' href='$redact'>Редактировать</a>
            <a href='$quit'>Выйти</a>
        </div>
    EOF;
}
?>