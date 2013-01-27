<h2>
    <?php echo _("Registrierung"); ?>
</h2>

<form action="/Benutzer/Register/Speichern" method="post">
    <div class="table">
        <div class="row">
            <div class="cell">
                <label for="nick"><?php echo _("Benutzername"); ?></label>
            </div>
            <div class="cell">
                <input type="text" id="nick" name="nick" class="input" value="<?php echo $view->benutzer->nick; ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="cell">
                <label for="mail"><?php echo _("E-Mail"); ?></label>
            </div>
            <div class="cell">
                <input type="text" id="mail" name="mail" class="input" value="<?php echo $view->benutzer->mail; ?>"/>
            </div>
        </div>
        <div class="buttons" id="floatright"> 
            <button type="submit" class="regular" value="<?php echo _("Registrieren"); ?>"> 
                <img alt="" src="/public/img/register.png"/>
                <?php echo _("Registrieren"); ?>
            </button>
        </div>
    </div>
</form>
