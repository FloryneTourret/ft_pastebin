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

<?php
include('footer.php');
?>