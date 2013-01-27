<h2>
    <?php echo _("Marktplatz"); ?>
</h2>

<table class="overview">
    <tr>
        <td class="heading"><?php echo _("Firma"); ?></td>
        <td class="heading"><?php echo _("Kurs"); ?></td>
        <td class="heading"><?php echo _("Anteile"); ?></td> 
        <td class="heading" style="width:173px;"><?php echo _("Optionen"); ?></td>
    </tr>
    <?php
    $i = 0;
    foreach ($view->firma as $row) {
        $view->kurs->getStocks($row->fid);
        $class = ($i++ % 2 == 0 ? "tablerow2" : "tablerow1");
        ?>
        <tr>
            <td class="<?php echo $class; ?>"><?php echo $row->name; ?></td>
            <td class="<?php echo $class; ?>"><?php echo $view->kurs->kurs; ?></td>
            <td class="<?php echo $class; ?>"><?php echo $row->anteile; ?></td>
            <td class="<?php echo $class; ?>">
                <div class="buttons" id="floatright">
                    <a class="regular" href="/Aktien/Info?firma=<?php echo $row->fid; ?>" title="<?php printf(_("Zeigt Echtzeit Informationen <br /> der Firma %s"), $row->name); ?>">
                        <img alt="" src="/public/img/info.png"/>
                        <?php echo _("Info"); ?>
                    </a>
                    <a class="positive" href="/Aktien/Kaufen?firma=<?php echo $row->fid; ?>" title="<?php printf(_("Anteile der Firma %s <br /> erwerben?"), $row->name); ?>">
                        <img alt="" src="/public/img/buy.png"/>
                        <?php echo _("Kaufen"); ?>
                    </a>
                </div>
            </td> 
        </tr>
        <?php
    }
    ?>
</table>

<div class="pagination">
    <?php
    if ($view->page == 1) {
        $url = "";
        $class = "disabled";
    } else {
        $res = $view->page - 1;
        $url = "/Aktien/Uebersicht?page=" . $res;
    }
    ?>
    <span><a class="<?php echo $class; ?>" href="<?php echo $url; ?>">&laquo;</a></span>
    <?php
    foreach (range(1, $view->Seiten) as $number) {
        echo "<span><a href=\"/Aktien/Uebersicht?page=$number\">$number</a></span>";
    }
    ?>
    <?php
    if ($view->Seiten == $view->page) {
        $url = "";
        $class = "disabled";
    } else {
        $res = $view->page + 1;
        $url = "/Aktien/Uebersicht?page=" . $res;
    }
    ?>
    <span><a class="<?php echo $class; ?>" href="<?php echo $url; ?>">&raquo;</a></span>
</div>
