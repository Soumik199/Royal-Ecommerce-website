<?php
define("DATA_PER_PAGE",20);
require 'database.php';
 $search_keyword = '';
    if($_SERVER['REQUEST_METHOD']=='POST') {
        $search_keyword = $_POST['search'];
    }
    $sql = 'SELECT * FROM product WHERE productname LIKE :keyword ';
    
    /* Pagination Code starts */
    $per_page_html = '';
    $page = 1;
    $start=0;
    if(!empty($_POST["page"])) {
        $page = $_POST["page"];
        $start=($page-1) * DATA_PER_PAGE;
    }
    $limit="limit " . $start . "," . DATA_PER_PAGE;
    $pagination_statement = $con->prepare($sql);
    $pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
    $pagination_statement->execute();

    $row_count = $pagination_statement->rowCount();
    if(!empty($row_count)){
        $per_page_html .= "<div style='text-align:center;margin:20px 0px;'>";
        $page_count=ceil($row_count/DATA_PER_PAGE);
        if($page_count>1) {
            for($i=1;$i<=$page_count;$i++){
                if($i==$page){
                    $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
                } else {
                    $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
                }
            }
        }
        $per_page_html .= "</div>";
    }
    
    $query = $sql.$limit;
    $pdo_statement = $con->prepare($query);
    $pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
    $pdo_statement->execute();
    $product = $pdo_statement->fetchAll(PDO::FETCH_OBJ);
    // var_dump($product);
     ?> 
<!DOCTYPE html>
<html lang="en">
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/productdis.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-light bg-light ">
        <a class="navbar-brand" href="../user/nav.php"><h5>Royal Store</h5></a>
        <form  class="form-inline" method='post'>
        <div><input class="form-control mr-sm-2"type='text' name='search' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='15' placeholder="Search your product here"></div>
        <button  class="btn btn-outline-success my-2 my-sm-0 mb-3" type="submit" class="searchButton">Search</button>
        </nav>
        
        <div class="container">
              <h3 class="h3">Diffrent Collections for Woman</h3>
           <div class="row py-2 ">
                <?php foreach($product as $prods): ?>
                    <div class="col-md-3 col-sm-6 ">
                        <div class="product-grid cards mb-5">
                            <div class="product-image">
                                <a href="productdetail.php?productid=<?=$prods->productid;?>">
                                    <img class="pic-1" src="<?= $prods->image; ?>">
                                    <!-- <img class="pic-2" src="<?= $prods->image; ?>"> -->
                                </a>
                                <span class="product-new-label">Sale</span>
                                <span class="product-discount-label"><?= $prods->productdis; ?></span>
                            </div>
                            <ul class="rating">
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star disable"></li>
                            </ul>
                            <div class="product-content">
                                <h3 class="title"><a href="#"><?= $prods->productname; ?></a></h3>
                                <div class="price">Rs:<?= $prods->productprice; ?>
                                 <span>$20.00</span>
                                </div>
                                <a class="add-to-cart" href="productdetail.php?productid=<?= $prods->productid; ?>">+ Details</a>
                            </div>
                        </div>
                    </div>               
                <?php endforeach; ?>
        </div>
        <?php echo $per_page_html; ?>
        </form> 
    </div>
    </div>


</body>
</html>