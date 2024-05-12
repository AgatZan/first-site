<?php
function major_add_form($api_add){
    return <<< EOF
        <section>
            <form id='major_id' method='POST' action='$api_add'>
                <fieldset>
                    <legend>Add Major</legend>
                    <label for='majorName'>Major Name:
                        <input type='text' maxlength='250' id='majorName' name='majorName' />
                    </label>
                </fieldset>
                <button type='submit'>Add</button>
            </form>
        </section>
    EOF;
}

