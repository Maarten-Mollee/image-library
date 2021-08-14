<!-- IMAGES -->
<div class="no-tags-images">
    <ul class="image-list"> <?php
        if ($queryresult > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['image_id'];
                $ext = $row['extension'];
                $image = 'uploads/'.$id.$ext; ?>
                <li class="image_container">
                    <a href="image.php?id=<?php echo $id; ?>"><img alt="" src=<?php echo $image; ?>></a>
                    <!-- <form action="delete_image.php" method="post">
                        <input type="submit" name="delete" value="delete image">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                    </form> -->
                </li> <?php
            }
        } ?>
    </ul>
</div>