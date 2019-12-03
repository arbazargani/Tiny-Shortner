<!DOCTYPE html>
<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--    <script>-->
<!--        function ExternalHeadDom() {-->
<!--            var url = parent.location.href;-->
<!--            if ( (top.location != location) ) {-->
<!--                parent.location.href = document.location.href;-->
<!--            }-->
<!--            if(document.referrer == location) {-->
<!--                document.getElementById('ExtHead').innerHTML = '<iframe width="100%" scrolling="no" height="145" frameborder="0" marginheight="0" marginwidth="0" src="https://www.shahrekhabar.com/headerssl.jsp" name="shahrekhabar" style="background-color: #ffffff;"></iframe>';-->
<!--            }-->
<!--        }-->
<!--    </script>-->
    </head>
<body onload="ExternalHeadDom()">
<div id="ExtHead"></div>
<pre id="h"> II frame </pre>
<pre id="dd"> II frame </pre>
<span></span>
<?PHP
     if( strpos($_SERVER['HTTP_REFERER'], 'test.php') !== FALSE ) {
         $path = $_SERVER['PHP_SELF'];
         header("location: $path");
     }
?>
<h2><a href="http://localhost/tny/TEST/test.php">test</a></h2>
</body>
</html>