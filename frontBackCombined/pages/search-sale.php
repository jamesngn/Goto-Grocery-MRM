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
    SELECT sale.saleID as saleID, member.customer_firstname as firstname, member.customer_lastname as lastname, count(saleitem.lineNo) as noOfItems, sale.purchaseTime as purchaseTime
    FROM sale
    LEFT JOIN member
    ON sale.memberID = member.customer_id
    LEFT JOIN saleitem
    ON sale.saleID = saleitem.saleID
    ";

    if($_POST['query'] != '')
    {
    $query .= '
    WHERE member.customer_firstname LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR member.customer_lastname LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR sale.purchaseTime LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" OR sale.saleID LIKE "%'.str_replace(' ', '%', $_POST['query']).'%"
    ';
    }

    $query .= 'GROUP BY saleitem.saleID ';
    $query .= 'ORDER BY saleID ASC ';

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
                <th>Sales ID</th>
                <th class="nameHeading">Customer Name</th>
                <th># of items</th>
                <th>Date of Sales</th>
                <th class="actionHeading">Actions</th>
        </thead>
        <tbody>
    ';
    if ($total_data > 0) {
        foreach($result as $row) {
            $output .= '
            <tr>
                <td class="checkBox"><input type="checkbox" name="'.$row['saleID'].'" onclick="highlightProduct(this)"></td>
                <td>'.$row['saleID'].'</td>
                <td class="nameData">'.$row['firstname'].' '.$row['lastname'].'</td>
                <td>'.$row['noOfItems'].'</td>
                <td>'.$row['purchaseTime'].'</td>
                <td class="actions">
                    <form action="read-sale.php" method="get">
                        <input type="hidden" name="saleID" value="'.$row['saleID'].'">
                        <button type="submit"><i class="fa-solid fa-eye"></i></button>
                    </form>
                    <form action="edit-sale.php" method="get">
                        <input type="hidden" name="saleID" value="'.$row['saleID'].'">
                        <button type="submit"><i class="fa-solid fa-pen"></i></button>
                    </form>
                    <i class="fa-solid fa-trash" onclick="displayDeleteQuestion(this)" name = "saleID" value = "'.$row['saleID'].'"></i>
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
                $previous_link = '<button class="previous-btn" >Previous</button>
                ';
            } else {
                $previous_link = '<button class="previous-btn page-link" data-page_number="'.($page-1).'">Previous</button>
                ';
            }

            if ($page + 1 > count($page_array)) {
                $next_link = '<button class="next-btn" >Next</button>
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