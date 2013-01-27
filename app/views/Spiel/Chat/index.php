<h2>
    <?php echo _("Chat"); ?>
</h2>

<div id="shoutbox" name="shoutbox" class="mainchat">&nbsp;</div>
<div id="userlist" class="userlist">&nbsp;</div>

<input type="text" value="" id="chatinput" name="content" title="<?php echo _("Nutze die Eingabetaste zum versenden einer Nachricht"); ?>"/>

<script type="text/javascript">
    jQuery(document).ready(function($){
        $('#chatinput').focus();
    });
</script>

<span class="showsmilies"><img src="/public/img/smilies/icon_smile.png" alt="smilie" title="<?php echo _("Zeigt dir alle Chat Emotions"); ?>"/>
    <span>
        <a href="javascript:past('[biggrin]')"><img src="/public/img/smilies/icon_biggrin.png" alt="biggrin" title="biggrin"/></a>
        <a href="javascript:past('[confused]')"><img src="/public/img/smilies/icon_confused.png" alt="confused" title="confused"/></a>
        <a href="javascript:past('[cool]')"><img src="/public/img/smilies/icon_cool.png" alt="cool" title="cool"/></a>
        <a href="javascript:past('[huh]')"><img src="/public/img/smilies/icon_huh.png" alt="huh" title="huh"/></a>
        <a href="javascript:past('[mad]')"><img src="/public/img/smilies/icon_mad.png" alt="mad" title="mad"/></a>
        <a href="javascript:past('[neutral]')"><img src="/public/img/smilies/icon_neutral.png" alt="neutral" title="neutral"/></a>
        <a href="javascript:past('[sad]')"><img src="/public/img/smilies/icon_sad.png" alt="sad" title="sad"/></a>
        <a href="javascript:past('[smile]')"><img src="/public/img/smilies/icon_smile.png" alt="smile" title="smile"/></a>
        <a href="javascript:past('[surprised]')"><img src="/public/img/smilies/icon_money.png" alt="money" title="money"/></a>
        <a href="javascript:past('[wink]')"><img src="/public/img/smilies/icon_wink.png" alt="wink" title="wink"/></a>
        <a href="javascript:past('[tongue]')"><img src="/public/img/smilies/icon_tongue.png" alt="tongue" title="tongue"/></a>
        <a href="javascript:past('[kiss]')"><img src="/public/img/smilies/icon_kiss.png" alt="kiss" title="kiss"/></a>
    </span></span>

<span class="autoscroll">
    <select id="autoscroll" name="autoscroll">
        <option selected="selected" disabled="disabled"> <?php echo _("Autoscroll"); ?> </option>
        <option value="1"><?php echo _("Aktivieren"); ?></option>
        <option value="0"><?php echo _("Deaktivieren"); ?></option>
    </select>
</span>
