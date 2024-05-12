<?php
function dialog_panel($els, $dialog_open=''){
    return <<< EOF
    <article id='dialogs'>
        $els
        <div class='placeholder'><i class='fag'>+</i></div>
        <dialog id='dialog-creator' class='disable'>
            <form method='post' action='/api/dialog'>
                <fieldset>
                    <legend>Add Major</legend>
                    <label for='dialogName'>
                        Название диалога: 
                        <input type='text' name='dialogName' value='Диалог'>
                    </label>
                    <label for='cover'>
                        Название диалога: 
                        <input type='file' name='cover'>
                    </label>
                </fieldset>
                <button type='submit'>Создать</button>
            </form>
        </dialog>
        <dialog id='dialog-open' class='disable'>
            $dialog_open
        </dialog>
        <script src='/src/js/add_dialog.js'></script>
    </article>
EOF;
}
function dialog_el($elem){
    $dialog_name = $elem['dialogName'];
    $image = $elem['coverHash'];
    $author = $elem['authorName'];
    $dialog_id = $elem['dialogID'];
    return <<< EOF
        <article class='dialog'>
            <a href='/api/dialog/$dialog_id/view' class='dialog__view-link'>
                <img src='/data/img/$image'>
                <p class='dialog__author_el'>$author</p>
                <p class='dialog__name'>$dialog_name</p>
            </a>
        </article>
    EOF;
}