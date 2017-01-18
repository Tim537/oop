<?php include("includes/header.php"); ?>
<?php

// Pagination
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 4;
$items_total_count = Photo::count_all();

$paginate = new Paginate($page, $items_per_page, $items_total_count);

$sql = "SELECT * FROM photos ";
$sql .= "ORDER BY id DESC ";
$sql .= "LIMIT {$paginate->items_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";

$photos = Photo::find_by_query($sql);

//$photos = Photo::find_all();
?>

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-sm-12">
        <div class="row thumbnail">
            <?php foreach ($photos as $photo): ?>

                <div class="col-xs-6 col-md-3">
                    <a class="thumbnail" href="photo.php?id=<?php echo $photo->id; ?>">
                        <img class="home_page_photo" src="admin/<?php echo $photo->picture_path(); ?>" alt="">
                    </a>
                </div>

            <?php endforeach; ?>
        </div>
        <div class="row">
            <ul class="pager">
                <?php
                if ($paginate->page_total() > 1) {
                    // Previous Button
                    if ($paginate->has_previous()) {
                        echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";
                    }

                    //Next button
                    if ($paginate->has_next()) {
                        echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>
