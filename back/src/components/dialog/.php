<?php
    function dialog($header, $body, $input, $class='dialog'){
        return <<< EOF
            <article class=$class>
                $header
                $body
                $input
            </article>
        EOF;
    }
    function dialog_body($id, $messanges, $plugins=''){
        return <<< EOF
            <article class='dialog__body'>
                <section class='dialog__message'>
                    $messanges
                </section>
            </article>
        EOF;
    }
    function dialog_input($id, $plugins=''){
        return <<< EOF
        <section class='dialog__input'>
            <div action='/api/message/$id' contenteditable="true"  id='messanger__text'></div>
            <button class='sender'><svg aria-hidden="true" display="block" class="vkuiIcon vkuiIcon--24 vkuiIcon--w-24 vkuiIcon--h-24 vkuiIcon--send_24" viewBox="0 0 24 24" width="24" height="24" style="width: 24px; height: 24px;"><use xlink:href="#send_24" style="fill: currentcolor;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="send_24"><g fill="none" fill-rule="evenodd"><path d="M0 0h24v24H0z"></path><path fill="currentColor" d="M5.739 15.754q-1.029 2.782-1.293 3.91c-.553 2.362-.956 2.894 1.107 1.771 2.062-1.122 12.046-6.683 14.274-7.919 2.904-1.611 2.942-1.485-.156-3.196-2.36-1.302-12.227-6.718-14.118-7.782-1.892-1.063-1.66-.59-1.107 1.772q.268 1.142 1.311 3.944a4 4 0 0 0 2.988 2.531l5.765 1.117a.1.1 0 0 1 0 .196l-5.778 1.116a4 4 0 0 0-2.993 2.54"></path></g></svg></use></svg></button>
            $plugins
        </section>
        EOF;
    }
    function dialog_header($dialog_info, $dialog_info_detailed_endpoint, $image, $plugins=''){
        return <<< EOF
            <article class='dialog__header'>
                <a href='$dialog_info_detailed_endpoint' class='dialog__info-panel'>
                    <img src='/data/img/$image' class='dialog__cover' loading='lazy'>
                    $dialog_info
                </a>
                $plugins
            </article>
        EOF;
    }
    function dialog_info($dialog_name, $author_name){
        return <<< EOF
            <section class='dialog__info'>
                <h1 class='dialog__name'>$dialog_name</h1>
                <h2 class='dialog__author'>$author_name</h2>
            </section>
        EOF;
    }
    