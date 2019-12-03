<script>
    function test() {
    // var url = window.location.href;
    // var url = top.location.href;
    //         document.getElementById('h').innerHTML = url;
    //         if( url.indexOf('test.php')  ) {
    //             top.location.href = window.location.href;
    //         }

    if (top.location != location) {
            parent.location.href = document.location.href;
            $("body").prepend("<p>Para 4</p>");
        }
    }
            
</script>