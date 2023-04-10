<?php
include_once 'AddClass.php';
// create class object 
$add = new Add();

if (isset($_GET['editId'])) {
    $id = base64_decode($_GET["editId"]);
} else {
    header('location:add.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $addItem = $add->UpdateItem($_POST,$id);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Php CURD</title>
</head>

<body>

    <div class="container m-5">
        <div class="row">
            <div class="col-md-6 m-auto">
                <span>
                    <?php
                    if (isset($addItem)) {
                        ?>
                        <div class="w-50 m-auto shadow alert alert-warning alert-dismissible fade show mb-2" role="alert">
                            <?= $addItem ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                    }
                    ?>
                </span>
                <div class="card">
                    <div class="card-header">
                        <h2>EDIT ITEM</h2>
                    </div>
                    <div class="card-body">
                        <?php

                        $getData = $add->getItemData($id);

                        if ($getData) {
                            while ($row = mysqli_fetch_assoc($getData)) {
                                ?>

                                <form method="post">
                                    <input class="form-control form-control-lg" name="item" type="text"
                                        value="<?= $row['name']?>">
                                    <button type="submit" class="btn btn-info mt-3">Update Item</button>
                                </form>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>