<h2>
    <?php echo _("Aktien Kaufen"); ?>
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

        <a class="positive" href="/Aktien/Uebersicht" title="<?php echo _("Zur&uuml;ck zur &Uuml;bersicht."); ?>">
            <img alt="" src="/public/img/overview.png"/>
            <?php echo _("&Uuml;bersicht"); ?>
        </a>

        <a class="positive" id="sell" href="/Aktien/Kaufen" title="<?php echo _("Zur&uuml;ck zum Kauf der Anteile."); ?>">
            <img alt="" src="/public/img/back.png"/>
            <?php echo _("Zur&uuml;ck"); ?>
        </a>

    </div>

</div>