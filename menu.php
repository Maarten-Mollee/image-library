<nav>
    <div class="navbar">
        <div class="admin_dropdown">
            <button class="dropbutton">---</button>
            <div class="dropdown">
                <a href="index.php">image searcher</a>
                <a href="../mhr_progress/index.php">mhr progress</a>
                <a href="../one_piece_project/pages/index.php">one piece theory</a>
                <a href="../dagboek/dagboek.php">dagboek</a>
            </div>
        </div>
        <a href="index.php">Index</a>
        <a href="posts.php?page=1">Posts</a>
        <?php  if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){ ?>
            <div class="admin_dropdown">
                <button class="dropbutton">Admin page</button>
                <div class="dropdown">
                    <a href="add_image.php">add image</a>
                    <a href="no_tag_images.php">add tags</a>
                    <a href="all_tags.php">all tags</a>
                </div>
            </div>
        <?php }
        if (isset($_SESSION['login'])){
            echo '<a href="mypage.php">My page</a>';
        }
        if (!isset($_SESSION['login'])){
            ?>
            <form action="Login.php" method="post" class="menuform">
                <input type="submit" value="Login" name="login" class="inout_form">
                <input type="password" name="password" class="login_text" placeholder="password:">
                <input type="text" name="name" class="login_text" placeholder="name:">
            </form>
            <a href="register.php">Register</a>
            <?php
        }else{
            ?>
            <form action="logout.php" method="post" class="menuform">
                <input type="submit" name="logout" value="logout" class="inout_form">
            </form>
            <?php
        }
        ?>
        <!-- <a href="contact.php">Contact</a> -->
        <a href="safemodepage.php">Explicit</a>
        <?php  if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){ ?>
            <div class="admin_dropdown">
                <button class="dropbutton">unfinished</button>
                <div class="dropdown">
                    <a href="add_artist.php">add artist</a>
                    <a href="add_link.php">add link</a>
                    <a href="0_count_tags.php">0 count tags</a>
                </div>
            </div>
        <?php } ?>
        <a href="worlds.php">Worlds</a>
    </div>
</nav>