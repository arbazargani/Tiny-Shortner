<!-- Scripts -->
<script>
    function copy(id) {
        var copyText = document.getElementById("tiny_url");
        copyText.select();
        document.execCommand("copy");
        alert("لینک کوتاه کپی شد.");
    }
</script>
<!--<script>-->
<!--    const ScrRatio = screen.width + "*" + screen.height;-->
<!--    document.cookie = "ScreenRatio =" + ScrRatio + "; Path=/";-->
<!--</script>-->
<?php
//    setcookie('UserSession', sha1($_SERVER['HTTP_USER_AGENT']), '', '/');
//    if( isset($_COOKIE['ScreenRatio']) && isset($_COOKIE['UserSession']) ) {
//        SessionAnalysis();
//    }
