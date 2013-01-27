<?php

$imgloader = "
    <script type=\"text/javascript\" src=\"/public/js/jquery.preloader.js\"></script>
    <script type=\"text/javascript\" src=\"/public/js/jquery.tabs.js\"></script>
    <script type=\"text/javascript\" src=\"/public/js/swfobject.js\"></script>
    <script type=\"text/javascript\" src=\"/public/js/jquery.uploadify.min.js\"></script>
    <script type=\"text/javascript\" src=\"/public/js/sha.js\"></script>
    <link href=\"/public/css/uploadify.css\" type=\"text/css\" rel=\"stylesheet\" />

    <script type=\"text/javascript\">
jQuery(document).ready(function($){
    $('#badges').preloader();
    $('#file_upload').uploadify({
        'swf' : '/public/uploadify.swf',
        'uploader' : '/Benutzer/Profil/Upload?sid=" . session_id() . "',
        'cancelImage' : '/public/img/uploadify-cancel.png',
        'folder' : '/public/avatar',
        'auto' : true,
        'buttonText' : '" . _("Avatar auswählen") . "',
        'fileTypeDesc' : '" . _("Bilder") . "',
        'fileTypeExts' : '*.jpg;*.gif;*.png',
        'checkExisting': false,
        'onUploadSuccess' : function(event,data) {
            $('#img_avatar').attr('src', '/public/avatar/'+data+'?'+Math.floor(Math.random()*1337));
        }
    });
    $('#changepass').click(function(){
        if($('#oldpass').val().length>0)
        {
            shaObj =new jsSHA($('#oldpass').val(), 'ASCII');
            $('#oldpass').val(shaObj.getHash('SHA-512', 'HEX'));
        }
        if($('#newpass').val().length>0)
        {
            shaObj =new jsSHA($('#newpass').val(), 'ASCII');
            $('#newpass').val(shaObj.getHash('SHA-512', 'HEX'));
        }
    });

    $('.entry').hover(function(){
        $(this).find('.delentry, .addentry, .likeentry').css('visibility', 'visible');
        $(this).addClass('entryhover');
    },function(){
        $(this).find('.delentry, .addentry, .likeentry').css('visibility', 'hidden');
        $(this).removeClass('entryhover');
    });

    $('.delentry').css('visibility', 'hidden').click(function(){

        var pid = $(this).parent().attr('id');
        
        $( '#dialog-confirm' ).dialog({
            title: '" . _("Best&auml;tigen") . "',
            show: 'fade',
            draggable: true,
            resizable: false,
            modal: true,
            buttons: {
                '" . _("Ja") . "': function() {
                    $.ajax({
                        url: '/Benutzer/Pinnwand/Loeschen',
                        data: {'pid':pid},
                        success: function(data) {
                    $('#content_' + pid).html($('#content_' + pid).html(''));
                        }
                    });
                    $( this ).dialog( 'close' );
                },
                '" . _("Abbrechen") . "': function() {
                    $( this ).dialog( 'close' );
                }
            }
        });
    })

    $('#pinnwand').animate({'opacity': .8});
    $('#pinnwand').live('mouseover mouseout', function(event) {
        if ( event.type == 'mouseover' ) {
            $(this).stop().animate({'opacity': 1});
        } else {
            $(this).stop().animate({'opacity': .8});
        }
    });

    $('.userreplay').css('display', 'none');
    $('.addentry').css('visibility', 'hidden').click(function(){
        $('#form_' + $(this).parent().attr('id')).stop(true, true).slideToggle();
        return false;
    });

    $('.likeentry').css('visibility', 'hidden').click(function(){
        // confirmation
        if (confirm('like this comment?')){
            // get comment ID
            alert('comment like ID = ' + $(this).parent().attr('id'));
        }
    });

    $('#pinnwand').keydown(function()
    {

        var re = /https?:\/\/(?:www\.)?(?:youtu\.be\/|youtube\.com\S*[^\w\-\s])([\w\-]{11})(?=[^\w\-]|$)(?![?=&+%\w]*(?:[\'\"][^<>]*>|<\/a>))[?=&+%\w]*/ig;

        $('#pinnwand')
        .filter(function() {
            if(this.value.match(re)!==null)
            {
                var youtube_link = this.value.match(re);
                $.ajax({'url': '/Benutzer/Pinnwand/Links',
                    'data' : {'input': youtube_link},
                    'success' : function(data){
                        $('#output').html(data.result);
                        $('#link').val(youtube_link);
                        $('#pinnwand').unbind('keydown');
                    }
                });
            }
        });
    });

    $('#PinnwandSpeichern').click(
   
    function()
    {
         if(!$.trim($('#pinnwand').val()).length) {
         $('#pinnwand').fadeIn(80).fadeOut(80).fadeIn(80).fadeOut(80).fadeIn(80).animate({'opacity': 1}).focus();
         } else {
        $.ajax({'url': '/Benutzer/Pinnwand/Speichern',
            type: 'POST',
            'data' : {'pinnwand' : $('#pinnwand').val(), 'link' : $('#link').val(), 'id' : $('#id').val() },
            'success' : function(data){
            $('#tab6').load('/Benutzer/Profil #tab6');
                $('#pinnwand').val('');
                $('#link').val('');
            }
        });
    }});

}); // end jQuery document ready
</script>";

return $imgloader;
