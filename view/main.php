<?php require_once "header.php" ?>

    <main role="main">
        <div class="jumbotron">
            <div class="container">
                <?php if (isset($data["username"])) : ?>
                    <h1 class="display-3">Hello, <?= $data["username"];?>!</h1>
                    <p>You are logged in blog.</p>
                <?php else : ?>
                    <h1 class="display-3">Hello, guest!</h1>
                    <p>Start Your Free Blogger Account. Check out your opportunities. Don't worry, there's no footprints or hidden costs. </p>
                    <p><a class="btn btn-primary btn-lg" href="/index.php?act=register" role="button">Sign up for free</a></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <?php foreach ($data["posts"] as $post) : ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="<?= $siteBase;?><?= $post["image"];?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $post["title"]; ?></h5>
                                <p class="card-text"><?= mb_substr($post["text"], 0, 150);?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><?= $post["date"];?><br>by <?= $post["author"];?></li>
                            </ul>
                            <div class="card-body">
                                <a href="<?= $siteBase;?>post/<?= $post["id"];?>" class="card-link">View details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <hr>

        </div> <!-- /container -->

    </main>

<?php require_once "footer.php" ?>