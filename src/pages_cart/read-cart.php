<?php 
    session_start();
    $c_member_ID = $_SESSION["member-id"];
    
    //RETRIEVE DATA FROM CART
    include '../includes/dbAuthentication.inc';
    $conn = openConnection();

    $sql1 = "SELECT member.customer_firstname as firstname, member.customer_lastname as lastname, product.name as productName,product.price as price, cart.quantity as quantity
            FROM cart 
            LEFT JOIN member
            ON cart.memberID = member.customer_id
            LEFT JOIN product
            ON cart.productID = product.id
            WHERE memberID = '$c_member_ID' 
            ";
    $result = mysqli_query($conn,$sql1);
    $cart_info = mysqli_fetch_all($result, MYSQLI_ASSOC);

    session_unset();
    session_destroy();

    print_r($member_info);
    mysqli_free_result($result);
    

    include '../includes/header.inc'; 
?>

<head>
    <style>
        .container {
            width:70%;
        }
        table {
            width: 100%;
            margin: 0 auto;
        }
        table,th,td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }
        .total-amount {
            font-size: 1.2em;
            text-align: right;
            margin-top: 0.5em;
        }
        .total-amount span {
            font-size:1.5em;
        }
        </style>
</head>

    <body>
        <?php include '../includes/menu.inc'; ?>
        
        <?php if (count($cart_info) == 0) { 

            $sql2 = "SELECT customer_firstname, customer_lastname FROM member WHERE customer_id = '$c_member_ID'";
            $result = mysqli_query($conn,$sql2);
            if ($result) {
                $member_info = mysqli_fetch_assoc($result);    
            } 
            else {
                echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
            }
        ?>
            
        <h4>Hi <?php echo $member_info['customer_firstname'] . " " .  $member_info['customer_lastname'];?>, your shopping cart is empty !</h4>

        <?php } else { ?>

        <h2>Hi <?php echo $cart_info[0]['firstname'] . " " .  $cart_info[0]['lastname'];?>, this is your shopping cart.</h2>
        <div class="container">
            <table>
                <tr>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
                <?php foreach($cart_info as $c) {         
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($c['firstname']) . " " . htmlspecialchars($c['lastname']);  ?></td>
                    <td><?php echo htmlspecialchars($c['productName']);  ?></td>
                    <td><?php echo htmlspecialchars($c['price']);  ?></td>
                    <td><?php echo htmlspecialchars($c['quantity']); ?></td>     
                </tr>
                <?php 
                //calculate the total money:
                $total += $c['price'] * $c['quantity'];
                }?>    
            </table>
            <p class="total-amount">Total amount: <span><?php echo "$".$total?></span></p>
        </div>

        <?php ;} CloseConnection($conn);?>
    </body>
</html>

