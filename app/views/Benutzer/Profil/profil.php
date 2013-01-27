<h2>
    <?php echo _("Profil"); ?>
</h2>

<?php
$benutzer = $view->benutzer[0];
$lastlogedin = strftime(_("_LAST_LOGIN_DATE_"), strtotime($benutzer->lastlogin));
$age = date("Y") - date("Y", $benutzer->geburtstag);

if (date("z", $endtime) < date("z", $starttime))
    $age--;

switch ($benuter->geschlecht) {
    case 'm':
        $geschlecht = _("M&auml;nnlich");
        break;
    case 'w':
        $geschlecht = _("Weiblich");
        break;
    case 'p':
        $geschlecht = _("Paar");
        break;
    default:
        $geschlecht = _("M&auml;nnlich");
        break;
}
?>

<div class="tabscontainer"> 
    <ul class="tabs"> 
        <li><a href="#tab1"><?php echo _("Information"); ?></a></li>
        <li><a href="#tab2"><?php echo _("Abzeichen"); ?></a></li>
        <li class="tabradius"><a href="#tab3"><?php echo _("Pinnwand"); ?></a></li>
    </ul>
</div> 

<div id="tab1" class="tabcontent"> 
    <div class="table">
        <p class="title"> <?php echo _("Benutzerinformation"); ?></p>
        <div class="row normal">
            <div class="cell">
                <div class="image-thumb avatar">
                    <img src="<?php echo $view->avatar_url; ?>" class="image-thumb" alt="" title="<?php echo _("Aktuelles Profilbild"); ?>"/>
                </div>
            </div>
            <div class="cell">

                <span class="about">
                    <?php echo _("Benutzername"); ?>: <?php echo $benutzer->nick; ?>
                    <br/>
                    <?php echo _("Position"); ?>: ??? <?php echo _("Platz"); ?>
                    <br/>
                    <?php echo _("Alter"); ?>: <?php if($benutzer->geburtstag != 0) printf(_("%s Jahre"), $age); ?>
                    <br/>
                    <?php echo _("Kontostand"); ?>: <?php echo $benutzer->guthaben; ?> <?php echo _("&euro;"); ?>
                    <br/>
                </span>

                <?php echo _("Realer Name"); ?>: <?php echo $benutzer->name; ?>
                <br/>
                <?php echo _("Herkunft"); ?>: <?php echo $benutzer->herkunft; ?>
                <br/>
                <?php echo _("Geschlecht"); ?>: <?php echo $geschlecht; ?>
                <br/>

                <?php echo _("Geburtstag"); ?>: <?php if($benutzer->geburtstag != 0) echo strftime(_("_BIRTHDAY_DATE_"), $benutzer->geburtstag); ?>
                <br/>
                <?php echo _("Letzte Anmeldung"); ?>: <?php echo $lastlogedin; ?>
                <br/>

                <?php if ($benutzer->ueber) { ?>

                    <br/><?php echo _("&Uuml;ber mich"); ?>:<br/>
                    <p><?php echo $benutzer->ueber; ?></p>

                <?php } ?>

            </div>
            <div class="buttons" id="floatright">

                <a class="regular" href="/Spiel/Nachrichten/Schreiben?bid=<?php echo $benutzer->bid; ?>" title="<?php printf(_("%s eine Nachricht schreiben?"), $benutzer->nick); ?>">
                    <img alt="" src="/public/img/messages.png"/>
                    <?php echo _("Nachricht"); ?>
                </a>

            </div>
        </div>
    </div>
</div>

<div id="tab2" class="tabcontent"> 
    <div class="table">
        <p class="title"><?php echo _("Abzeichen"); ?></p>
        <div class="row">
            <div class="cell">
                <div id="badges">

                    <img src="/public/img/badges/badges_dino.png" alt="" title="<?php echo _("Abzeichen: Dino - Wert: 1000 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_money.png" alt="" title="<?php echo _("Abzeichen: Geld - Wert: 1.000.000 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_panda.png" alt="" title="<?php echo _("Abzeichen: Panda - Wert: 500.000 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_rose.png" alt="" title="<?php echo _("Abzeichen: Rose - Wert 50.000 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_parachute.png" alt="" title="<?php echo _("Abzeichen: Fallschirm - Wert: 5.000 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_lipstick.png" alt="" title="<?php echo _("Abzeichen: Lippenstift - Wert: 100 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_perfume.png" alt="" title="<?php echo _("Abzeichen: Parf&uuml;m - Wert:  500 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_handbag.png" alt="" title="<?php echo _("Abzeichen: Handtasche - Wert: 1.500 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_cupid.png" alt="" title="<?php echo _("Abzeichen: Amor - Wert:  300.000 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_teddybear.png" alt="" title="<?php echo _("Abzeichen: Teddyb&auml;r - Wert:  250.000 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_pralines.png" alt="" title="<?php echo _("Abzeichen: Pralinen - Wert:  3.500 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_brand.png" alt="" title="<?php echo _("Abzeichen: Marke - Wert:  2.000.000 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_history.png" alt="" title="<?php echo _("Abzeichen: Historie - Wert: 10.000.000 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_piggy.png" alt="" title="<?php echo _("Abzeichen: Schweinchen - Wert: 50.000 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_government.png" alt="" title="<?php echo _("Abzeichen: Regierung - Wert: 4.000.000 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_property.png" alt="" title="<?php echo _("Abzeichen: Eigenheim - Wert: 3.000.000 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_cake.png" alt="" title="<?php echo _("Abzeichen: Torte - Wert: 400 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_capsicum.png" alt="" title="<?php echo _("Abzeichen: Peperoni - Wert: 300 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_coffeecup.png" alt="" title="<?php echo _("Abzeichen: Kaffeetasse - Wert: 600 &euro;"); ?>"/>
                    <img src="/public/img/badges/badges_exchangepro.png" alt="" title="<?php echo _("Abzeichen: B&ouml;rsenprofi - Wert: 5.000.000 &euro;"); ?>"/>

                </div>
            </div>
            <div class="buttons" id="floatright">
                <a class="positive" href="#" title="<?php printf(_("%s ein Geschenk machen?"), $benutzer->nick); ?>">
                    <img alt="" src="/public/img/badges.png"/>
                    <?php echo _("Schenken"); ?>
                </a>
            </div>
        </div>
    </div>
</div>
<div id="tab3" class="tabcontent">

    <?php if (count($view->pinnwand) == 0) { ?>

        <div class="table">
            <p class="title"><?php echo _("Information"); ?></p>
            <div class="row normal">
                <div class="cell normal">
                    <?php echo _("Auf dieser Pinnwand befinden sich noch keine Eintr&auml;ge. Willst du der Erste sein?"); ?>
                </div>
            </div>
            <div class="row normal">
                <div class="cell normal">
                    <span id="output"></span>
                    <textarea name="pinnwand" id="pinnwand" class="pinnwand"></textarea>
                    <div class="buttons" id="floatright">
                        <a class="regular" href="#" id="PinnwandSpeichern" title="<?php printf(_("An %s&rsquo;s Pinnwand schreiben?"), $benutzer->nick); ?>">
                            <img alt="" src="/public/img/pinboard.png"/>
                            <?php echo _("Neuer Pinnwandeintrag"); ?>
                        </a>
                        <input type="hidden" name="link" id="link"/>
                        <input type="hidden" name="id" id="id" value="<?php echo $benutzer->bid; ?>"/>
                    </div>
                </div>
            </div>
        </div>

    <?php } else { ?>

        <div class="table">
            <p class="title"><?php echo _("Pinnwand"); ?></p>
            <div class="row normal">
                <div class="cell normal">
                    <span id="output"></span>
                    <textarea name="pinnwand" id="pinnwand" class="pinnwand"></textarea>
                    <div class="buttons" id="floatright">
                        <a class="regular" href="#" id="PinnwandSpeichern" title="<?php printf(_("An %s&rsquo;s Pinnwand schreiben?"), $benutzer->nick); ?>">
                            <img alt="" src="/public/img/pinboard.png"/>
                            <?php echo _("Neuer Pinnwandeintrag"); ?>
                        </a>
                        <input type="hidden" name="link" id="link"/>
                        <input type="hidden" name="id" id="id" value="<?php echo $benutzer->bid; ?>"/>
                    </div>
                </div>
            </div>
            <br/>
            <br/>

            <div class="row normal">

                <?php foreach ($view->pinnwand as $row) { ?>

                    <div class="cell normal">
                        <p class="entry" id="<?php echo $row->pid; ?>">
                            <span class="showlike" title="<?php printf(_("%s Personen gef&auml;llt das"), "like_total"); ?>">
                                <?php echo _("1+"); ?>
                            </span>
                            <span class="likeentry">
                                <span title="<?php printf(_("Diesen Pinnwandeintrag von %s positiv bewerten?"), $row->von_nick); ?>"><img src="/public/img/likeentry.png" alt=""/></span>
                            </span>
                            <span class="addentry">
                                <span title="<?php printf(_("Auf diesen Pinnwandeintrag von %s antworten?"), $row->von_nick); ?>"><img src="/public/img/add_entry.png" alt=""/></span>
                            </span>
                            <img class="entryavatar" src="<?php echo Benutzer_Profil::getAvatar($row->von); ?>" alt="" title="<?php printf(_("Profilbild von %s"), $row->von_nick); ?>"/>
                            <br/>
                            <span class="datetime">
                            <?php echo _("Von"); ?> 
                                <a href="/Benutzer/Profil?user=<?php echo $row->von_nick; ?>" title="<?php printf(_("Zum Profil von %s"), $row->von_nick); ?>"><?php echo $row->von_nick; ?></a> 
                            <?php echo Benutzer_Pinnwand::getRTime($row->date); ?>
                            <span class="lines"></span>
                            </span>
                            <br/>

                            <?php
                            echo Benutzer_Pinnwand::replaceYoutube($row->text);
                            ?>

                        </p>
                        <div class="userreplay" id="form_<?php echo $row->pid; ?>">
                            <p>
                                <textarea name="pinnwand" id="pinnwand" class="pinnwand urtxt"></textarea>
                            </p>
                            <div class="buttons topbutton" id="floatright">
                                <a class="regular" href="#" id="PinnwandSpeichern" title="<?php echo _("Abschicken?"); ?>">
                                    <img alt="" src="/public/img/pinboard.png"/>
                                    <?php echo _("Kommentieren"); ?>
                                </a>
                                <input type="hidden" name="link" id="link"/>
                                <input type="hidden" name="id" id="id" value="<?php echo $benutzer->bid; ?>"/>
                            </div>
                            <br/>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>

    <?php } ?>

</div>
