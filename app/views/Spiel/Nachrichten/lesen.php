<?php
$benutzer = new Benutzer_Table($view->nachricht->von);
?>
<h2>
    <?php echo _("Nachricht"); ?>
</h2>

<div class="table firsttable">
    <p class="title"><?php echo _("Lesen"); ?></p>
    <div class="row">

        <div class="cell">
            <label for="from"><?php echo _("Von"); ?></label>
        </div>
        <div class="cell">
            <input type="text" id="from" name="from" value="<?php echo $benutzer->nick; ?>" readonly="readonly"/>
        </div>

        <div class="cell">
            <label for="date"><?php echo _("Datum"); ?></label>
        </div>
        <div class="cell">
            <input type="text" id="date" name="date" value="<?php echo date("d.m.Y / H:i", $view->nachricht->date); ?>" readonly="readonly"/>
        </div>

        <div class="cell">
            <label for="betreff"><?php echo _("Betreff"); ?></label>
        </div>
        <div class="cell">
            <input type="text" id="betreff" name="betreff" value="<?php echo $view->nachricht->betreff; ?>" readonly="readonly"/>
        </div>

        <div class="cell">
            <label for="nachricht"><?php echo _("Nachricht"); ?></label>
        </div>
        <div class="cell">
            <textarea id="nachricht" name="nachricht" readonly="readonly"><?php echo $view->nachricht->nachricht; ?></textarea>
        </div>

        <div class="buttons" id="floatright">
            <a href="/Spiel/Nachrichten/Antworten?nid=<?php echo md5($view->nachricht->nid); ?>" class="regular" title="<?php printf(_("%s auf diese Nachricht antworten?"), $benutzer->nick); ?>">
            <img src="/public/img/send_message.png"/>Antworten</a>
        </div>

    </div>

</div>
