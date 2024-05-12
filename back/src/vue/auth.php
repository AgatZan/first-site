<?php
require_once COMPONENTS . 'head.php';
return head(
    'AUTH'
    , <<< EOF
        <section>
            <form method='GET' action='/' id='auth'>
            <fieldset>
                <legend>'Авторизация'</legend>
                <label for='userName'>
                    Введите имя: <input value='Аноним' name='userName' type='text'>
                </label>
            </fieldset>
                <button type='submit'>Войти</button>
            </form>
        </section>
        <script src='src/js/auth.js'></script>
    EOF
);