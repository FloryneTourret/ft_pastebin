<?php

include('header.php');
?>

<div class="col-md-10 offset-md-1 jumbotron">

    <form autocomplete="off" method="post" action="A REMPLIRIIRIRIRIRirIRIRIRIR">
        <div class="form-group">
            <label for="exampleFormControlInput1">Paste name || title</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title" name="title">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Author</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Author name" name="author">
        </div>
        <div class="form-group">
            <label style="line-height:24px;">Private</label>
            <label class="switch">
                <input type="checkbox" name="public">
                <span class="slider round"></span>
            </label>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Available time</label>
            <select class="form-control" id="exampleFormControlSelect1" name="expiration_date">
                <option value="1m">1 minute</option>
                <option value="1h">1 hour</option>
                <option value="1d">1 day</option>
                <option value="forever">Forever</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Access limit</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="0" name="max_views">
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
        <input id="content_paste" type="hidden" name="content" value="">
        <button type="submit" class="btn btn-primary" onclick="put_content();">Submit</button>
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

    function put_content()
    {
        var text = editor.getValue();
        var input = document.getElementById("content_paste");
        input.value = text;
        console.log(input.value);
    }


</script>
</body>
</html>