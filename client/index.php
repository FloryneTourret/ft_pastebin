<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--Import Google Icon Font-->
    <link rel="stylesheet" href="https:/stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https:/cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

    <!--Let browser know website is optimized for mobile-->
    <link rel="stylesheet" href="/assets/css/style.css">
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

<div class="col-md-10 offset-md-1 jumbotron">

    <form autocomplete="off" method="post" target="index.php/Home/">
        <div class="form-group">
            <label for="exampleFormControlInput1">Paste name/title</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Author</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Author name">
        </div>
        <div class="form-group">
            <label style="line-height:24px;">Private</label>
            <label class="switch">
                <input type="checkbox" name="resolu">
                <span class="slider round"></span>
            </label>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Available time</label>
            <select class="form-control" id="exampleFormControlSelect1">
                <option>1 minute</option>
                <option>1 hour</option>
                <option>1 day</option>
                <option>Forever</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Access limit</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="0">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Select language</label>
        <select class="form-control selectpicker" data-live-search="true" title="Language..." id="language_input" onchange="set_language();" name="language">
            <option>PHP</option>
            <option>Html</option>
            <option>CSS</option>
            <option>Javascript</option>
            <option>C++</option>
            <option>Python</option>
            <option>Ruby</option>
        </select>
    </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Your paste</label>

            <div id="editor" class="form-group"></div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!--JavaScript at end of body for optimized loading-->
<!-- Latest compiled and minified JavaScript -->
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https:/code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https:/cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https:/stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https:/cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

<script src="/assets/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/autocomplete.js"></script>

<script>

    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/text");
    function set_language()
    {
        var textLanguage = document.getElementById("language_input");
        editor.session.setMode("ace/mode/" + textLanguage.value.toLowerCase());
    }


</script>
</body>
</html>