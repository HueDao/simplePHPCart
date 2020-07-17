<?php
session_start();
echo '<pre>SESION';
                    print_r($_SESSION);
                    echo '</pre>';
include_once 'database.php';
$database = new Database();
$sql = 'SELECT * FROM products';
$products = $database->runQuery($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="jquery/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
  <?php 
    if(isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item'])){?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Product</h1>
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Ảnh sản phẩm</th>
                        <th scope="col">Giá tiền</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thành tiền</th>
                        <th scope="col">Xóa sản phẩm</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $tatol = 0;
                      foreach($_SESSION['cart_item'] as $key_cart=> $val_cart_item):?>
                      <tr>
                        <th ><?php echo $val_cart_item['product_id'] ?></th>
                        <td><?php echo $val_cart_item['product_name'] ?></td>
                        <td><img class="card-img-top" style="height: 45px; width: auto; display: block;" src="images/<?php echo $val_cart_item['product_image'];?>" data-holder-rendered="true">
</td>
                        <td><?php 
                          $a =  $val_cart_item['price'];
                          echo number_format($a,0,',','.');
                        ?></td>
                        <th ><?php echo $val_cart_item['quantity'] ?></th>
                        <td><?php $b = $val_cart_item['price'] * $val_cart_item['quantity'] ;
                           echo number_format($b,0,',','.').' VNĐ';
                        ?></td>
                        <td>
                          <form  name="remove<?php echo $val_cart_item['product_id'] ?>" action = 'process.php' method="POST">
                            <input type="hidden" class="form-control" name="product_id" value="<?php echo $val_cart_item['product_id'] ?>">
                            <input type="hidden" class="form-control" name="action" value="remove">

                            <input type="submit"  class="btn btn-sm btn-outline-secondary" value="Xóa " name='submitxoa'>

                          </form>
                        </td>
                        
                      </tr>
                      <?php 
                      $tatol += $b ;
                    endforeach;?>
                    </tbody>
                  </table>
                  <div>Tổng hóa đơn thanh toán <strong><?php echo number_format($tatol,0,',','.').' VNĐ';?></strong></div>
            </div>
        </div>
    <?php } else {?>
      <div class = 'container'>
        Giỏ hàng đang rỗng
      </div>
    <?php } ?>
        
        <div class="row">
            <?php
                if(!empty($products)):
                    foreach($products as $product):
                       ?>
                        <div class="col-md-6">
                        <form name="product<?php echo $product['id'];?>" action="process.php?" method="POST">
                   
                        <div class="card mb-4 box-shadow">
                          <img class="card-img-top" style="height: 315px; width: 100%; display: block;" src="images/<?php echo $product['product_image'];?>" data-holder-rendered="true">
                          <div class="card-body">
                            <p class="card-text"><?php echo $product['product_name'];?></p>
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="form-inline">
                                <input type="text" class="form-control" name="quantity" value="1">
                                <input type="hidden" class="form-control" name="action" value="add">
                                <input type="hidden" class="form-control" name="product_id" value="<?php echo $product['id'] ?>">
                                <label style="margin-left: 15px">
                                  <input type="submit"  class="btn btn-sm btn-outline-secondary" value="thêm vào giỏ hàng" name='submit'>
                                </label>
                              </div>
                             
                            </div>
                          
                        </div>
                      </div>
                </form>
            </div>
                    <?php endforeach;?>
                    <?php endif;
            ?>
            
        </div>
        
    </div>
</body>
</html>