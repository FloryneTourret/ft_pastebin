<?php

include('header.php');
?>

    <section class="content row">
        <div class="author-zone col-md-2 offset-2"><p>author name</p></div>
        <div class="paste-zone col-md-6"><p id="paste-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum id arcu quis interdum. Nulla facilisis consequat nibh, sed elementum ante porttitor placerat. Mauris porta quis dolor at finibus. Nam venenatis, felis vel feugiat auctor, tellus nulla porta mi, nec consequat massa nunc vel odio. Pellentesque ornare, felis in semper elementum, neque lectus porta nulla, sit amet sodales enim lectus eu mauris. Morbi interdum ultrices lorem vitae molestie. Donec rhoncus, mauris at porttitor ultricies, libero dui tincidunt turpis, a fringilla augue mauris eget orci. Sed eleifend sagittis gravida. Fusce non tincidunt urna. Quisque luctus ac ex at mollis. Sed vulputate laoreet scelerisque. Vivamus eu finibus nisi. Donec ornare porta erat sit amet laoreet.

                Curabitur in ligula mollis, elementum augue eget, imperdiet risus. Cras laoreet lacinia consectetur. Mauris faucibus viverra mauris in lacinia. Donec dignissim imperdiet eros, eu aliquet ipsum mattis eu. Maecenas bibendum, dui sit amet vulputate mattis, leo ante dapibus massa, vitae rutrum massa purus non nisi. Praesent sit amet porttitor ipsum. Vivamus non ex ac ante imperdiet tincidunt.</p></div>
    </section>
    <section class="content-tools row">
            <div class="col-md-1 offset-md-10"><img id="download" src="/assets/img/download.png" alt="download-icon" onclick="mydownload();"><img id="clipboard" src="/assets/img/clipboard.png" alt="download-icon" onclick="copytoclipboard();"></div>
    </section>
    <footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="/assets/js/download.js"></script>
        <script type="text/javascript">
        
            function mydownload()
            {
                var text = document.getElementById('paste-content').innerHTML;
                download(text, "paste.txt", "text/plain");
            }

            function copytoclipboard()
            {
                var text = document.querySelector('#paste-content');
                var range = document.createRange();
                range.selectNode(text);
                window.getSelection().addRange(range);
                document.execCommand('copy');
                window.getSelection().removeAllRanges();
            }
        </script>
    </footer>
</body>
</html>