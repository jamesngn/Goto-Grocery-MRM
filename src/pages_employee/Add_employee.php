<?php include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Add New Employee</h2>

    <form method="post" action="add-member.php">
        <fieldset>
            <legend>Enter new employee details</legend>
            <p>
                <label for="fname">First name</label>
                <input type="text" name="fname" id="fname" pattern="^[A-Za-z-]+$" maxlength="50" required />
            </p>
            <p>
                <label for="lname">Last name</label>
                <input type="text" name="lname" id="lname" pattern="^[A-Za-z-]+$" maxlength="50" required />
            </p>
            <p>
                <label for="dob">Date Of Birth</label>
                <input type="text" name="dob" id="dob" placeholder="dd/mm/yyyy" pattern="\d{1,2}\/\d{1,2}\/\d{4}" required="required">
            </p>
            <p>
                <label for="job_role">Position</label>
                <input type="text" name="job_role" id="job_role" pattern="^[A-Za-z-]+$" maxlength="50" required />
            </p>
            <p>
                <label for="salary">Salary</label>
                <input type="text" name="salary" id="salary" pattern="^[A-Za-z-]+$" maxlength="20" required />
            </p>
            <p>
                <label for="hire_date">Hiring Date</label>
                <input type="text" name="hire_date" id="hire_date" placeholder="dd/mm/yyyy" pattern="\d{1,2}\/\d{1,2}\/\d{4}" required="required">
            </p>
            <p>
            <input type="submit" value="Submit">
            <input type="reset"> 
            </p>
        </fieldset>
    </form>