<?php

session_start();


if (isset($_SESSION['auth'])) {
    $_SESSION['message'] = "You are already logged in.";
    header('location: index.php');
    exit();
}

include('includes/header.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if (isset($_SESSION['message'])) { ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey!</strong> <?= $_SESSION['message']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                    unset($_SESSION['message']);
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h3>Login Form</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="functions/authcode.php">

                            <div class="mb-3">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Your Password">
                            </div>

                            <button type="submit" name="login_btn" class="btn btn-primary">Log in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>