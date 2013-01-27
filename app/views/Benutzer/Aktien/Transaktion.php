<h2>
    <?php echo _("Aktien Verkaufen"); ?>
</h2>

<script>
    $(document).ready(function(){
        $('a#sell').click(function(){
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

        <?php if(!isset($view->check_anzahl)) { ?>

        <a class="positive" id="sell" href="/Benutzer/Aktien" title="<?php echo _("Zur&uuml;ck zum Kauf der Anteile."); ?>">
            <img alt="" src="/public/img/back.png"/>
            <?php echo _("Zur&uuml;ck"); ?>
        </a>

        <?php } else { ?>

        <a class="positive" href="/Aktien/Uebersicht" title="<?php echo _("Zur&uuml;ck zur &Uuml;bersicht."); ?>">
            <img alt="" src="/public/img/overview.png"/>
            <?php echo _("&Uuml;bersicht"); ?>
        </a>

        <?php } ?>

    </div>

</div>
