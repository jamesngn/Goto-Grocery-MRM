<?php 
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/sidebar.inc';?>;
    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">Dashboard</span>
        </div>

        <div class="content-container">
            <div class="sub-container top-container">
                <div class="item item1">
                    <h4>Overview</h4>
                    <div class="card-container">
                        <div class="card card1">
                            <div class="value">
                                30
                            </div>
                            <div class="title">
                                members
                            </div>
                        </div>
                        <div class="card card2">
                            <div class="value">
                                100
                            </div>
                            <div class="title">
                                products
                            </div>
                        </div>
                        <div class="card card3">
                            <div class="value">
                                $1000
                            </div>
                            <div class="title">
                                purchase
                            </div>
                        </div>
                        <div class="card card4">
                            <div class="value">
                                $300
                            </div>
                            <div class="title">
                                sales
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item item2" >
                    <h4>Inventory Summary</h4>
                    <div class="card-container">
                        <div class="card card1">
                            <div class="title">
                                quantity in hand
                            </div>
                            <div class="value">
                                654
                            </div>
                        </div>
                        <div class="card card2">
                            <div class="title">
                                quantity to be received
                            </div>
                            <div class="value">
                                100
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sub-container middle-container">
                <div class="item item3" >
                    <h4>Top Selling Variants</h4>
                    <div class="card-container">
                        <div class="card card1">
                            <img src="https://cdn.shopify.com/s/files/1/0024/9803/5810/products/596688-Product-0-I-637982218040540343_300x300.jpg?v=1662700885" alt="">
                            <div class="title">
                                iPhone 14 Pro Max
                            </div>
                            <div class="value">
                                10 <span>Qty</span>
                            </div>
                        </div>
                        <div class="card card2">
                            <img src="https://cdn.shopify.com/s/files/1/0024/9803/5810/products/596688-Product-0-I-637982218040540343_300x300.jpg?v=1662700885" alt="">
                            <div class="title">
                                iPhone 14 Pro Max
                            </div>
                            <div class="value">
                                10 <span>Qty</span>
                            </div>
                        </div>
                        <div class="card card3">
                            <img src="https://cdn.shopify.com/s/files/1/0024/9803/5810/products/596688-Product-0-I-637982218040540343_300x300.jpg?v=1662700885" alt="">
                            <div class="title">
                                iPhone 14 Pro Max
                            </div>
                            <div class="value">
                                10 <span>Qty</span>
                            </div>
                        </div>
                        <div class="card card4 unshown">
                            <img src="https://cdn.shopify.com/s/files/1/0024/9803/5810/products/596688-Product-0-I-637982218040540343_300x300.jpg?v=1662700885" alt="">
                            <div class="title">
                                iPhone 14 Pro Max
                            </div>
                            <div class="value">
                                10 <span>Qty</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item item4">
                    <h4>Product Details</h4>
                    <div class="card-container">
                        <div class="card card1">
                            <div class="title">Low Stock Items</div>
                            <div class="value">10</div>
                        </div>
                        <div class="card card2">
                            <div class="title">All Items</div>
                            <div class="value">130</div>
                        </div>
                        <div class="card card3">
                            <div class="title">All Categories</div>
                            <div class="value">7</div>
                        </div>
                    </div>
                </div>
                <div class="item item5">
                    <h4>Number of Units Sold</h4>
                    <canvas id="chart1"></canvas>
                </div>
            </div>
            <div class="sub-container bottom-container">
                <div class="item item6">
                    <h4>Sales Orders</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Order Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>OR1000</td>
                                <td>Quang Nguyen</td>
                                <td>22-09-2022</td>
                                <td>
                                    <div class="confirm">Confirm</div>
                                </td>
                                <td>$100.00</td>
                            </tr>
                            <tr>
                                <td>OR1000</td>
                                <td>Quang Nguyen</td>
                                <td>22-09-2022</td>
                                <td>
                                    <div class="cancel">Cancel</div>
                                </td>
                                <td>$100.00</td>
                            </tr>
                            <tr>
                                <td>OR1000</td>
                                <td>Quang Nguyen</td>
                                <td>22-09-2022</td>
                                <td>
                                    <div class="confirm">Confirm</div>
                                </td>
                                <td>$100.00</td>
                            </tr>
                            <tr>
                                <td>OR1000</td>
                                <td>Quang Nguyen</td>
                                <td>22-09-2022</td>
                                <td>
                                    <div class="cancel">Cancel</div>
                                </td>
                                <td>$100.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="item item7">
                    <h4>Purchase Orders</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="order-id">PO1000</div>
                                    <div class="supplier">CodeBlocker</div>
                                </td>
                                <td>$4500.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="order-id">PO1000</div>
                                    <div class="supplier">CodeBlocker</div>
                                </td>
                                <td>$4500.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="item item8">
                    <h4>Purchase Summary</h4>
                    <canvas id="chart2"></canvas>
                </div>
            </div>
        </div>
    </section>

    <script src="../js/sidebar.js"></script>
    <script src="../js/dashboard.js"></script>        
</body>
</html>
    
