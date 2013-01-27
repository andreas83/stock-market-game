<h2>
    <?php echo _("Mein Markt"); ?>
</h2>

<?php if (!$view->aktien) { ?>

    <div class="table">
        <p class="title"><?php echo _("Information"); ?></p>
        <div class="row normal">
            <div class="cell normal">
                <?php echo _("Keine Aktien in der &Uuml;bersicht vorhanden."); ?>
            </div>
        </div>
        
    <div class="buttons" id="floatright">
        <a class="positive" id="sell" href="/Aktien/Uebersicht" title="<?php echo _("Aktien kaufen?"); ?>">
            <img alt="" src="/public/img/buy.png"/>
            <?php echo _("Marktplatz"); ?>
        </a>
    </div>        
        
    </div>

<?php } else { ?>

    <table class="overview">
        <tr>
            <td class="heading"><?php echo _("Firma"); ?></td>
            <td class="heading"><?php echo _("Anteile"); ?></td>
            <td class="heading"><?php echo _("Gekauft bei"); ?></td>
            <td class="heading"><?php echo _("Aktueller Kurs"); ?></td>
            <td class="heading"><?php echo _("Trend"); ?></td>
            <td class="heading" style="width:106px;"><?php echo _("Aktion"); ?></td>
        </tr>

        <?php
        $i = 0;
        $kurs = "";
        foreach ($view->aktien as $row) {

            $view->kurs->getStocks($row->fid);
            $class = ($i++ % 2 == 0 ? "tablerow2" : "tablerow1");

            $aktuellerkurs=$view->kurs->kurs;
            $gekauftbei=$row->kurs;

            if($gekauftbei > $aktuellerkurs and $gekauftbei != $aktuellerkurs) {
            $rechnen=$gekauftbei - $aktuellerkurs;
            $ergebnis=floor($rechnen);
            $text=sprintf(_("Der aktuelle Kurs pro Aktie ist um %s &euro; gesunken. <br /> Du solltest warten!"), $ergebnis);
            } 
            elseif($gekauftbei == $aktuellerkurs) {
            $text=_("Beim Verkauf w&uuml;rdest du weder ein Gewinn noch Verlust verzeichen. <br /> Wir empfehlen zu warten.");
            } else {
            $rechnen=$aktuellerkurs - $gekauftbei;
            $ergebnis=floor($rechnen);
            $text=sprintf(_("Der aktuelle Kurs pro Aktie ist um %s &euro; gestiegen. <br /> Du solltest verkaufen!"), $ergebnis);
            }
            ?>

            <tr>
                <td class="<?php echo $class; ?>">
                    <a href="/Aktien/Info?firma=<?php echo $row->fid; ?>" title="<?php printf(_("Zeigt Echtzeit Informationen <br /> der Firma  %s"), $row->name); ?>"><?php echo $row->name; ?></a>
                    </td>
                <td class="<?php echo $class; ?>"><?php echo $row->anzahl; ?></td>
                <td class="<?php echo $class; ?>"><?php echo $row->kurs; ?></td>
                <td class="<?php echo $class; ?>"><?php echo $view->kurs->kurs; ?></td>
                <td class="<?php echo $class; ?>">

                    <?php if ($row->kurs < $view->kurs->kurs and $row->kurs != $view->kurs->kurs) { ?>
                        <img src="/public/img/boerseup.png" title="<?php echo $text; ?>"/>
                    <?php } elseif ($row->kurs == $view->kurs->kurs) { ?>
                        <img src="/public/img/boersewait.png" title="<?php echo $text; ?>"/>
                    <?php } else { ?>
                        <img src="/public/img/boersedown.png" title="<?php echo $text; ?>"/>
                    <?php } ?>

                </td>
                <td class="<?php echo $class; ?>">

                    <div class="buttons" id="floatright">
                        <a class="positive" href="/Benutzer/Aktien/Verkaufen&amp;aid=<?php echo $row->aid; ?>" title="<?php printf(_("Anteile der Firma %s <br /> verkaufen?"), $row->name); ?>">
                        <img alt="" src="/public/img/money.png"/><?php echo _("Verkaufen"); ?>
                      </a>
                    </div>

                </td>
            </tr>

        <?php } ?>
    </table>
<?php } ?>
