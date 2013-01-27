<h2>
    <?php echo _("Neues Passwort"); ?>
</h2>

<script>
    $(document).ready(function(){
        $('a#newpass').click(function(){
            parent.history.back();
            return false;
        });
    });
</script>

<div class="table">
    <p class="title"><?php echo _("Information"); ?></p>
    <div class="row normal">
        <div class="cell normal">
            <?php echo $view->result; ?>
        </div>
    </div>

    <div class="buttons" id="floatright">
        <a class="positive" id="newpass" href="/Benutzer/Profil" title="<?php echo _("Zur&uuml;ck zum Profil"); ?>">
            <img alt="" src="/public/img/back.png"/>
            <?php echo _("Zur&uuml;ck"); ?>
        </a>
    </div>

</div>
