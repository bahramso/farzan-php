<?php 
include_once 'lib/database.php';
include_once 'classes/Product.php';

$database = new DB();
$db = $database->getConnection();

$product = new Product($db);

if ($_POST) {
    $product->model = $_POST["model"];
    $product->color = $_POST["color"];
    $product->price = $_POST["price"];
    $product->image = $_FILES['image']['name'];

    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    if ($product->createProduct()) {
        header('location: index.php?s=1');
        echo '<div>User created successfully.</div>';
    } else {
        echo '<div>Unable to create user.</div>';
    }
}


?>

<?php include 'include/header.php'; ?>


<main class="form-signin" style="max-width:33%; margin:30px auto">
  <form method="post" enctype="multipart/form-data">
    <h1 class="h3 mb-3 fw-normal">Create Form</h1>

    <div class="form-floating">
      <input type="text" name="model" class="form-control" id="model" placeholder="model">
      <label for="floatingInput">Model</label>
    </div>
    <br/>

    <div class="form-floating">
      <input type="text" name="color" class="form-control" id="color" placeholder="color">
      <label for="floatingInput">Color</label>
    </div>
    <br/>

    <div class="form-floating">
      <input type="text" name="price" class="form-control" id="price" placeholder="price">
      <label for="floatingInput">Price</label>
    </div>

    <br/>

      <input type="file" id="image" name="image" class="form-control" id="image">


    <br/>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Submit</button>
  </form>
</main>


<?php include 'include/footer.php'; ?>
