<div id="jqmenu" class="slidenav">
    <ul>
        <li><a class="main mainleft" href="/index.php" title="<?php echo _("Startseite"); ?>"><img class="slidehome" src="/public/img/nav_home.png" alt="" /></a></li>
        <li><a class="main" href="/index.php" title="<?php echo _("Kontakt"); ?>"><img class="slidehome" src="/public/img/nav_contact.png" alt="" /></a></li>

        <?php if (isset($_SESSION['login'])) { ?>

        <li><a class="main" href="#"><?php echo _("Konto"); ?></a>
            <ul>
                <li><a class="firstsub" href="/Benutzer/Profil"><img class="thumbnail" src="/public/img/nav_profile.png" alt="" /><?php echo _("Profil"); ?></a></li>
                <li><a class="lastsub" href="#"><img class="thumbnail" src="/public/img/nav_message.png" alt="" /><?php echo _("Nachrichten"); ?></a>
                    <ul>
                        <li><a class="firstsub" href="/Spiel/Nachrichten"><img class="thumbnail" src="/public/img/nav_message.png" alt="" /><?php echo _("Posteingang"); ?></a></li>
                        <li><a href="/Spiel/Nachrichten"><img class="thumbnail" src="/public/img/nav_message.png" alt="" /><?php echo _("Lesen"); ?></a></li>
                        <li><a class="lastsub" href="/Spiel/Nachrichten/Schreiben"><img class="thumbnail" src="/public/img/nav_message.png" alt="" /><?php echo _("Schreiben"); ?></a></li>
                    </ul>
                  </li>
            </ul>

        <?php } ?>

        <li><a class="main mainright" href="#"><?php echo _("Navigation"); ?></a>
            <ul>
                <li><a class="firstsub" href="/Aktien/Uebersicht"><img class="thumbnail" src="/public/img/nav_market.png" alt="" /><?php echo _("Marktplatz"); ?></a></li>

                <?php if (isset($_SESSION['login'])) { ?>

                <li><a href="/Benutzer/Aktien"><img class="thumbnail" src="/public/img/nav_buy.png" alt="" /><?php echo _("Mein Markt"); ?></a></li>
                <li><a href="/Spiel/Chat"><img class="thumbnail" src="/public/img/nav_chat.png" alt="" /><?php echo _("Chat"); ?></a></li>
                <li><a href="/Spiel/Highscore"><img class="thumbnail" src="/public/img/nav_toplist.png" alt="" /><?php echo _("Bestenliste"); ?></a></li>
                <li><a href="/Benutzer/Abmelden"><img class="thumbnail" src="/public/img/nav_logout.png" alt="" /><?php echo _("Abmelden"); ?></a></li>

                <?php } else { ?>

                <li><a href="/Benutzer/Register"><img class="thumbnail" src="/public/img/nav_register.png" alt="" /><?php echo _("Registieren"); ?></a></li>
                <li><a href="/Benutzer/Anmelden"><img class="thumbnail" src="/public/img/nav_login.png" alt="" /><?php echo _("Anmelden"); ?></a></li>

                <?php } ?>

                <li><a class="lastsub" href="/Spiel/Hilfe"><img class="thumbnail" src="/public/img/nav_help.png" alt="" /><?php echo _("Hilfe"); ?></a></li>
            </ul>
        </li>

    </ul>
</div>