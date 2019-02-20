<?php

include('header.php');
?>


    <div class="col-md-10 offset-md-1 jumbotron">

        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Name</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password Confirm</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password confirm">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

<?php

include('footer.php');
?>