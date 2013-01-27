<?php

return '
        <script type="text/javascript" src="/public/js/sha.js"></script>
        <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery("#submit").click(function(){
                shaObj =new jsSHA(jQuery("#password").val(), "ASCII");

                jQuery("#password").val(shaObj.getHash("SHA-512", "HEX"));
            });
        });
        </script>
';
?>
