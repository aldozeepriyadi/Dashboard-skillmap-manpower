<div id="content">
    <div class='h-100 d-flex align-items-center'>
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
                    $res = $conn->query("
                        SELECT AVG(IFNULL(mp_scores.$cat,0)) as average
                        FROM karyawan
                        LEFT JOIN mp_scores ON karyawan.npk = mp_scores.npk
                        WHERE karyawan.npk in (
                            SELECT karyawan_workstation.npk FROM karyawan_workstation
                            LEFT JOIN sub_workstations ON karyawan_workstation.workstation_id = sub_workstations.id
                            LEFT JOIN workstations ON sub_workstations.workstation_id = workstations.id
                            WHERE workstations.dept_id = $d_id
                        )
                    ");
                    $row = $res->fetch_assoc();
                    $avg_val = $row['average'];
                    $operator_mp_categories[$cat] = $avg_val;
                }
                $query_string = "
                    SELECT AVG(IFNULL(mp_scores.kao,0)) as average
                    FROM karyawan
                    LEFT JOIN karyawan_workstation ON karyawan_workstation.npk = karyawan.npk
                    LEFT JOIN sub_workstations ON karyawan_workstation.workstation_id = sub_workstations.id
                    LEFT JOIN workstations ON sub_workstations.workstation_id = workstations.id
                    LEFT JOIN mp_scores ON karyawan.npk = mp_scores.npk
                    WHERE workstations.dept_id = $d_id AND (
                ";
                foreach($roles_with_kao as $role) {
                    $query_string .= "role = $role OR ";
                }
                if (count($roles_with_kao) > 0) $query_string = substr($query_string, 0, -4);
                $query_string .= ")";
                $res = $conn->query($query_string);
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
                    <a class='dept-stat-container' href='department_workstations.php?q=$d_id'>
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
</div>
