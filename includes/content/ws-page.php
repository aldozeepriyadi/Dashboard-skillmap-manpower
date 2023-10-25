<div id='content'>
    <div class='w-100 d-flex flex-row justify-content-between pr-3'>
        <div class='w-75'>
            <div id="page-title" class="w-100">
                <p><?php echo $current_ws?> Sub Workstations</p>
            </div>
            <div class="w-100 pl-3">
                <?php
                $q_heiarchy = $conn->query("
                    SELECT
                        department.id as dept_id,
                        department.dept_name as dept_name
                    FROM workstations
                    LEFT JOIN department ON workstations.dept_id = department.id
                    WHERE workstations.id = ".$ws_id."
                ");
                $current_heiarchy = $q_heiarchy->fetch_assoc();
                echo "
                <span>
                    <a href='index.php'>Home</a>
                </span>
                <span> / </span>
                <span>
                    <a href='department_workstations.php?q=".$current_heiarchy['dept_id']."'>".$current_heiarchy['dept_name']."</a>
                </span>
                <span> / </span>
                <span>
                    ".$current_ws."
                </span>
                ";
                ?>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-center pr-3">
            <a href='add_profile.php?dept=<?php echo $current_heiarchy['dept_id']?>' class='dp-create-btn-container'>
                <div id='ao-create-btn' class='h-100 w-100'>
                    <p class='m-0'>Add Profile</p>
                </div>
            </a>
        </div>
    </div>
    <div class='w-100 pt-3'>
        <script>
            var ctx_list = {}
        </script>
        <div id="ws-overall-stats">
            <?php
            $q_res = $conn->query("SELECT * FROM sub_workstations WHERE workstation_id = ".$ws_id);
            while ($ws_row = $q_res->fetch_assoc()) {
                $ws_name = $ws_row['name'];
                $ws_id = $ws_row['id'];
                $chart_id = str_replace(" ", "-", $ws_name);

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
                        LEFT JOIN karyawan_workstation ON karyawan_workstation.npk = karyawan.npk
                        LEFT JOIN sub_workstations ON karyawan_workstation.workstation_id = sub_workstations.id
                        LEFT JOIN mp_scores ON karyawan.npk = mp_scores.npk
                        WHERE sub_workstations.id = $ws_id
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
                    LEFT JOIN mp_scores ON karyawan.npk = mp_scores.npk
                    WHERE sub_workstations.id = $ws_id AND (
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
                    <a class='ws-stat-container' href='sub_workstation_members.php?q=$ws_id'>
                        <div class='ws-title'>
                            <p>$ws_name</p>
                        </div>
                        <div class='ws-content'>
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