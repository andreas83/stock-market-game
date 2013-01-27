<h2>
    <?php echo _("Bestenliste"); ?>
</h2>

<table class="overview">
    <tr>
        <td class="heading"><?php echo _("Spieler"); ?></td>
        <td class="heading"><?php echo _("Position"); ?></td>
        <td class="heading"><?php echo _("Abzeichen"); ?></td>
        <td class="heading"><?php echo _("Guthaben"); ?></td>
        <td class="heading" style="width:194px;"><?php echo _("Aktion"); ?></td>
    </tr>

    <?php
    $i = 0;
    foreach ($view->highscore as $row) {
        $class = ($i++ % 2 == 0 ? "tablerow2" : "tablerow1");
        ?>

        <tr>
            <td class="<?php echo $class; ?>"><?php echo $row->nick; ?></td>
            <td class="<?php echo $class; ?>"><?php echo $i; ?></td>
            <td class="<?php echo $class; ?>">???</td>
            <td class="<?php echo $class; ?>"><?php echo $row->guthaben; ?></td>
            <td class="<?php echo $class; ?>">
                <div class="buttons" id="floatright">
                    <a class="positive" href="/Benutzer/Profil?user=<?php echo $row->nick; ?>" title="<?php printf(_("Profil von %s betrachten?"), $row->nick); ?>">
                        <img alt="" src="/public/img/profile.png"/>
                        <?php echo _("Profil"); ?>
                    </a>
                    <a class="regular" href="/Spiel/Nachrichten/Schreiben?bid=<?php echo $row->bid; ?>" title="<?php printf(_("%s eine Nachricht schreiben?"), $row->nick); ?>">
                        <img alt="" src="/public/img/messages.png"/>
                        <?php echo _("Nachricht"); ?>
                    </a>
                </div>
            </td>
        </tr>

    <?php } ?>

</table>
<div class="pagination">

    <?php
    if ($view->page == 1) {
        $url = "";
        $class = "disabled";
    } else {
        $res = $view->page - 1;
        $url = "/Spiel/Highscore?page=" . $res;
    }
    ?>

    <span>
        <a class="<?php echo $class; ?>" href="<?php echo $url; ?>">&laquo;</a>
    </span>

    <?php
    foreach (range(1, $view->Seiten) as $number) {
        ?>

        <span>
            <a href="/Spiel/Highscore?page=<?php echo $number; ?>"><?php echo $number; ?></a>
        </span>

    <?php } ?>

    <?php
    if ($view->Seiten == $view->page) {
        $url = "";
        $class = "disabled";
    } else {
        $res = $view->page + 1;
        $url = "/Spiel/Highscore?page=" . $res;
    }
    ?>

    <span>
        <a class="<?php echo $class; ?>" href="<?php echo $url; ?>">&raquo;</a>
    </span>
</div>
