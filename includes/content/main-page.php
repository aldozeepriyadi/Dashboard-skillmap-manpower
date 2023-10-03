<div id="content">
    <div id="page-title">
        <p>Overall Assessments</p>
    </div>
    <div id="dept-overall-stats">
        <script>
            var ctx_list = {}
        </script>
        <?php
        $q_res = $conn->query("SELECT * FROM department");
        while ($dept_row = $q_res->fetch_assoc()) {
            $dept = $dept_row['dept_name'];
            $d_id = $dept_row['id'];
            $chart_id = str_replace(" ", "-", $dept);
            echo
                "
                <a class='dept-stat-container' href='members.php?q=$d_id&p=1'>
                    <div class='ds-title'>
                        <p>$dept</p>
                    </div>
                    <div class='ds-content'>
                ";
                include('includes/components/sm-radarchart.php');
                echo  
                    "</div>
                </a>
                ";
        }
        ?>
    </div>
</div>
