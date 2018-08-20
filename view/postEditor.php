<?php require_once "header.php"; ?>
    <?php if (isset($data)) : ?>
        <?php $post = $data["post"]; ?>
        <form class="postForm" method="post" enctype="multipart/form-data" action="<?= $siteBase;?><?= $data["act"]; ?>/<?= $post["id"];?>">
            <?php if (isset($data["messageSuccess"])) : ?>
                <div class="row">
                    <div class="alert alert-success" role="alert" style="margin-bottom: 1rem;">
                        <?= $data["messageSuccess"]; ?>
                    </div>
                </div>
            <?php elseif (isset($data["messageBad"])) : ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert" style="margin-bottom: 1rem;">
                        <?= $data["messageBad"]; ?>
                    </div>
                </div>
            <?php endif; ?>
            <input type="hidden" name="postAct" value="view">
            <input type="text" class="form-control titleInput" name="title" placeholder="Title" value="<?= $post["title"]; ?>">
            <input class="form-control authorInput" type="text" placeholder="Author" value="<?= $data["author"]; ?>" readonly>
            <div class="form-group addFile">
                <label for="exampleFormControlFile1" class="buttonAddImage">
                    <img src="<?= $siteBase;?><?= $post["image"]; ?>">
                    <div class="btn btn-primary">Update Image</div>
                </label>
                <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <textarea class="form-control" name="text" id="exampleFormControlTextarea1" rows="3" placeholder="Content..."><?= $post["text"]; ?></textarea>
            <div class="clearfix"></div>
            <?php if($data["act"] == "edit"): ?>
            <a href="/post/<?= $post["id"]; ?>"><div class="btn btn-primary">Back to the post</div></a>
            <?php endif; ?>
            <?php if($data["act"] == "edit"): ?>
                <button type="submit" name="update" class="btn btn-primary updatePost">Update Post</button>
            <?php elseif($data["act"] == "create"): ?>
                <button type="submit" name="update" class="btn btn-primary updatePost">Update Post</button>
            <?php endif; ?>
        </form>
        <div class="clearfix"></div>
    <?php endif; ?>
<?php require_once "footer.php"; ?>