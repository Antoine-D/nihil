 <footer>
        <div class="container text-center">
            <p>&copy; ESGI 2015-2016</p>
            <p>LINK Hugo</p>
            <p>BENARD Alexis</p>
            <p>DUMONT Antoine</p>
        </div>
        <script type="text/javascript">
            pop_up("login");
        </script>
        <script type="text/javascript">
            $('a[href^="#"]').click(function(){
                var the_id = $(this).attr("href");
                console.log("Ok");
                $('html, body').animate({
                scrollTop:$(the_id).offset().top
                }, 1000);
                return false;
            });
        </script>
</footer>