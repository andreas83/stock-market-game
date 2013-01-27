<?php
$js = '<script type="text/javascript">
    jQuery(document).ready(function($){
        $("#an").autocomplete({
        source: "/Spiel/Nachrichten/Autocomplete",
        minLength: 2,
        autoFocus: true,
        position: { offset: "0 2" }
        });
    });
    </script>';

return $js;

?>