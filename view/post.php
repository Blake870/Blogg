<?php require_once "header.php" ?>

    <main role="main">
        <div class="container">
            <?php if ($data["post"]) :?>
                <div class="blogShort">
                    <?php $post = $data["post"];?>
                    <h1><?= $post["title"];?></h1>
                    <img src="<?= $siteBase;?><?= $post["image"];?>" alt="post img" class="pull-left img-responsive postImg img-thumbnail margin10" style="float: left;margin-right: 15px;">
                    <?php if ($data["userWriter"]) : ?>
                        <form class="form-group form-comment" action="<?= $siteBase;?>edit/<?= $post["id"];?>" method="post">
                            <button type="submit" name="posts" class="btn btn-primary buttonViewPost" value="editPost">View</button>
                        </form>
                        <form class="form-group form-comment" action="<?= $siteBase;?>delete/<?= $post["id"];?>" method="post">
                            <button type="submit" name="posts" class="btn btn-danger buttonEditPost" value="deletePost">Delete</button>
                        </form>
                    <?php endif; ?>
                    <article>
                        <?= $post["text"];?>
                    </article>
                    <div class="authot-date pull-right"><?=$post["date"];?> <strong>by <?=$post["author"];?></strong></div>
                </div>
                <div class="clearfix"></div>
                <?php if (isset($data["messageSuccess"])) : ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            <?= $data["messageSuccess"]; ?>
                        </div>
                    </div>
                <?php elseif (isset($data["messageBad"])) : ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            <?= $data["messageBad"]; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (isset($data["username"])) :?>
                    <div class="row">
                        <form class="form-group form-comment" action="<?= $siteBase;?>post/<?= $post["id"];?>" method="post">
                            <input type="hidden" name="postId" value="<?= $post["id"];?>">
                            <textarea class="form-control" name="text" id="exampleFormControlTextarea1" rows="3" placeholder="Comment..."></textarea>
                            <input class="btn btn-primary pull-right" type="submit" name="commentAdd" value="Comment">
                        </form>
                    </div>
                <?php endif; ?>
                <?php $comments = $data["comments"];?>

            <?php if (!empty($comments)) : ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h1><small class="pull-right"><?= $data["countComments"]; ?> comments</small> Comments </h1>
                        </div>
                        <div class="comments-list">
                            <?php foreach ($comments as $comment) : ?>
                            <div class="media">
                                <p class="pull-right"><small><?=$comment["data"]?></small></p>
                                <img class="media-left" src="https://www.yourfirstpatient.com/assets/default-user-avatar-thumbnail@2x-ad6390912469759cda3106088905fa5bfbadc41532fbaa28237209b1aa976fc9.png">
                                <div class="media-body" data-commentId="<?= $comment["id"] ?>">
                                    <h4 class="media-heading user_name"><?= $comment["username"] ?></h4>
                                    <p class="textComment"><?= $comment["text"] ?></p>
                                    <form style="display: none" method="post" action="<?= $siteBase;?>post/<?= $post["id"];?>">
                                        <input type="hidden" name="commentId" value="<?= $comment["id"] ?>">
                                        <textarea class="form-control commentUpdateArea" name="text" rows="3"></textarea>
                                        <button type="submit" name="commentUpdate" class="btn btn-outline-success buttonComment updateComment">Update</button>
                                    </form>
                                    <button type="button" class="btn btn-outline-info buttonComment cancelEditComment">Cancel</button>

                                        <div class="editButtonsBlock">
                                            <?php if ($data["userWriter"]) : ?>
                                              <button type="button" class="btn btn-outline-info buttonComment editComment buttonEditComment">Edit</button>
                                              -
                                              <form class="editComment" action="<?= $siteBase;?>post/<?= $post["id"];?>" method="post" style="display: inline-block;">
                                                   <input type="hidden" name="commentId" value="<?= $comment["id"];?>">
                                                   <button type="submit" name="commentDelete" class="btn btn-outline-danger buttonComment" onclick="return confirm('Are you sure you want to delete this comment?'">Delete</button>
                                              </form>
                                            <?php endif; ?>
                                        </div>

                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php if (isset($data["scrollToCommentId"])) : ?>
                    <script type="application/javascript">
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $('div[data-commentid="<?= $data["scrollToCommentId"]; ?>"]').offset().top - 100
                        }, 500);
                    </script>
                <?php endif; ?>
            <?php endif; ?>
            <?php else: ?>
                <h1>POST NOT FOUND!!!</h1>
            <?php endif; ?>
        </div> <!-- /container -->
    </main>

<?php require_once "footer.php" ?>