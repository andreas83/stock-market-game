<h2>
    <?php echo _('Registrierung'); ?>
</h2>

<form action="/Facebook/User/Register" method="post">
    <div class="table">
        <div class="row error">
            <div class="cell error">
                <?php
                if(count($view->result)!=0)
                foreach($view->result as $result)
                {
                    echo $result."<br/>";
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="cell">
                <label for="nick"><?php echo _('Benutzername'); ?></label>
            </div>
            <div class="cell">
                <input type="text" id="nick" name="nick" class="input" value="<?php echo $view->fbuser['first_name']; ?>" />
            </div>
        </div>
        <div class="buttons" id="floatright">
            <button type="submit" class="regular" value="Registrieren">
                <img alt="" src="/public/img/register.png" />
                <?php echo _('Registrieren'); ?>
            </button>
        </div>
    </div>
</form>
