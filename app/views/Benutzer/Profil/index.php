<h2>
    <?php echo _("Profil"); ?>
</h2>

<div class="tabscontainer"> 
    <ul class="tabs"> 
        <li><a href="#tab1"><?php echo _("Information"); ?></a></li> 
        <li><a href="#tab2"><?php echo _("Avatar"); ?></a></li> 
        <li><a href="#tab3"><?php echo _("Abzeichen"); ?></a></li> 
        <li><a href="#tab4"><?php echo _("Optionen"); ?></a></li> 
        <li><a href="#tab5"><?php echo _("Daten"); ?></a></li> 
        <li><a href="#tab6"><?php echo _("Pinnwand"); ?></a></li> 
        <li><a href="#tab7"><?php echo _("Passwort"); ?></a></li> 
    </ul>
</div> 

<div id="tab1" class="tabcontent"> 
    <div class="table">
        <p class="title"> <?php echo _("Information"); ?></p>
        <div class="row normal">
            <div class="cell normal">
                <?php echo _("Position"); ?>: ???
                <br/>
                <?php echo _("Aktueller Kontostand"); ?>: <?php echo $view->benutzer->guthaben; ?> &euro;
                <br/>
                <?php echo _("Profilaufrufe"); ?>: ???
                <br/>
                <?php echo _("Nachrichten"); ?>:
                <a href="/Spiel/Nachrichten" title="<?php echo _("Nachrichten lesen?"); ?>">
                    <?php echo _("Lesen"); ?></a> / <a href="/Spiel/Nachrichten/Schreiben" title="<?php echo _("Neue Nachricht verfassen?"); ?>"><?php echo _("Verfassen"); ?></a>
            </div>
            <div class="buttons" id="floatright">
                <a class="regular" href="/Benutzer/Profil?user=<?php echo $view->benutzer->nick; ?>" title="<?php echo _("Nur f&uuml;r registrierte Benutzer sichtbar"); ?>">
                    <img alt="" src="/public/img/profile.png"/>
                    <?php echo _("Mein &ouml;ffentliches Profil"); ?>
                </a>
            </div>
        </div>
    </div>            
</div> 

<div id="tab2" class="tabcontent"> 
    <form action="/Benutzer/Profil/Avatar">
        <div class="table">
            <p class="title"><?php echo _("Avatar"); ?></p>
            <div class="row">
                <div class="cell">
                    <div class="image-thumb avatar">
                        <img class="image-thumb" id="img_avatar" src="<?php echo $view->avatar_url; ?>" alt=""/>
                        <a href="#" onClick="window.location.href='/Benutzer/Profil/AvatarLoeschen'" title="<?php echo _("Dein aktuelles Profilbild l&ouml;schen?"); ?>"> &nbsp; </a>
                    </div>
                </div>
                <div class="cell">
                    <div class="uploadContainer">
                        <div class="uploadButton" title="<?php echo _("Klicke um ein Avatar f&uuml;r dein Profil auszuw&auml;hlen"); ?>">
                            <input type="file" id="file_upload" name="file"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>            
</div> 

<div id="tab3" class="tabcontent"> 
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
                <a class="regular" href="#" title="<?php echo _("Mehr Abzeichen kaufen?"); ?>">
                    <img alt="" src="/public/img/badges.png"/>
                    <?php echo _("Einkaufen"); ?>
                </a>
            </div>

        </div>
    </div>
</div> 


<div id="tab4" class="tabcontent"> 
    <form action="/Benutzer/Profil/Optionen" method="post">
        <div class="table">
            <p class="title"><?php echo _("Optionen"); ?></p>
            <div class="row">

                <div class="cell">
                    <label for="sprache"><?php echo _("Sprache"); ?></label>
                </div>
                <div class="cell">
                    <select name="sprache" id="sprache" class="options">
                        <option value="1" <?php if ($view->benutzer->lang == "1")
                        echo "selected=\"selected\""; ?>><?php echo _("Deutsch"); ?></option>
                        <option value="2" <?php if ($view->benutzer->lang == "2")
                        echo "selected=\"selected\""; ?>><?php echo _("Englisch"); ?></option>
                    </select>
                </div>

                <div class="cell">
                    <label for="design"><?php echo _("Farbschema"); ?></label>
                </div>
                <div class="cell">
                    <select name="design" id="design" class="options">
                        <option value="1" <?php if ($view->benutzer->design == "1")
                        echo "selected=\"selected\""; ?>><?php echo _("Blau"); ?></option>
                        <option value="2" <?php if ($view->benutzer->design == "2")
                        echo "selected=\"selected\""; ?>><?php echo _("Grau"); ?></option>
                        <option value="3" <?php if ($view->benutzer->design == "3")
                        echo "selected=\"selected\""; ?>><?php echo _("Gr&uuml;n"); ?></option>
                        <option value="4" <?php if ($view->benutzer->design == "4")
                        echo "selected=\"selected\""; ?>><?php echo _("Orange"); ?></option>
                    </select>
                </div>

                <div class="buttons" id="floatright">

                    <a class="negative" href="#" title="<?php echo _("Auf der n&auml;chsten Seite hast du die M&ouml;glichkeit<br/>dein Nutzerkonto unwiderruflich zu l&ouml;schen."); ?>">
                        <img alt="" src="/public/img/deluser.png"/>
<?php echo _("Nutzerkonto l&ouml;schen?"); ?>
                    </a>

                    <button type="submit" class="positive" value="<?php echo _("Optionen &auml;ndern"); ?>" title="<?php echo _("Optionen &auml;ndern?"); ?>">
                        <img alt="" src="/public/img/options.png"/>
<?php echo _("&Uuml;bernehmen"); ?>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div> 

<div id="tab5" class="tabcontent"> 
    <form action="/Benutzer/Profil/Daten" method="post">
        <div class="table">
            <p class="title"><?php echo _("Daten"); ?></p>
            <div class="row">

                <div class="cell">
                    <label for="name"><?php echo _("Name"); ?></label>
                </div>
                <div class="cell">
                    <input type="text" id="name" name="name" value="<?php echo $view->benutzer->name; ?>"/>
                </div>

                <div class="cell">
                    <label for="geburtstag"><?php echo _("Geburtstag"); ?></label>
                </div>
                <div class="cell normal">
<?php echo _("Tag"); ?>: <input type="text" id="geburtstag" name="tag" value="<?php if($view->benutzer->geburtstag != 0) echo date("d", $view->benutzer->geburtstag); ?>" maxlength="2" class="bday"/>
<?php echo _("Monat"); ?>: <input type="text" id="geburtstag" name="monat" maxlength="2" value="<?php if($view->benutzer->geburtstag != 0) echo date("m", $view->benutzer->geburtstag); ?>" class="bday"/> 
<?php echo _("Jahr"); ?>: <input type="text" id="geburtstag" name="jahr" value="<?php if($view->benutzer->geburtstag != 0) echo date("Y", $view->benutzer->geburtstag); ?>" maxlength="4" class="bday"/>
                </div>

                <div class="cell">
                    <label for="geschlecht"><?php echo _("Geschlecht"); ?></label>
                </div>
                <div class="cell">
                    <select name="geschlecht" id="geschlecht" class="options">
                        <option <?php if ($view->benutzer->geschlecht == "m")
    echo "selected=\"selected\""; ?> value="m"><?php echo _("M&auml;nnlich"); ?></option>
                        <option <?php if ($view->benutzer->geschlecht == "f")
    echo "selected=\"selected\""; ?> value="f"><?php echo _("Weiblich"); ?></option>
                        <option <?php if ($view->benutzer->geschlecht == "p")
    echo "selected=\"selected\""; ?> value="p"><?php echo _("Paar"); ?></option>
                    </select>
                </div>

                <div class="cell">
                    <label for="herkunft"><?php echo _("Herkunft"); ?></label>
                </div>
                <div class="cell">
                    <input type="text" id="herkunft" name="herkunft" value="<?php echo $view->benutzer->herkunft; ?>"/>
                </div>

                <div class="cell">
                    <label for="aboutme"><?php echo _("&Uuml;ber mich"); ?></label>
                </div>
                <div class="cell">
                    <textarea id="aboutme" name="aboutme"><?php echo $view->benutzer->ueber; ?></textarea>
                </div>

                <div class="buttons" id="floatright">
                    <button type="submit" class="positive" value="<?php echo _("Daten &auml;ndern"); ?>" title="<?php echo _("Deine Daten &auml;ndern?"); ?>">
                        <img alt="" src="/public/img/profile.png"/>
    <?php echo _("&Uuml;bernehmen"); ?>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div> 

<div id="tab6" class="tabcontent">
<?php if (count($view->pinnwand) == 0) { ?>

        <div class="table">
            <p class="title"><?php echo _("Information"); ?></p>
            <div class="row normal">
                <div class="cell normal">
    <?php echo _("Auf deiner Pinnwand befinden sich noch keine Eintr&auml;ge."); ?>
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

                    <div id="content_<?php echo $row->pid; ?>" class="cell normal">
                        <p class="entry" id="<?php echo $row->pid; ?>">
                            <span class="showlike" title="<?php printf(_("%s Personen gef&auml;llt das"), "like_total"); ?>">
        <?php echo _("1+"); ?>
                            </span>
                            <span class="likeentry">
                                <span title="<?php printf(_("Diesen Pinnwandeintrag von %s positiv bewerten?"), $row->von_nick); ?>"><img src="/public/img/likeentry.png" alt=""/></span>
                            </span>
                            <span class="delentry">
                                <span title="<?php printf(_("Diesen Pinnwandeintrag von %s l&ouml;schen?"), $row->von_nick); ?>"><img src="/public/img/del_entry.png" alt=""/></span>
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

        <div style="display:none;" id="dialog-confirm">
    <?php echo _("Bist du dir sicher, dass du diesen Pinnwandeintrag L&ouml;schen m&ouml;chtest?"); ?>
        </div>

<?php } ?>

</div>  

<div id="tab7" class="tabcontent"> 
    <form action="/Benutzer/Profil/Passwort" method="post">
        <div class="table">
            <p class="title"><?php echo _("Passwort"); ?></p>
            <div class="row">
                <div class="cell">
                    <label for="oldpass"><?php echo _("Altes Passwort"); ?></label>
                </div>
                <div class="cell">
                    <input type="password" id="oldpass" name="oldpass"/>
                </div>
                <div class="cell">
                    <label for="newpass"><?php echo _("Neues Passwort"); ?></label>
                </div>
                <div class="cell">
                    <input type="password" id="newpass" name="newpass"/>
                </div>
                <div class="buttons" id="floatright">
                    <button type="submit" id="changepass" class="positive" value="<?php echo _("Passwort &auml;ndern"); ?>" title="<?php echo _("Dein Passwort &auml;ndern?"); ?>">
                        <img alt="" src="/public/img/changepwd.png"/>
<?php echo _("&Uuml;bernehmen"); ?>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
