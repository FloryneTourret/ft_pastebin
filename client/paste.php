<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pastebin : id</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/paste.css">
</head>
<body>
  <nav class="navbar navbar-light" style="background-color:#2CFFDC ;">
    <a class="navbar-brand" href="/">Ft_pastebin</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
            </li>
            <?php if (!isset($_SESSION['id'])): ?>
                <li class="nav-item active">
                    <a class="nav-link" href="/login.php">Login<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/register.php">Register</a>
                </li>
            <?php endif;
            if (isset($_SESSION['id'])): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Disconnect
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
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