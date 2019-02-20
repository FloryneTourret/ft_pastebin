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