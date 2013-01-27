<?php

$js = '<script type="text/javascript">
jQuery(document).ready(function($) {

    window.onload = getContent(); saveContent();
    
    var $showsmilies    = $(".showsmilies");
    var $showsmiliespan = $(".showsmilies span");
    var $smileyset      = $(".smileyset");
    var $autoscroll     = $("#autoscroll");

    var updatetimer = function () {
        $("#shoutbox").scrollTop($("#shoutbox")[0].scrollHeight);
        timer = setTimeout(updatetimer, 1000);
    };

    var timer = setTimeout(updatetimer, 1000);

    $showsmiliespan.hide();
    
    $showsmilies.bind("click", function(){
            $showsmiliespan.toggle("fast");
        return true;
    });

    $smileyset.bind("click", function(){
        $(this).hide();
        return true;
    });

    $autoscroll.bind("change", function(e) {
        if($autoscroll.val() == "1") {
            clearTimeout(timer);
            updatetimer();
        } else {
            clearTimeout(timer);
        }
        return true;
    });

}); // end jQuery document ready

function getContent() {
    $("#shoutbox").load("/Spiel/Chat/getContent",
    function(data) {
        var obj = $.parseJSON(data);
        if(obj.result == "done") {
            $("#shoutbox").html(obj.content);
            $("#userlist").html(obj.user);
            setTimeout("getContent()", 3000);
        }
    });
}

function saveContent() {
    $("#chatinput").keyup(function(e) {
        if(e.keyCode == "13") {
            if($.trim(this.value).length) {
                $.post("/Spiel/Chat/saveContent", {
                    "text": $("#chatinput").val()
                },
                function(data) {
                    var obj = $.parseJSON(data);
                    if(obj.result == "done")
                    $("#chatinput").val("");
                });
            }
        }
    });
}

function past(smileys) {
    $("#chatinput").each(function(){ this.value += smileys; }).focus();
}
</script>
';

return $js;

?>
