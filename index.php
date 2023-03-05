<?php
include_once 'lib/database.php';
include_once 'classes/product.php';

$database = new DB();
$db = $database->getConnection();

$product = new Product($db);

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$records_per_page = 2;
$from_record_num = ($records_per_page * $page) - $records_per_page;

$stmt = $product->getallProducts($page, $records_per_page);
$num = $product->countProducts();

$total_row = $product->countProducts();
$total_page = ceil($total_row/$records_per_page);
$pagLink = "";     



?>



<?php include 'include/header.php'; ?>
<br>
<div class="container">
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">model</th>
              <th scope="col">price</th>
              <th scope="col">color</th>
              <th scope="col">image</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><a href="product.php?id=<?php echo $row['id']; ?>"><?php echo $row['model']; ?></a></td>
              <td><?php echo $row['price']; ?></td>
              <td><?php echo $row['color']; ?></td>
              <td> <img src="/images/<?php echo $row['image']; ?>" alt="" width="100"></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>


        <form method="get">
        <label for="">Sort</label>
        <select name="order" class="form-select" aria-label="Default select example">
        <option value="">choose</option>
        <option value="Last">Last Added</option>
        <option value="First">First Added</option>
        </select>

        <br>

        <label for="">color filter</label>
        <select name="color" class="form-select" aria-label="Default select example">
          <option value="">choose</option>
          <option value="red">red</option>
          <option value="blue">blue</option>
        </select>
        <br>
        <button type="submit">Submit</button>
        </form>

        <br>
        <br>

        <?php 
        
             for ($i=1; $i<=$total_page; $i++) {   
              if ($i == $page) {   
                  $pagLink .= "<li class='page-item active'><a class='page-link' href='index.php?page=".$i."'>".$i." </a></li>";   
              }               
              else  {   
                  $pagLink .= "<li class='page-item'><a class='page-link' href='index.php?page=".$i."'>   
                                                    ".$i." </a></li>";     
              }   
            };     
            

          ?>

<nav aria-label="Page navigation example">
  <ul class="pagination">
            <?php echo $pagLink ?>
  </ul>
</nav>

      </div>
</div>

<?php include 'include/footer.php'; ?>
