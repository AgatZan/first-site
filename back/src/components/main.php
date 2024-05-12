<?php

function main($inner_h1, $inner_section){
    return <<< EOF
<article class='main'>
    <header>
        <h1 class='title'>$inner_h1</h1>
    </header>
    <section class='tail'>
        $inner_section
    </section>
</article>
EOF;
}
