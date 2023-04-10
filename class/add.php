<?php
include_once 'AddClass.php';
// create class object 
$add = new Add();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $addItem = $add->AddItem($_POST);
}

$listItem = $add->ItemList();

//delete item

if(isset($_GET['deleteId'])){
    $id = base64_decode($_GET['deleteId']);
    $delete = $add->DeleteItem($id);
}

?>

<?php 

if(!isset($_GET['id'])){
    echo "<meta http-equiv='refresh' content='0;url=?id=ahr'>";
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
                        <h2>Add ITEM</h2>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <input class="form-control form-control-lg" name="item" type="text"
                                placeholder="Enter The Item Name">
                            <button type="submit" class="btn btn-success mt-3">Add Item</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="container m-5">
        <div class="row">
            <div class="col-md-12 m-auto">
            <span>
                    <?php
                    if (isset($delete)) {
                        ?>
                        <div class="w-50 m-auto shadow alert alert-warning alert-dismissible fade show mb-2" role="alert">
                            <?= $delete ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                    }
                    ?>
                </span>
                <div class="card">
                    <div class="card-header">
                        <h2>VIEW ITEM</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#SL NO</th>
                                    <th scope="col">NAME</th>
                                    <th scope="col">CREATED AT</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($listItem) {
                                    $i = 0;
                                    while ($row = mysqli_fetch_assoc($listItem)) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $i ?></th>
                                            <td><?= $row['name'] ?></td>
                                            <td><?= $row['created_at'] ?></td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <a href="edit.php?editId=<?= base64_encode($row['id']) ?>" class="btn btn-primary">Edit</a>
                                                        <a href="?deleteId=<?= base64_encode($row['id']) ?>" onclick="return confirm('Are You Sure To Delete - <?= $row['name']?>')" class="btn btn-danger">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
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