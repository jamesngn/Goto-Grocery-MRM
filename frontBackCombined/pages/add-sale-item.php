<?php 
    include '../includes/dbAuthentication.inc';
    $conn = OpenConnection();

    $sql = "SELECT customer_id, customer_firstname, customer_lastname FROM member";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $members = mysqli_fetch_all($result);
    }

    $sql = "SELECT id, name, retailPrice FROM product";
    $result = mysqli_query($conn,$sql);

    if ($result) {
        $products = mysqli_fetch_all($result);
    }
    CloseConnection($conn);

    $output = 
    '<div class="form-item">
        <select name="productID'.$_POST['value'].'" id="product" onchange="updatePrice(this)">
            <option value="">Choose a product</option>
    ';

    foreach($products as $product) {
        $output .= '<option value="'.$product[0].','.$product[2].'">'.$product[1].'</option>';
    }
    $output .= '
        </select>
    </div>
        <div class="form-item">
            <input type="text" name="price'.$_POST['value'].'" id="price" value="" readonly>
        </div>
        <div class="form-item">
            <input type="number" name="quantity'.$_POST['value'].'" id="quantity" min="0" max="99999" value="0" onchange="calculateSubtotal(this)" onkeyup="calculateSubtotal(this)">
        </div>
        <div class="form-item">
            <input type="text" name="subtotal'.$_POST['value'].'" id="subtotal" value="" readonly>
        </div>

    ';

    echo $output;  
?>