<?php 

class Database{

  public function find(){
    echo "finding a product";
  }

   public function add(string $x){
    echo "added $x using database";
  }

   public function edit(){
    echo "editing a product";
  }

   public function delete(){
    echo "deleting a product";
  }
}
// instantiation
// $product = new Database();
// $product->add("noodles ");
// $product->add("rice ");
// $product->add("yam ");
// $product->add("akara ");
// $product->add("corn ");
?>