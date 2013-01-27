<h2><?php echo _("Nachrichten"); ?></h2>

<?php if($view->nachrichten == false) { ?>

<div class="table">
    <p class="title"><?php echo _("Information"); ?></p>
    <div class="row normal">
        <div class="cell normal">
            <?php echo _("In deinem Posteingang befinden sich momentan keine Nachrichten."); ?>
        </div>
    </div>
    
        <div class="buttons" id="floatright">
            <a class="regular" href="/Spiel/Nachrichten/Schreiben" title="<?php echo _("Einem Benutzer eine Nachricht schreiben?"); ?>">
                <img alt="" src="/public/img/messages.png"/>
                <?php echo _("Nachricht verfassen"); ?>
            </a>
        </div>
           
</div>

<?php } else { ?>

<table class="overview">
    <tr>
        <td class="heading textleft">
            <?php echo _("Von"); ?>
        </td>
        <td class="heading textleft">
            <?php echo _("Betreff"); ?>
        </td>
        <td class="heading" style="width:173px">
            <?php echo _("Optionen"); ?>
        </td>        
    </tr>
    <?php
    foreach($view->nachrichten as $msg)
    {
        $benutzer = new Benutzer_Table($msg->von);
        if($msg->status=="unread")
            $class="tablerow1 newmsg";
        else
            $class="tablerow1";

        if (preg_match("/RE: /", $msg->betreff))
            $re = "<div class=\"chattime\">"._("ANTWORT")."</div>";

            $msg->betreff = str_replace("RE: ", "", $msg->betreff);

        if(strlen($benutzer->nick) > 10) {
            $title_benutzer = $benutzer->nick;
            $benutzer_cut = substr($benutzer->nick, 0, 10).'...' ;
        } else {
            $title_benutzer = "";
            $benutzer_cut = $benutzer->nick;
        }

        if(strlen($msg->betreff) > 25) {
            $title_betreff = $msg->betreff;
            $msg_cut = substr($msg->betreff, 0, 25).'...';
        } else {
            $title_betreff = "";
            $msg_cut = $msg->betreff;
        }

    ?>
    <tr>
        <td class="<?php echo $class; ?> left" title="<?php echo $title_benutzer; ?>">
            <?php echo $benutzer_cut; ?><br />
            <div class="chattime"> <?php printf(_("Am: %s um %s Uhr"), date("d.m.Y", $msg->date), date("H:i", $msg->date)); ?></div></td>
        <td class="<?php echo $class; ?> left" title="<?php echo $title_betreff; ?>"><?php echo $msg_cut; ?><br />
            <?php if(isset($re)) echo $re; ?></td>
        <td class="<?php echo $class; ?>">
            <div class="buttons" id="floatright">
                <a href="/Spiel/Nachrichten/Lesen?nid=<?php echo md5($msg->nid); ?>" class="regular" title="<?php echo _("Diese Nachricht lesen?"); ?>">
                   &nbsp; <img src="/public/img/read_message.png"/></a>
                <a href="/Spiel/Nachrichten/Antworten?nid=<?php echo md5($msg->nid); ?>" class="positive" title="<?php echo _("Auf diese Nachricht antworten?"); ?>">
                   &nbsp; <img src="/public/img/send_message.png"/></a>
                <a href="/Spiel/Nachrichten/Loeschen?nid=<?php echo md5($msg->nid); ?>" class="negative" title="<?php echo _("Diese Nachricht l&ouml;schen?"); ?>">
                   &nbsp; <img src="/public/img/delete_message.png"/></a>
            </div>
        </td>
    </tr>
    <?php } ?>

</table>

<?php } ?>
