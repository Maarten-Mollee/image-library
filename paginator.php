<?php
$result = mysqli_query($conn, $sql);
$queryresult = mysqli_num_rows($result);
$number_of_pages = ceil($queryresult / $result_per_page);

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$this_page_first_result = ($page - 1) * $result_per_page;
$sql = $sql." LIMIT $this_page_first_result,$result_per_page";
$result = mysqli_query($conn, $sql);

if (!isset($urltags)) {
    $urltags = '';
}

$url_items = $adress . $urltags;


if($queryresult > $result_per_page) { ?>
    <!-- PAGINATOR -->
    <div class="paginator"> <?php
        if ($page > 1){ ?>
            <div class="pagination">
                <a href="<?php echo $url_items; ?>page=1"><<</a>
            </div> <?php
        }    
        if ($page > 1){
            $prevpage = $page - 1; ?>
            <div class="pagination">
                <a href="<?php echo $url_items; ?>page=<?php echo $prevpage; ?>">prev</a>
            </div> <?php
        }
        if ($number_of_pages >= 9) {
            if($page <= 5) {
                $midpagening = 5;
            } else if ($page >= $number_of_pages - 4) {
                $midpagening = $number_of_pages - 4;
            } else {
                $midpagening = $page;
            }
            $firstpagening = $midpagening - 4;
            $lastpagening = $midpagening + 4;
        } else { 
            $firstpagening = 1;
            $lastpagening = $number_of_pages;
        }
        for ($pagenation = $firstpagening; $pagenation <= $lastpagening; $pagenation++) { ?>
            <div class="pagination">
                <a href="<?php echo $url_items; ?>page=<?php echo $pagenation; ?>"><?php echo $pagenation; ?></a> 
            </div> <?php
        }
        if ($page < $number_of_pages){
            $nextpage = $page + 1; ?>
            <div class="pagination">
                <a href="<?php echo $url_items; ?>page=<?php echo $nextpage; ?>">next</a>
            </div> <?php
        }
        if ($page < $number_of_pages){ ?>
            <div class="pagination">
                <a href="<?php echo $url_items; ?>page=<?php echo $number_of_pages; ?>">>></a>
            </div> <?php
        } ?>
    </div> <?php
} ?>
