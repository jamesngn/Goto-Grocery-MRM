<?php
echo '<header>
        <h1>Goto Gro MRM</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../functions.php">Function</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pages_report/configuration-generate-csv.php">CSV Report</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Member Functions
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="../pages_member/add-member.php">Create member</a>
                <a class="dropdown-item" href="../pages_member/validate-memberID-read.php">Read member</a>
                <a class="dropdown-item" href="../pages_member/validate-memberID-edit.php">Update Member</a>
                <a class="dropdown-item" href="../pages_member/validate-memberID-delete.php">Delete Member</a>
                </div>
            </li>
            </ul>
        </div>
        </nav>
    </header>';
?>