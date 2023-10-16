<div id='content'>
    <div id="page-title" class="w-100">
        <p>Overall Assessments</p>
    </div>
    <div class="w-100 pl-3">
        <p class='m-0'>aa / bb / cc</p>
    </div>
    <div class="w-100 p-3">
        <?php 
        $q_roles = $conn->query("SELECT name, id FROM roles");
        while ($role_row = $q_roles->fetch_assoc()) {
            $role = $role_row['name'];
            $role_id = $role_row['id'];

            echo 
        "<div class='ws-role-section'>
            <p class='m-0'>".$role."</p>
            <div class='member-list-container'>";

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
                LEFT JOIN workstations ON karyawan.workstation_id = workstations.id
                LEFT JOIN roles ON karyawan.role = roles.id
                LEFT JOIN mp_scores on karyawan.npk = mp_scores.npk
                WHERE workstations.id = ".$ws_id." AND role = $role_id
                ORDER BY name ASC");
            while ($member = $q_res->fetch_assoc()) {
                $img_path = "img/profile_pictures/".$member['npk'].".jpg";
                if(!file_exists($img_path)) $img_path = "img/profile_pictures/default.jpg";
                echo
                "<div class='d-inline-block'>
                    <div class='member-container mr-3'>
                        <a href='preview_member.php?q=".$member['npk']."'>
                            <div class='member-info'>
                                <div class='member-info-texts'>
                                    <p>Name: ".$member['name']."</p>
                                    <p>NPK: ".$member['npk']."</p>
                                </div>
                                <div class='member-info-photo-container'>
                                    <img src='".$img_path."'></img>
                                </div>
                            </div>
                        </a>
                        <div class='member-stats'>";
                            include('includes/components/personal-radarchart.php');
                        echo
                        "</div>
                    </div>
                </div>";
            }
            echo "</div>
        </div>";
        }
            ?>
    </div>
</div>