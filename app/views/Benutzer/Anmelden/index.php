<h2>
    <?php echo _("Anmeldung"); ?>
</h2>

<form action="/Benutzer/Anmelden" method="POST">
    <div class="table">
        <div class="row">
            <div class="cell">
                <label for="nick"><?php echo _("Benutzername"); ?></label>
            </div>
            <div class="cell">
                <input type="text" name="nick" class="input" id="nick" value=""/>
            </div>
        </div>
        <div class="row">
            <div class="cell">
                <label for="password"><?php echo _("Passwort"); ?></label>
            </div>
            <div class="cell">
                <input type="password" name="pass" class="input" id="password" value=""/>
            </div>
        </div>
        <div class="buttons" id="floatright">
            <a href="#" class="negative">
                <img src="/public/img/newpwd.png" alt=""/>
                <?php echo _("Passwort vergessen?"); ?>
            </a>
            <a href="/Facebook/User/Login" class="positive">
                <img src="/public/img/fb-icon.png" alt=""/>
                <?php echo _("Facebook Login"); ?>
            </a>
            <button type="submit" class="positive" id="submit" value="<?php echo _("Anmelden"); ?>"> 
                <img alt="" src="/public/img/login.png"/>
                <?php echo _("Anmelden"); ?>
            </button>
        </div>
    </div>
</form>
