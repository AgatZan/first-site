<?php
    function user_head($inner, $link){
        return <<< EOL
            <header>
                <a href='$link'>
                    $inner
                </a>
            </header>
        EOL;
    }
?>