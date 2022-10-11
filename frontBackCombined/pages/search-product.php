<?php
    include '../includes/dbAuthentication.inc';
    $conn = OpenConnection();

    $limit = '8';
    $page = 1;

    if ($_POST['page'] > 1) {
        $start = (($_POST['page'] - 1) * $limit);
        $page = $_POST['page'];
    } else {
        $start = 0;
    }

    $query = "
    SELECT product.id as id, product.image as image, product.name as name, product.retailPrice as retailPrice, category.Name as category 
    FROM product
    LEFT JOIN category
    ON product.category_ID = category.CategoryID
    ";

    if($_POST['query'] != '')
    {
    $query .= '
    WHERE product.name LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR category.Name LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR product.id LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR product.retailPrice LIKE "%'.str_replace(' ', '%', $_POST['query']).'%"
    ';
    }

    $query .= 'ORDER BY id ASC ';

    $filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

    
    $result = mysqli_query($conn,$query);
    $total_data = mysqli_num_rows($result);

    $result = mysqli_query($conn,$filter_query);
    $total_filter_data = mysqli_num_rows($result);

    $output = '
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
    ';
    if ($total_data > 0) {
        foreach($result as $row) {
            $output .= '
            <tr id="product'.$row['id'].'" value="<?php echo $page; ?>">
                <td class="checkBox"><input type="checkbox" name="'.$row['id'].'" onclick="highlightProduct(this)"></td>
                <td><img src="'.$row['image'].'" alt=""></td>
                <td>'.$row['id'].'</td>
                <td class="nameData">'.$row['name'].'</td>
                <td>$'.number_format($row["retailPrice"],2).'</td>
                <td>'.$row['category'].'</td>
                <td class="actions">
                    <form action="read-product.php" method="get">
                        <input type="hidden" name="productID" value="'.$row['id'].'">
                        <button type="submit"><i class="fa-solid fa-eye"></i></button>
                    </form>
                    <form action="edit-product.php" method="get">
                        <input type="hidden" name="productID" value="'.$row['id'].'">
                        <button type="submit"><i class="fa-solid fa-pen"></i></button>
                    </form>
                    <i class="fa-solid fa-trash" onclick="displayDeleteQuestion(this)" name = "productID" value = "'.$row['id'].'"></i>
                </td>
            </tr>
            ';
        }

        $output .= '
        </tbody>
        </table>
        </div>

        <div class="pageNumbers-container">
        ';

        $total_links = ceil($total_data/$limit);
        $previous_link = '';
        $next_link = '';
        $page_link = '';

        // echo $total_links;

        if ($total_links > 4) {
            if ($page < 5) 
            {
                for($count = 1; $count <= 5; $count++)
                {
                    $page_array[] = $count;
                }
                $page_array[] = '...';
                $page_array[] = $total_links;
            } 
            else 
            {
                $end_limit = $total_links - 5;
                if($page > $end_limit)
                {
                $page_array[] = 1;
                $page_array[] = '...';
                for($count = $end_limit; $count <= $total_links; $count++)
                {
                    $page_array[] = $count;
                }
                }
                else
                {
                $page_array[] = 1;
                $page_array[] = '...';
                for($count = $page - 1; $count <= $page + 1; $count++)
                {
                    $page_array[] = $count;
                }
                $page_array[] = '...';
                $page_array[] = $total_links;
                }
            }
        }
        else
        {
            for($count = 1; $count <= $total_links; $count++)
            {
                $page_array[] = $count;
            }
        }

        for($count = 0; $count < count($page_array); $count++)
        {

            if ($page - 1 < 0) {
                $previous_link = '<button class="previous-btn page-link" >Previous</button>
                ';
            } else {
                $previous_link = '<button class="previous-btn page-link" data-page_number="'.($page-1).'">Previous</button>
                ';
            }

            if ($page + 1 > count($page_array)) {
                $next_link = '<button class="next-btn page-link" >Next</button>
                ';
            } else {
                $next_link = '<button class="next-btn page-link" data-page_number="'.($page+1).'">Next</button>
                ';
            }

            if($page == $page_array[$count])
            {
                $page_link .= '
                <button class="pageNumber active">'.$page.'</button>
                ';
            }
            else
            {
                if($page_array[$count] == '...')
                {
                    $page_link .= '
                    <button class="pageNumber">'.$page_array[$count].'</button>
                    ';
                }
                else
                {
                    $page_link .= '
                    <button class="pageNumber page-link" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</button>
                    ';
                }
            }
        }
        $output .= $previous_link . $page_link . $next_link;
        $output .= '
        </ul>
        </div>
        ';

    } else {
        $output .= '
        <tr>
            <td colspan="2" align="center">No Data Found</td>
        </tr>
        ';
    }

    
    echo $output;
?>