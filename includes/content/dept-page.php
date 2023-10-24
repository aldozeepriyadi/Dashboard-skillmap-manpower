<div id="content">
    <div class='d-flex flex-row justify-content-between w-100'>
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
        <div class="d-flex align-items-center justify-content-center pr-3">
            <a href='add_profile.php?dept=<?php echo $dept_id?>' class='dp-create-btn-container'>
                <div id='ao-create-btn' class='h-100 w-100'>
                    <p class='m-0'>Add Profile</p>
                </div>
            </a>
        </div>
    </div>
    <div class='w-100 pl-3 pr-3 mb-2 d-flex align-content-center justify-content-center'>
        <div class='ws-role-section'>
            <p class='m-0'>Foreman</p>
            <div class='member-list-container'>
            <?php
            $q_res = $conn->query("
            SELECT
                karyawan.name as name,	
                karyawan.npk as npk,
                karyawan.role as role,
                IFNULL(mp_scores.msk,0) as msk,
                IFNULL(mp_scores.kt,0) as kt,
                IFNULL(mp_scores.pssp,0) as pssp,
                IFNULL(mp_scores.png,0) as png,
                IFNULL(mp_scores.fivejq,0) as fivejq,
                IFNULL(mp_scores.kao,0) as kao,
                roles.name as role_name 
            FROM karyawan
                LEFT JOIN roles ON karyawan.role = roles.id
                LEFT JOIN mp_scores on karyawan.npk = mp_scores.npk
            WHERE karyawan.npk in (
                    SELECT karyawan_workstation.npk FROM karyawan_workstation
                    LEFT JOIN sub_workstations ON karyawan_workstation.workstation_id = sub_workstations.id
                    LEFT JOIN workstations ON sub_workstations.workstation_id = workstations.id 
                    WHERE workstations.dept_id = $dept_id )
            AND role = 0
            ORDER BY name ASC");
            include('includes/components/member-preview-button.php');
            while ($member = $q_res->fetch_assoc()) {
                member_preview_button($member);
            }
            ?>
            </div>
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
                        LEFT JOIN karyawan_workstation ON karyawan_workstation.npk = karyawan.npk
                        LEFT JOIN sub_workstations ON karyawan_workstation.workstation_id = sub_workstations.id
                        LEFT JOIN workstations ON sub_workstations.workstation_id = workstations.id 
                        LEFT JOIN mp_scores ON karyawan.npk = mp_scores.npk
                        WHERE workstations.id = $ws_id
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
                    WHERE workstations.id = $ws_id AND (
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
