<?php
include_once('lib/database.php');
?>
<?php

class Product
{

    private $db;
    private $table_name = "products";

    public $model;
    public $price;
    public $color;
    public $image;
    public $order;

    public function __construct($db) {
        $this->db = $db;
    }

   
    public function createProduct()
    {
        $query = "INSERT INTO {$this->table_name} SET model=:model, price=:price, color=:color, image=:image";
        $stmt = $this->db->prepare($query);

        $this->model = htmlspecialchars(strip_tags($this->model));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->color = htmlspecialchars(strip_tags($this->color));

        $stmt->bindParam(":model", $this->model);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":image", $this->image);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function getallProducts($page, $records_per_page)
    {
        $start = ($page - 1) * $records_per_page;
        $order = $_GET['order'] ?? '';
        $color = $_GET['color'] ?? '';
        
        $query = "SELECT * FROM {$this->table_name}";

        if($color != '')
        {
            $query .= " WHERE color = '$color'";
        }

        if($order == 'Last')
        {
            $query .= " ORDER BY id desc";
        }elseif($order == 'First'){
            $query .= " ORDER BY id asc";
        }



        $query .= " limit $start, $records_per_page";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function countProducts() {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name;
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }

    public function getProduct() {
        $query = "SELECT * FROM {$this->table_name} WHERE id=:id";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":id", $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->model = $row['model'];
        $this->price = $row['price'];
        $this->color = $row['color'];
        $this->image = $row['image'];

    }

}


?>