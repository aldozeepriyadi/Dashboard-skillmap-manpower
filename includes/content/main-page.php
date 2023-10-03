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

            $operator_mp_categories = array(
                "msk"=>0.0,
                "kt"=>0.0,
                "pssp"=>0.0,
                "png"=>0.0,
                "fivejq"=>0.0
            );
            foreach($operator_mp_categories as $cat => $val) {
                $res = $conn->query("SELECT AVG($cat) as average FROM karyawan WHERE dept_id = $d_id");
                $row = $res->fetch_assoc();
                $avg_val = $row['average'];
                $operator_mp_categories[$cat] = $avg_val;
            }
            $res = $conn->query("SELECT AVG(kao) as average FROM karyawan WHERE dept_id = $d_id AND member_type = 0");
            $row = $res->fetch_assoc();
            $avg_val = $row['average'];
            $operator_mp_categories["kao"] = $avg_val;

            $labels = "['MSK', 'KT', 'PSSP', 'PNG', '5JQ', 'KAO']";
            $datas = "[".
                    $operator_mp_categories['msk'].",".
                    $operator_mp_categories['kt'].",".
                    $operator_mp_categories['pssp'].",".
                    $operator_mp_categories['png'].",".
                    $operator_mp_categories['fivejq'].",".
                    $operator_mp_categories['kao'].
                    "]";

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
