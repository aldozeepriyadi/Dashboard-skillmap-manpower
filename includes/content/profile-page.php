<div id="content">
    <div class="popup popup-small popup hidden" id="update-popup">
        <div class='popup-content-wrapper h-100'>
            <p>Are you sure you want to update <?php echo $karyawan['name']?>?</p>
            <div class='d-flex-row justify-content-between w-100 flex-float-bottom'>
                <a href="#" class="cu-cancel-btn m-1" onclick="hide('#update-popup')">Cancel</a>
                <label for="cu-submit-btn" tabindex="0" class='cu-submit-btn m-1'>Confirm</label>
            </div>
        </div>
    </div>

    <div class="popup popup-small hidden" id="delete-popup">
        <div class='popup-content-wrapper h-100'>
            <p>Are you sure you want to delete <?php echo $karyawan['name']?>?</p>
            <div class='d-flex-row justify-content-between w-100 flex-float-bottom'>
                <a href="#" class="cu-cancel-btn m-1" onclick="hide('#delete-popup')">Cancel</a>
                <label for="cu-delete-btn" tabindex="0" class='cu-delete-btn m-1'>Confirm</label>
            </div>
        </div>
    </div>

    <div class='popup hidden' id='edit-process-popup'>
        <div class='popup-content-wrapper h-100'>
            <p>Edit Process Qualification for <?php echo $karyawan['name']?></p>
            <div class='d-flex flex-row w-100'>
                <p class='pl-3 m-0 w-50'>Name</p>
                <p class='m-0 ml-2'>Score</p>
                <p class='mb-0 ml-auto mr-1'>Min Score</p>
            </div>
            <?php include('includes/components/process-edit-panel.php');?>
            <div class='d-flex-row justify-content-between w-100 flex-float-bottom'>
                <a href="#" class="cu-cancel-btn m-1" onclick="hide('#edit-process-popup')">Cancel</a>
                <label for="q-submit-btn" tabindex="0" class='cu-submit-btn m-1'>Confirm</label>
            </div>
        </div>
    </div>

    <div class='popup hidden' id='edit-s-process-popup'>
        <div class='popup-content-wrapper h-100'>
            <p>Edit S-Process Qualification for <?php echo $karyawan['name']?></p>
            <?php include('includes/components/s-process-edit-panel.php');?>
            <div class='d-flex-row justify-content-between w-100 flex-float-bottom'>
                <a href="#" class="cu-cancel-btn m-1" onclick="hide('#edit-s-process-popup')">Cancel</a>
                <label for="qq-submit-btn" tabindex="0" class='cu-submit-btn m-1'>Confirm</label>
            </div>
        </div>
    </div>

    <div class='popup hidden' id='edit-picture-popup'>
        <div class='popup-content-wrapper h-100'>
            <form action="actions/edit-picture.php?q=<?php echo $karyawan['npk'];?>" method="post" class='w-100 h-100 d-flex flex-column align-items-center' enctype="multipart/form-data">
                <p>Edit Picture for <?php echo $karyawan['name']?></p>
                <input type="file" id="ap-form-photo" name="ap-form-photo" accept="image/*" class='m-5'>
                <div class='d-flex-row justify-content-between w-100 flex-float-bottom'>
                    <a href="#" class="cu-cancel-btn m-1" onclick="hide('#edit-picture-popup')">Cancel</a>
                    <input type="submit" name="update" class="cu-submit-btn"></input>
                </div>
            </form>
        </div>
    </div>

    <div id="profile-container">
        <div class="profile-left">
            <div id="page-title" class="w-100">
                <p>Assessment Production MP</p>
            </div>
            <div class="w-100 pl-3 mb-1">
                <?php 
                echo "
                <span>
                    <a href='index.php'>Home</a>
                </span>
                <span> / </span>
                <span>
                    <a href='department_workstations.php?q=".$karyawan['dept_id']."'>".$karyawan['dept_name']."</a>
                </span>";
                if ($karyawan['ws_name'] != $karyawan['sub_ws_name'])
                echo "
                <span> / </span>
                <span>
                    <a href='workstation_members.php?q=".$karyawan['ws_id']."'>".$karyawan['ws_name']."</a>
                </span>";
                echo "
                <span> / </span>
                <span>
                    <a href='sub_workstation_members.php?q=".$karyawan['sub_ws_id']."'>".$karyawan['sub_ws_name']."</a>
                </span>
                <span> / </span>
                <span>
                    ".$karyawan['name']."
                </span>
                ";
                ?>
            </div>
            <div class="p-title">
                <a href='#' onclick="show('#edit-picture-popup')" class="p-picture-container position-relative">
                    <img src="
                        <?php 
                            $img_path = "img/profile_pictures/".$karyawan['npk'].".jpg";
                            if(file_exists($img_path)) echo $img_path;
                            else echo "img/profile_pictures/default.jpg";
                        ?>
                    "></img>
                    <div id='p-picture-edit-overlay' class='w-100 h-100 justify-content-center align-items-center'>
                        <p>EDIT</p>
                    </div>
                </a>
                <div class="p-title-container">
                    <div class='d-flex-row p-name-text'>
                        <span class='w-25'>
                            <p>Nama</p>
                        </span>
                        <span>
                            <p>:</p>
                        </span>
                        <span class='w-75 pl-1'>
                            <p><?php echo $karyawan['name']?></p>
                        </span>
                    </div>
                    <div class='d-flex-row p-name-text'>
                        <span class='w-25'>
                            <p>NPK</p>
                        </span>
                        <span>
                            <p>:</p>
                        </span>
                        <span class='w-75 pl-1'>
                            <p><?php echo $karyawan['npk']?></p>
                        </span>
                    </div>
                    <div class='d-flex-row p-name-text'>
                        <span class='w-25'>
                            <p>Department</p>
                        </span>
                        <span>
                            <p>:</p>
                        </span>
                        <span class='w-75 pl-1'>
                            <p><?php echo $karyawan['dept_name']?></p>
                        </span>
                    </div>
                    <div class='d-flex-row p-name-text'>
                        <span class='w-25'>
                            <p>Role</p>
                        </span>
                        <span>
                            <p>:</p>
                        </span>
                        <span class='w-75 pl-1'>
                            <p><?php 
                            echo $karyawan['role_name'];
                            ?></p>
                        </span>
                    </div>
                    <div class='d-flex-row p-name-text'>
                        <span class='w-25'>
                            <p>Date Joined</p>
                        </span>
                        <span>
                            <p>:</p>
                        </span>
                        <span class='w-75 pl-1'>
                            <p><?php 
                            // YYYY-MM-DD TO DD-MM-YYYY
                            echo join("-", array_reverse(explode("-", $karyawan['date_joined'])));
                            ?></p>
                        </span>
                    </div>
                    <?php
                    if ($is_foreman) {
                        $workstations_query = $conn->query("
                            SELECT sub_workstations.name as name 
                            FROM karyawan_workstation
                            JOIN sub_workstations ON karyawan_workstation.workstation_id = sub_workstations.id
                            WHERE karyawan_workstation.npk = '".$karyawan['npk']."'
                        ");
                        $workstations_string = '';
                        while ($workstations_row = $workstations_query->fetch_assoc()) {
                            $workstations_string .= $workstations_row['name'].', ';
                        }
                        echo "
                    <div class='d-flex-row p-name-text'>
                        <span class='w-25'>
                            <p>Workstations</p>
                        </span>
                        <span>
                            <p>:</p>
                        </span>
                        <span class='w-75 pl-1'>
                            <p>".substr($workstations_string, 0, -2)."</p>
                        </span>
                    </div>
                            ";
                    }
                    ?>
                </div>
                <a href='update_profile.php?npk=<?php echo $karyawan['npk']?>' style='flex: 1'>
                    <img class='edit-profile-button' src="img/edit-solid.png" alt="">
                </a>
            </div>
            <div class='d-flex flex-row' style='flex: 1;'>
                <div class="p-stats m-3 p-4 background-light align-items-center justify-content-evenly" style='flex: 2;'>
                    <div class="p-radar-container">
                        <?php
                        $member = $karyawan;
                        include('includes/components/personal-radarchart.php');
                        ?>
                    </div>
                    <div id="p-stats-numeric">
                        <?php
                            foreach($mp_categories as $mp_name => $mp_label) {
                                echo "
                                <div class='d-flex-row p-name-text m-1'>
                                    <span class='w-75'>
                                        <p class='m-0'>$mp_label</p>
                                    </span>
                                    <span class='w-25'>
                                        <p class='m-0'>: ".$karyawan[$mp_name]."</p>
                                    </span>
                                </div>";
                            }
                        ?>
                    </div>
                </div>
                <div class='p-stats m-3 background-light d-flex flex-column' style='flex: 1; margin-right: 0px!important;'>
                    <div class='w-100 d-flex justify-content-around align-items-center p-2' style='border-bottom: dotted; height: 3rem'>
                        <p class='m-0' style='color: #FF1313; font-weight: 800;'>S-PROCESS</p>    
                        <a href='#' onclick='show("#edit-s-process-popup")' class='d-flex justify-content-center align-items-center'>
                            <img class='edit-profile-button' src="img/edit-solid.png" alt="" style="width: 2.5rem;">
                        </a>
                    </div>
                    <div class='mt-1'>
                        <ul>
                        <?php 
                        $q_res = $conn->query("
                            SELECT DISTINCT s_process.name as name FROM karyawan
                            JOIN s_process_certification ON karyawan.npk = s_process_certification.npk
                            JOIN s_process ON s_process_certification.s_process_id = s_process.id
                            WHERE karyawan.npk = '".$karyawan['npk']."'");
                        while ($q_row = $q_res->fetch_assoc()) {
                            echo "
                            <li>".$q_row['name']."</li>
                            ";
                        }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-right">
            <?php
            if (!$is_foreman) {
                include("includes/components/member-qualification-panel.php");
            }
            ?>
            <div class='d-flex align-items-center justify-content-center w-100' style='flex: 1 !important;'>
                <div class="profile-table background-light d-inline-flex flex-column">
                    <div id="pt-tab-buttons" class="fill-container">
                        <form id="pt-tab-radio" class="fill-container d-flex-row">
                        <input type="radio" id="chart-info" name="pt-tab" value="chart-info" checked>
                        <div class="pt-tab-button pt-tab-left">
                            <label for="chart-info">
                                <p>INFO</p>
                            </label>
                        </div>
                        <input type="radio" id="update-assessment" name="pt-tab" value="update-assessment">
                        <div class="pt-tab-button pt-tab-right">
                            <label for="update-assessment">
                                <p>UPDATE ASSESSMENT</p>
                            </label>
                        </div>
                        </form>
                    </div>
                    <div class="pt-tab pt-chart-info hidden">
                        <div class='w-100 h-100 background-light' style='flex-grow: 1; flex-shrink: 1; flex-basis: 0px; overflow: auto; border-radius: 0px 0px 12px 12px'>
                            <div class='w-100 d-flex flex-column align-items-center'>
                                <p class='m-0 mt-3' style='font-size: 1.5rem'>Manpower History</p>
                                <ul class='w-100 ps-1'>
                                    <?php 
                                    $q_res = $conn->query(
                                        "SELECT
                                            start_time,
                                            end_time,
                                            sub_workstations.name as sw_name,
                                            workstations.name as w_name,
                                            department.dept_name as d_name
                                        FROM relocate_history
                                        LEFT JOIN sub_workstations ON relocate_history.subworkstation_id = sub_workstations.id
                                        LEFT JOIN workstations ON sub_workstations.workstation_id = workstations.id
                                        LEFT JOIN department ON workstations.dept_id = department.id
                                        WHERE relocate_history.npk = '".$karyawan['npk']."'
                                        ");
                                    while ($q_row = $q_res->fetch_assoc()) {
                                        if ($q_row['end_time'] == '') $q_row['end_time'] = 'Present';
                                        if ($q_row['sw_name'] == $q_row['w_name'])
                                            $relocate_ws = $q_row['w_name']." - ".$q_row['d_name'];
                                        else
                                            $relocate_ws = $q_row['sw_name']." - ".$q_row['w_name']." - ".$q_row['d_name'];

                                        echo "
                                        <li class='mt-1'>
                                            <p class='m-0' style='font-weight:600;'>".$relocate_ws."</p>
                                            <p class='m-0'>".$q_row['start_time']." - ".$q_row['end_time']."</p>
                                        </li>
                                        ";
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class='w-100 d-flex align-items-center justify-content-center'>
                                <p class='m-0 mt-3' style='font-size: 1.5rem'>Current Files</p>
                            </div>
                            <?php 
                            $q_res = $conn->query("
                                SELECT id, filename, name, description, posted_time, mp_category
                                FROM mp_file_proof
                                WHERE npk = '".$_GET['q']."'
                                ");
                            $num_results = $q_res->num_rows;
                            if ($num_results == 0) {
                                echo "
                            <p class='ml-3'>No files found.</p>";
                            } else {
                                while ($file_row = $q_res->fetch_assoc()) {
                                    $filename = $file_row['filename'];
                                    $mp_eval = $mp_categories[$file_row['mp_category']];
                                    if ($mp_categories[$file_row['mp_category']] == '')
                                        $mp_eval = 'OTHER';
                                    echo "
                            <div class='file-preview-container w-100 p-3'>
                                <p>".$file_row['posted_time']."</p>
                                <p class='font-weight-bold'>MP Evaluation: ".$mp_eval."</p>
                                <a href='files/".$filename."' target='_blank'>
                                    <p>".$file_row['name']."</p>
                                </a>
                                <p>Description: ".$file_row['description']."</p>
                                <a href='actions/delete-file.php?q=".$file_row['id']."'>
                                    <button class='cu-submit-btn'>Delete</button>
                                </a>
                            </div>
                                    ";
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="pt-tab pt-update-assessment">
                        <div id="update-assessment" class='h-100'>
                            <?php
                            echo
                            "<form id='update-assessment-form' class='d-flex flex-column h-100' action='actions/update-assessment.php?q=".$karyawan['npk']."' method='post'>";
                                if (!in_array($karyawan['role'], $roles_with_kao)) unset($mp_categories['kao']);
                                foreach ($mp_categories as $cat => $cat_name) {
                                    echo "
                                <div class='cat-update-container'>
                                    <div class='cu-name'>
                                        <p>$cat_name:</p>
                                    </div>
                                    <div class='cu-radiogroup'>";
                                    for ($i = 1; $i <=5 ; $i++) {
                                        echo "
                                        <input type='radio' id='$cat-value-$i' class='update-assessment-button' name='$cat' value='$i'";
                                        if ($karyawan[$cat] == $i) echo "checked";
                                        echo
                                        ">
                                        <div class='cu-radio-button'>
                                            <label for='$cat-value-$i'>
                                                <div>
                                                    <p>$i</p>
                                                </div>
                                            </label>
                                        </div>";
                                    }
                                    echo"
                                    </div>
                                </div>";
                                }
                            ?>
                                <div class="d-flex w-100 flex-float-bottom d-flex-row mb-1">
                                    <div>
                                        <a href='preview_mp_file.php?q=<?php echo $karyawan['npk'];?>' class='cu-cancel-btn mp-file-img-container d-flex flex-row align-items-center'>
                                            <p>UPLOAD FILE</p>
                                            <img class="ml-1" src='img/file-import-solid-white.png'></img>
                                        </a>
                                    </div>
                                    <div class='ml-auto'>
                                        <a href="#" onclick="show('#delete-popup')" class="cu-delete-btn mr-2">DELETE</a>
                                        <a href="#" onclick="show('#update-popup')" class="cu-submit-btn">UPDATE</a>
                                        <div class="hidden">
                                            <input type="submit" name="delete" id="cu-delete-btn">DELETE</input>
                                            <input type="submit" name="update" id="cu-submit-btn">UPDATE</input>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
