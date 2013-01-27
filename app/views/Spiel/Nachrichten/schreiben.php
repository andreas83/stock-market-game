<?php

if($view->nachricht)
{
    $benutzer = new Benutzer_Table($view->nachricht->von);
    $an = $benutzer->nick;
    $betreff = "RE: " .$view->nachricht->betreff;
    $msg = str_replace("\n", "\n >", $view->nachricht->nachricht);
    $msg = "\n\n\n\n---- "._("Original Nachricht")." ----\n".$view->nachricht->nachricht;
}

if($view->benutzer)
    $an = $view->benutzer->nick; 
?>

<h2>
    <?php echo _("Nachricht"); ?>
</h2>

<div class="table firsttable">
    <form action="/Spiel/Nachrichten/Senden" method="Post">
        <p class="title"><?php echo _("Verfassen"); ?></p>

<?php
if(isset($view->result)) {
?>

<script>
    $(document).ready(function() {
        $("#fademsg").hide().fadeIn("slow");
        return false;
    });
</script>

<div class="row error" id="fademsg">
    <div class="cell error">
        <?php
        echo $view->result;
        ?>
    </div>
</div>

<?php } ?>

        <div class="row">

            <div class="cell">
                <label for="an"><?php echo _("Empfänger"); ?></label>
            </div>
            <div class="cell">
                <input type="text" id="an" name="an" value="<?php echo $an; ?>"/>
            </div>

            <div class="cell">
                <label for="betreff"><?php echo _("Betreff"); ?></label>
            </div>
            <div class="cell">
                <input type="text" id="betreff" name="betreff" value="<?php echo $betreff; ?>"/>
            </div>

            <div class="cell">
                <label for="nachricht"><?php echo _("Nachricht"); ?></label>
            </div>
            <div class="cell">
                <textarea id="nachricht" name="nachricht"><?php echo $msg; ?></textarea>
            </div>

            <div class="buttons" id="floatright">
                <button type="submit" class="positive" value="<?php echo _("Senden"); ?>" title="<?php echo _("Nachricht senden?"); ?>">
                    <img alt="" src="/public/img/send_message.png"/>
                    <?php echo _("Senden"); ?>
                </button>
            </div>
        </div>
    </form>
</div>