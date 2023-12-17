<?php
include_once('../inc/dbcon.php');
include_once('../inc/jobs.php');
include_once('../inc/user.php');
$user1 = new User();

?>

<?php
$job = new Jobs();
$jobs = "";
if (isset($_GET["keywords"]) && isset($_GET["locations"]) && isset($_GET["company"])) {
    $keywords = $_GET["keywords"];
    $location = $_GET["locations"];
    $company = $_GET["company"];
    $jobs = $job->read($keywords, $location, $company);
}
// $jobs = [
//     ["id" => 1, "name" => "John Doe", "email" => "john@example.com"],
//     ["id" => 2, "name" => "Jane Doe", "email" => "jane@example.com"]
// ];
?>
<?php
foreach ($jobs as $row) {
?>

    <article class="postcard light green">
        <a class="postcard__img_link" href="#">
            <!-- <img class="postcard__img" src="https://picsum.photos/300/300" alt="Image Title" /> -->
            <img class="postcard__img" src="data:image/jpeg;base64,<?= htmlspecialchars(base64_encode($row['image'])) ?>" />

            <!-- <img class="postcard__img" rc="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>" alt="Image Title" /> -->
        </a>
        <div class="postcard__text t-dark">
            <h3 class="postcard__title green"><a href="#"><?= $row['title'] ?></a></h3>
            <div class="postcard__subtitle small">
                <time datetime="2020-05-25 12:00:00">
                    <i class="fas fa-calendar-alt mr-2"></i><?= $row['date_created'] ?>
            </div>
            <div class="postcard__bar"></div>
            <div class="postcard__preview-txt"><?= $row['description'] ?></div>
            <ul class="postcard__tagbox">
                <li class="tag__item"><i class="fas fa-tag mr-2"></i><?= $row['location'] ?></li>
                <?php if (!$user1->is_logged()) { ?>
                    <li class="tag__item play green">
                        <a href="login.php"><i class="fas fa-play mr-2"></i>LOGIN TO APPLY</a>
                    </li>

                    <?php } else {
                    if (empty($job->is_accepted($row['id']))) { ?>
                        <li class="tag__item play green">
                            <a href="actions/applyjob.php?id=<?= $row['id'] ?>"><i class="fas fa-play mr-2"></i>APPLY NOW</a>
                        </li>
                        <?php
                    } else {
                        if ($job->is_accepted($row['id']) == "refused") { ?>
                            <li class="tag__item play green">
                                <h4 class="text-danger">refused</h4>
                            </li>
                        <?php
                        } elseif ($job->is_accepted($row['id']) == "accepted") {
                        ?>
                            <li class="tag__item play green">
                                <h4 class="text-success">accepted</h4>
                            </li>

                        <?php
                        } elseif ($job->is_accepted($row['id']) == "pending") {
                        ?>
                            <li class="tag__item play green">
                                <h4 class="text-primary">pending</h4>
                            </li>

                        <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </ul>
        </div>
    </article>


<?php
}
?>