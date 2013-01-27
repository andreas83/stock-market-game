<h2>
    <?php echo _("Aktien Verkaufen"); ?>
</h2>

<?php
$aktuellerkurs=$view->aktien[0]->kurs;
$gekauftbei=$view->aktien[0]->kurs;

if($gekauftbei > $aktuellerkurs) {
    $rechnen=$gekauftbei - $aktuellerkurs;
    $ergebnis=floor($rechnen);
    $text=sprintf(_("Beim Verkauf w&uuml;rdest du einen Verlust <br /> von -%s &euro; pro Aktie machen."), $ergebnis);
} 
elseif($gekauftbei == $aktuellerkurs) {
    $text=_("Beim Verkauf w&uuml;rdest du weder ein <br /> Gewinn noch Verlust verzeichen.");
} else {
    $rechnen=$aktuellerkurs - $gekauftbei;
    $ergebnis=floor($rechnen);
    $text=sprintf(_("Beim Verkauf w&uuml;rdest du einen Gewinn <br /> von +%s &euro; pro Aktie machen."), $ergebnis);
}
?>

<div class="table">
    <p class="title"><?php echo _("Firma"); ?>: <?php echo $view->aktien[0]->name; ?> &nbsp; <img src="/public/img/redloader.gif" id="loading"/></p>
    <div class="row normal">
        <div class="cell normal">
            <?php echo _("Aktueller Kurs"); ?>: <span id="kurs"><?php echo $view->aktien[0]->kurs; ?></span> <?php echo _("&euro;"); ?>
            <br/>
            <?php printf(_("Gekauft bei: %s &euro;"), $view->aktien[0]->kurs); ?>
            <br/>
            <?php echo _("Anteile"); ?>: <?php echo $view->aktien[0]->anzahl; ?>
            <br/>
            <?php echo _("Letztes Update"); ?>: <span id="update"></span> <?php echo _("Uhr"); ?>
            <div class="cell normal buy">
                <form action="/Benutzer/Aktien/Transaktion">
                    <input type="hidden" name="aid" value="<?php echo $view->aktien[0]->aid; ?>"/>
                    <?php echo _("Anzahl"); ?> : <input type="text" name="anzahl" value="<?php echo $view->aktien[0]->anzahl; ?>"/>
                    <div class="buttons moneybutton">
                        <button type="submit" class="positive" value="<?php echo _("Verkaufen"); ?>" title="<?php echo $text; ?>">
                            <img alt="" src="/public/img/money.png"/>
                            <?php echo _("Verkaufen"); ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
