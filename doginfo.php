<?php
require_once 'admin/dbconfig.php';
?>


<html>
<head>
    <?php 
        $title = "Puppy Info";
        include "head_src.php";
    ?>
</head>

<body>

    <?php include "header.php" ?>

    <div id="maincontent" align="center">

        <?php
        if(!isset($_GET["id"])) header("location: index.php");
        $dogId = $_GET["id"];
        $query = "SELECT * FROM doginfo WHERE dog_id=$dogId";
        $stmt = $DB_con->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            $puppyDB = DateTime::createFromFormat('Y-m-d', $row["birth_date"]);
            $puppyWeeks = floor($puppyDB->diff(new DateTime('now'))->days / 7);
            $puppyCarousel = array("admin/dog_images/".$dogimg1);
            if($dogimg2 != "") array_push($puppyCarousel, "admin/dog_images/".$dogimg2);
            if($dogimg3 != "") array_push($puppyCarousel, "admin/dog_images/".$dogimg3);
            $carouselCount = count($puppyCarousel);

            if($carouselCount > 1) {
        ?>

            <div class="row">
                <div class="col-xs-offset-1 col-xs-10 col-md-offset-3 col-md-6">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <?php for ($i = 1; $i < $carouselCount; $i++) { ?>
                            <li data-target="#myCarousel" data-slide-to="<?= $i ?>" <php></li>
                            <?php } ?>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                        <?php for($i = 0; $i < $carouselCount; $i++) { 
                            $carousel = $puppyCarousel[$i];
                            ?>
                            <div class="item <?php if($i == 0) print 'active'; ?>">
                                <img src="<?= $carousel ?>" alt="<?= $dog_name ?>" class="img-rounded" width="440px" height="440px">
                            </div>

                        <?php } ?>
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>

            <?php 
            } else {
            ?>
            <div style="margin: auto">
                <img src="admin/dog_images/<?= $row['dogimg1']; ?>" class="img-rounded" width="440px" height="440px"/>
            </div>
            <?php 
            }
            ?>
            <br>
            <br>

            <table id="doginf" style="margin: auto">
                <tr>
                <th>Puppy Info</th>
                <th>Details</th>

                </tr>
                <tr>
                <td>Name </td>
                <td><?= $dog_name ?></td>

                </tr>
                <tr>
                <td>Breed</td>
                <td><?= $breed ?></td>

                </tr>

                <tr>
                <td>Color</td>
                <td><?= $color ?></td>

                </tr>
                <tr>
                <td>Gender</td>
                <td><?= $gender ?></td>

                </tr>
                <tr>
                <td>Birth Date</td>
                <td><?= $birth_date ?></td>

                </tr>

                <tr>
                <td>Age</td>
                <td><?= $puppyWeeks ?> weeks</td>

                </tr>

                <tr>
                <td>Size</td>
                <td><?= $size ?></td>

                </tr>

                <tr>
                <td>Price</td>
                <td>$<?= $price ?></td>

                </tr>
                <tr>
                <td>Description</td>
                <td><?= $description ?></td>

                </tr>
            </table>


            <a href="reserve.php?id=<?= $dog_id ?>" ><button type="button" class="btn btn-reserve btn-lg">Reverse me now!</button></a>

        <?php
        } else {
        ?>
            <div class="row">
                <div class="alert alert-danger col-md-6 col-md-offset-3" role="alert">
                  <p>Sorry, we cannot find puppy with id <?= $dogId ?></p>
                </div>
            </div>        
        <?php
        }
        ?>

    </div>


    <?php include "footer.php" ?>

</body>
</html>				