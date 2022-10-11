<?php 
    include '../includes/header.inc';
?>

<body>
    <?php include '../includes/sidebar.inc';?>;
    <section class="home-section tablePage">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">PRODUCT TABLE</span>
        </div>

        <div class="top-section">
            <div class="left-items">
                <div class="pageTitle">Product</div>
                <div class="search-bar">
                    <form action="product-table.php" method="get">
                        <input type="text" name="query" id="search_box" placeholder="Search Products">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
            <div class="right-items addProductButton">
                <a href="add-product.php">+ Add product</a>
            </div>
        </div>

        <div id="dynamic_content">
            <div class="table-container">
                <table>
                    <thead>
                            <th class="checkBox">
                                <input type="checkbox" id="" onclick="highlightAll(this)">
                            </th>
                            <th class="imageHeading">Image</th>
                            <th>ID</th>
                            <th class="nameHeading">Name</th>
                            <th>Retail Price</th>
                            <th>Category</th>
                            <th class="actionHeading">Actions</th>
                    </thead>
                    <tbody>

                    
                    </tbody>
                </table>
            </div>
    
            <div class="pageNumbers-container">
                 

            </div>
        </div>

    </section>

    <script src="../js/product.js"></script>       
    <script src="../js/sidebar.js"></script>    
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            load_data(1);

            function load_data(page, query = '') {
                $.ajax({
                    url:"search-product.php",
                    method:"POST",
                    data:{page:page, query:query},
                    success:function(data) 
                    {
                        $('#dynamic_content').html(data);
                    }
                });
            }

            $(document).on('click', '.page-link', function(){
                var page = $(this).data('page_number');
                var query = $('#search_box').val();
                load_data(page, query);
            });

            $('#search_box').keyup(function(){
                var query = $('#search_box').val();
                load_data(1, query);
            });
        });      
    </script>
</body>
</html>