<?php

namespace app;
use PDO;

class Database
{
    public \PDO $pdo;
    public static Database $db;

    public function __construct()

{
    $this->pdo = new \PDO('mysql:host=localhost; port=3306; dbname=product_crud', 'root', '');
    $this->pdo ->setAttribute(\PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    self::$db = $this;
}
public function getProducts($search='')
{
    
$search = $_GET['search'] ?? '';
if($search) { 
   $statement = $this->pdo->prepare('SELECT * FROM products WHERE title LIKE :title ORDER BY create_date DESC');
   $statement->bindValue(':title', "%$search%"); 
}
  else {
   $statement = $this->pdo->prepare('SELECT * FROM products ORDER BY create_date DESC');

  }

$statement->execute();
return $statement->fetchAll(PDO::FETCH_ASSOC);
}
  public function createProduct(Product $product){

    $statement = $this->pdo->prepare("INSERT INTO products (title, image, description, price, create_date)
    VALUES (:title, :image, :description, :price, :date)");

$statement->bindValue(':title', $product->title);
$statement->bindValue(':image', $product->imagepath);
$statement->bindValue(':description', $product->description);
$statement->bindValue(':price', $product->price);
$statement->bindValue(':date', date('Y-m-d H:i:s'));
$statement->execute();
  }


}