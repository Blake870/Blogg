<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=300px, initial-scale=1, maximum-scale=1">
    <title>Blog</title>
    <link href="<?= $resourcesBase; ?>css/styles.css" rel="stylesheet">
    <link href="<?= $resourcesBase; ?>css/signin.css" rel="stylesheet">
    <link href="<?= $resourcesBase; ?>css/bootstrap.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?= $resourcesBase; ?>js/bootstrap.js"></script>
</head>
<body>

<?php if (isset($data["message"])) : ?>
    <div class="message"><?= $data["message"]; ?></div>
<?php endif ?>

<form class="form-signin" action="<?= $siteBase;?>register" method="post" novalidate>
    <h1 class="h3 font-weight-normal">Please sign up</h1>
    <a class="nav-link navSign" href="<?= $siteBase;?>login">Already registered? Sign in..</a>

    <input name="username" type="username" id="inputUsername" class="form-control topForm" placeholder="Username" required="" autofocus="">

    <input name="email" type="email" id="inputEmail" class="form-control bottomForm" placeholder="Email address" required="" autofocus="">
    <div class="emailValidRes alert alert-danger"></div>

    <input name="password" type="password" id="inputPassword" class="form-control topForm pass" placeholder="Password" required="">
    <input name="repeatPassword" type="password" id="repeatPassword" class="form-control bottomForm pass" placeholder="Password" required="">
    <div class="passValidRes alert alert-danger"></div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
</form>
<script src="js/main.js"></script>
</body>
</html>
