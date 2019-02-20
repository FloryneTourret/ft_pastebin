<!DOCTYPE html>

<html lang="fr">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 

    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/style.css">

    <title>Coucou</title>
    <style type="text/css" media="screen">
</style>
</head>
<body>

<nav class="navbar navbar-light" style="background-color:#2CFFDC ;">
      <a class="navbar-brand" href="#">Ft_pastebin</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
      </li>
      <?php if (!isset($_SESSION['id'])): ?>
      <li class="nav-item active">
        <a class="nav-link" href="<?= base_url(); ?>index.php/login">Login<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?= base_url(); ?>index.php/login">Register</a>
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
    
<form autocomplete="off" method="post" target="index.php/Home">
  <div class="form-group">
    <label for="exampleFormControlInput1">Paste name/title</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Author</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Author name">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Visibility</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option>Private</option>
      <option>Public</option>
    </select>
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
  <div class="autocomplete form-group" style="width:300px;">
    <input id="language_input" class="form-control" type="text" name="language" placeholder="Language">
  </div>
  <div id="editor">function foo(items) {
    var x = "All this is syntax highlighted";
    return x;
}</div>
  <input type="submit">
</form>
</div>
	<footer>
        <script src="<?php echo base_url(); ?>assets/autocomplete.js"></script>
        <script src="<?php echo base_url(); ?>assets/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/javascript");
</script>
	</footer>
</body>
</html>