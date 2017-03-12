<?php

function display_notices() {
    $notices = isset($_SESSION['notice']) ? $_SESSION['notice'] : array();
    
    unset($_SESSION['notice']);
    
    foreach ($notices as $notice) {
        printf(
                '<div class="notice %s"><div class="close">x</div>%s</div>', ($notice["positive"] ? 'positive' : 'negative'), $notice["message"]
        );
    }

    printf(
            '
            <script type="text/javascript">
            $(".notice .close").click(function () {
                $(this).parent().slideUp();
            });
            </script>
            '
    );
}