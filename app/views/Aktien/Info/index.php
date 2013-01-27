<h2>
    <?php echo _("Echtzeit Information"); ?>
</h2>

<div class="table" style="margin-top:0;">

    <div class="cell info">
        <div id="chart" title="<?php printf(_("Hier siehst du den Echtzeitkurs von %s <br /> der jede Sekunde aktualisiert wird"), $view->firma->name); ?>"></div>
    </div>
    <div class="cell info realtime">
        <p>
            <?php printf(_("Firma: %s"), $view->firma->name); ?>
            <br/>
            <?php echo _("Letztes Update: "); ?><span id="update"></span> <?php echo _("Uhr"); ?>
        </p>

        <div class="buttons" id="floatright">
            <a class="positive" href="/Aktien/Uebersicht" title="<?php echo _("Zur&uuml;ck zur &Uuml;bersicht."); ?>">
                <img alt="" src="/public/img/overview.png"/>
                <?php echo _("&Uuml;bersicht"); ?>
            </a>
        </div>

    </div>

</div>