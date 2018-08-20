<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=300px, initial-scale=1, maximum-scale=1">
    <title>Blog</title>
    <link href="<?=$resourcesBase;?>css/bootstrap.css" rel="stylesheet">
    <link href="<?=$resourcesBase;?>css/styles.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?=$resourcesBase;?>js/bootstrap.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="<?= $siteBase;?>">Blogg</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?= $siteBase;?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php if (!isset($data["username"])) :?>
            <li class="nav-item">
                <a class="nav-link" href="<?= $siteBase;?>register">Sign Up</a>
            </li>
            <?php endif; ?>
            <?php if (isset($data["username"])) : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="<?= $siteBase;?>" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $data["username"];?></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <?php if ($data["userWriter"]) : ?>
                            <form class="editComment" action="<?= $siteBase;?>create" method="post" style="display: inline-block;">
                                <button type="submit" name="create" class="btn-addnew">Add new post</button>
                            </form>
                        <?php endif; ?>
                        <a class="dropdown-item" href="/index.php?act=logout">Logout</a>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
        <?php if (!isset($data["username"])) : ?>
            <a class="btn btn-primary btn-lg" href="/index.php?act=login" role="button">Sign in</a>
        <?php endif; ?>
    </div>
</nav>