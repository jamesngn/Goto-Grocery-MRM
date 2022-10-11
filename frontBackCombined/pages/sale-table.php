<?php 
    include '../includes/header.inc';
?>

<body>
    <?php include '../includes/sidebar.inc';?>;
    <section class="home-section tablePage">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">SALE TABLE</span>
        </div>

        <div class="top-section">
            <div class="left-items">
                <div class="pageTitle">Sale</div>
                <div class="search-bar">
                    <form>
                        <input type="text" name="query" id="search_box" placeholder="Search Sales">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
            <div class="right-items addProductButton">
                <a href="add-sale.php">+ Add sale</a>
            </div>
        </div>

        <div id="dynamic_content">
            
        </div>

    </section>

    <script src="../js/sale.js"></script>       
    <script src="../js/sidebar.js"></script>    
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            load_data(1);

            function load_data(page, query = '') {
                $.ajax({
                    url:"search-sale.php",
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