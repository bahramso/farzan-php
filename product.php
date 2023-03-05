<?php
include_once 'lib/database.php';
include_once 'classes/product.php';

$database = new DB();
$db = $database->getConnection();

$product = new Product($db);
if (isset($_GET['id'])) {
    $product->id = $_GET['id'];
    $product->getProduct();
}
?>

<?php include 'include/header.php'; ?>

<?php  if ($product->id != null) { ?>
<main class="container">

<br>

  <div class="row mb-2">
    <div class="col-md-12">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <h3 class="mb-0">Model : <?php echo $product->model ?></h3>
          <div class="mb-1 text-muted">Color : <?php echo $product->color ?></div>
          <p class="mb-auto">Price : <?php echo $product->price ?></p>
        </div>
        <div class="col-auto d-none d-lg-block">
                <img src="/images/<?php echo $product->image ?>" width="150" alt="">
        </div>
      </div>
    </div>
  </div>

</main>
<?php }else {  echo '<div>not find</div>'; } ?>


<?php include 'include/footer.php'; ?>
