<div id="content">
    <div class='d-flex flex-row w-100 pr-2'>
        <div class='w-75'>
            <div id="page-title">
                <p>Workstations for <?php echo $current_dept ?></p>
            </div>
            <div class="pl-3">
                <?php 
                echo "
                <span>
                    <a href='index.php'>Home</a>
                </span>
                <span> / </span>
                <span>
                    ".$current_dept."
                </span>
                ";
                ?>
            </div>
        </div>
        <div class="w-25">
            <a href='add_profile.php' class='p-1 m-0 w-100'>
                <div id='ao-create-btn' class='w-100'>
                    <p class='m-0'>Add Profile</p>
                </div>
            </a>
        </div>
    </div>
    <div class='w-100'>
        <div id="ws-overall-stats">
            <script>
                var ctx_list = {}
            </script>
            <?php
            $q_res = $conn->query("SELECT * FROM workstations WHERE dept_id = ".$dept_id);
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
                        LEFT JOIN mp_scores ON karyawan.npk = mp_scores.npk
                        WHERE workstation_id = $ws_id
                    ");
                    $row = $res->fetch_assoc();
                    $avg_val = $row['average'];
                    $operator_mp_categories[$cat] = $avg_val;
                }
                $query_string = "
                    SELECT AVG(IFNULL(mp_scores.kao,0)) as average 
                    FROM karyawan
                    LEFT JOIN mp_scores ON karyawan.npk = mp_scores.npk
                    WHERE workstation_id = $ws_id AND (
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
                    <a class='ws-stat-container' href='workstation_members.php?q=$ws_id'>
                        <div class='ds-title'>
                            <p>$ws_name</p>
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
    <!-- <div id="admin-options">
        <div class='w-25'>
            <a href='add_profile.php' class='p-1 m-0 w-100'>
                <div id='ao-create-btn' class='w-100 h-100'>
                    <p class='m-0'>Add Profile</p>
                </div>
            </a>
        </div>
    </div> -->
</div>
