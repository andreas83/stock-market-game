</div>

<?php
if (Config::get('locale') == "de_DE") 
    $tweetlang = "de";
else
    $tweetlang = "en";
?>

<div class="copyright">

    <script type="text/javascript" src="https://apis.google.com/js/plusone.js">
        {lang: '<?php echo Config::get('locale'); ?>'}
    </script>

    <div class="googlelike">
        <g:plusone size="medium"></g:plusone>
    </div>

    <div class="tweetlike">
        <a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-lang="<?php echo $tweetlang ?>">Tweet</a>
        <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
    </div>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/<?php echo Config::get('locale'); ?>/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <div title="<?php printf(_("Facebook Like Button"));?>" class="fb-like" data-href="<?php echo "http://" . $_SERVER['HTTP_HOST'] . "/" ?>" data-send="false" data-layout="button_count" data-show-faces="false" data-font="verdana"></div>

    Developers: <a href="http://www.codejungle.org/">Andreas Beder</a> - <a href="http://www.minimalistic.de/">Michael Muth</a>

</div>
</body>
</html>
