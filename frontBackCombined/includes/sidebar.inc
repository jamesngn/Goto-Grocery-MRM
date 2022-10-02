<?php
    echo 
    '<div class="sidebar">
        <div class="logo-details">
            <i class="fas fa-solid fa-store"></i>
            <span class="logo-name">Grocery</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="#">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    <span class="link-name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-name" href="#">Dashboard</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href=" #">
                        <i class="fa-solid fa-user"></i>
                        <span class="link-name">People</span>
                    </a>
                    <i class="fa-solid fa-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link-name" href="#">People</a></li>
                    <li><a href="#">Customer</a></li>
                    <li><a href="#">Employee</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class="fa-solid fa-box-archive"></i>
                        <span class="link-name">Products</span>
                    </a>
                    <i class="fa-solid fa-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link-name" href="#">Products</a></li>
                    <li><a href="#">Product</a></li>
                    <li><a href="#">Category</a></li>
                    <li><a href="#">Supplier</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-warehouse"></i>
                    <span class="link-name">Inventory</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-name" href="#">Inventory</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-store"></i>
                    <span class="link-name">Sales</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-name" href="#">Sales</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="link-name">Purchase</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-name" href="#">Purchase</a></li>
                </ul>
            </li>
            
            <li>
                <a href="#">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span class="link-name">Analytics</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-name" href="#">Analytics</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-paperclip me-2"></i>
                    <span class="link-name">Report</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-name" href="#">Report</a></li>
                </ul>
            </li>
            <div class="profile-details">
                <div class="profile-content">
                    <img src="../image/profile.png" alt="profile">
                </div>
                <div class="name-job">
                    <div class="profile-name">James Nguyen</div>
                    <div class="job">Store Employee</div>
                </div>
                <i class="fas fa-solid fa-right-from-bracket logout"></i>
            </div>
        </ul>
    </div>
    '
?>