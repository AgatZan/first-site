<?php
    function message($author, $text, $update, $create){
        return <<< EOF
            <article class='message'>
                <h4 class='message__author'>$author</h4>
                <p class='message__text'>$text</p>
                <p class='message__create'>$create</p>
                <p class='message__update'>$update</p>
            </article>
        EOF;
    }