<div id="content">
    <div id="page-title">
        <p>Overall Assessments</p>
    </div>
    <div id="dept-overall-stats">
        <script>
            var ctx_list = {}
        </script>
        <?php
        // $depts = array(
        //     'Production 1',
        //     'Production 2',
        //     'Production 3',
        //     'Production 4',
        //     'Production 5'
        // );
        $q_res = $conn->query("SELECT * FROM department");
        // foreach ($depts as $dept) {
        while ($dept_row = $q_res->fetch_assoc()) {
            $dept = $dept_row['dept_name'];
            $chart_id = str_replace(" ", "-", $dept);
            echo
                "
                <div class='dept-stat-container'>
                    <div class='ds-title'>
                        <p>$dept</p>
                    </div>
                    <div class='ds-content'>
                ";
                include('includes/components/sm-radarchart.php');
                echo  
                    "</div>
                </div>
                ";
        }
        ?>
    </div>
</div>