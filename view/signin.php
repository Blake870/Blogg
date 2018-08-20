<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Blog</title>
    <link href="<?= $resourcesBase; ?>css/signin.css" rel="stylesheet">
    <link href="<?= $resourcesBase; ?>css/bootstrap.css" rel="stylesheet">
    <link href="<?= $resourcesBase; ?>css/styles.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?= $resourcesBase; ?>js/bootstrap.js"></script>
</head>
<body>
<form class="form-signin" action="/login" method="post" novalidate>
    <h1 class="h3 font-weight-normal">Please sign in</h1>
    <a class="nav-link navSign" href="<?= $siteBase;?>register">Don’t have an account? Join now.</a>
    <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required=""
           autofocus="">
    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
    <div class="emailValidRes alert alert-danger"></div>
    <?php if (isset($data["message"])) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $data["message"]; ?>
        </div>
    <?php endif ?>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
</form>
<script src="<?= $resourcesBase; ?>js/main.js"></script>
</body>
</html>