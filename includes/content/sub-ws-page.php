<div id='content'>
    <div class='w-100 d-flex flex-row justify-content-between pr-3'>
        <div class='w-75'>
            <div id="page-title" class="w-100">
                <p><?php echo $current_ws?> Members</p>
            </div>
            <div class="w-100 pl-3">
                <?php
                $q_heiarchy = $conn->query("
                    SELECT
                        department.id as dept_id,
                        department.dept_name as dept_name,
                        workstations.id as ws_id,
                        workstations.name as ws_name
                    FROM sub_workstations
                        LEFT JOIN workstations ON sub_workstations.workstation_id = workstations.id
                        LEFT JOIN department ON workstations.dept_id = department.id
                    WHERE sub_workstations.id = ".$ws_id."
                ");
                $current_heiarchy = $q_heiarchy->fetch_assoc();
                echo "
                <span>
                    <a href='index.php'>Home</a>
                </span>
                <span> / </span>
                <span>
                    <a href='department_workstations.php?q=".$current_heiarchy['dept_id']."'>".$current_heiarchy['dept_name']."</a>
                </span>";
                if ($current_heiarchy['ws_name'] != $current_ws)
                    echo "
                <span> / </span>
                <span>
                    <a href='workstation_members.php?q=".$current_heiarchy['ws_id']."'>".$current_heiarchy['ws_name']."</a>
                </span>";
                echo "
                <span> / </span>
                <span>
                    ".$current_ws."
                </span>";
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
    <?php 
    include('includes/components/member-preview-button.php');
    include('includes/components/member-preview-button-chartless.php');
    $q_roles = $conn->query("SELECT name, id FROM roles");
    while ($role_row = $q_roles->fetch_assoc()) {
        $role = $role_row['name'];
        $role_id = $role_row['id'];
        
        if ($role != 'Operator')
            {
        echo "
    <div class='w-100 pl-3 pr-3'>
        <div class='ws-role-section'>
            <p class='m-0'>".$role."</p>
            <div class='member-list-container overflow-x'>";
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
            LEFT JOIN karyawan_workstation ON karyawan_workstation.npk = karyawan.npk
            LEFT JOIN sub_workstations ON karyawan_workstation.workstation_id = sub_workstations.id
            LEFT JOIN workstations ON sub_workstations.workstation_id = workstations.id
            LEFT JOIN roles ON karyawan.role = roles.id
            LEFT JOIN mp_scores on karyawan.npk = mp_scores.npk
            WHERE sub_workstations.id = ".$ws_id." AND role = $role_id
            ORDER BY name ASC");

        
        while ($member = $q_res->fetch_assoc()) {
                member_preview_button($member, $conn);
        }
        echo "
            </div>
        </div>
    </div>";
}
    else {
        $q_res = $conn->query("
            SELECT 
                karyawan.name as name,
                karyawan.npk as npk,
                karyawan.role as role,
                roles.name as role_name 
            FROM karyawan 
                LEFT JOIN karyawan_workstation ON karyawan_workstation.npk = karyawan.npk
                LEFT JOIN sub_workstations ON karyawan_workstation.workstation_id = sub_workstations.id
                LEFT JOIN workstations ON sub_workstations.workstation_id = workstations.id
                LEFT JOIN roles ON karyawan.role = roles.id
            WHERE sub_workstations.id = ".$ws_id." AND role = $role_id
            ORDER BY name ASC");
        echo "
    <div class='w-100 pl-3 pr-3'>
        <div class='ws-role-section'>
            <p class='m-0'>".$role."</p>
            <div class='member-list-container overflow-y d-flex'>
                <div class='member-list-container-grid'>";

        while ($member = $q_res->fetch_assoc()) {
            echo "  <div class='w-100 h-100 d-flex justify-content-center align-items-center'>";
            member_preview_button_chartless($member, $conn);
            echo "  </div>";
        }
        echo "  </div>
            </div>
        </div>
    </div>";
    }
    }
    ?>
</div>