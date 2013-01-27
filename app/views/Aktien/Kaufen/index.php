<h2>
    <?php echo _("Aktien Kaufen"); ?>
</h2>

<?php
$kurs=$view->kurs->kurs;
$guthaben=$view->benutzer->guthaben;

if(floor($kurs) < 1)
{
$ergebnistext=_("Leider ist der Verkauf dieser Aktie <br /> vor&uuml;bergehend ausgeschlossen.");
} else {
$rechnen=$guthaben/$kurs;
$ergebnis=floor($rechnen);
$ergebnistext=sprintf(_("Mit deinem aktuellen Guthaben von %s &euro; <br /> kannst du maximal %s Anteile kaufen."), $guthaben, $ergebnis);
}
?>

<div class="table">
    <p class="title"><?php echo _("Firma"); ?>: <?php echo $view->firma->name; ?> &nbsp; <img src="/public/img/redloader.gif" id="loading"/></p>
    <div class="row normal">
        <div class="cell normal">
    <?php echo _("Mein Guthaben"); ?>: <?php echo $guthaben; ?> &euro;
    <br/>
    <?php echo _("Preis pro Aktie"); ?>: <span id="kurs"><?php echo $view->kurs->kurs; ?></span> &euro;
    <br/>
    <?php echo _("Aktualisiert um"); ?>: <span id="update"></span> Uhr
    <br/>
    <?php echo _("Verfügbare Anteile"); ?>: <?php echo $view->firma->anteile; ?>
    <div class="cell normal buy">
    <form action="/Aktien/Kaufen/Bezahlen">
         <input type="hidden" name="firma" value="<?php echo $view->firma->fid; ?>">
        <?php echo _("Anzahl"); ?>: <input type="text" name="anzahl">
            <div class="buttons buybutton">
                <button type="submit" class="positive" value="<?php echo _("Kaufen"); ?>" title="<?php echo $ergebnistext; ?>">
                    <img alt="" src="/public/img/buy.png"/>
                    <?php echo _("Kaufen"); ?>
                </button>
            </div>
    </form>
    </div>
        </div>
    </div>
</div>