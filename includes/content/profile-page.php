<div id="content">
    <div class="popup hidden" id="update-popup">
        <div class='popup-content-wrapper h-100'>
            <p>Are you sure you want to update <?php echo $karyawan['name']?>?</p>
            <div class='d-flex-row justify-content-between w-100 flex-float-bottom'>
                <a href="#" class="cu-cancel-btn m-1" onclick="hide('#update-popup')">Cancel</a>
                <label for="cu-submit-btn" tabindex="0" class='cu-submit-btn m-1'>Confirm</label>
            </div>
        </div>
    </div>

    <div class="popup hidden" id="delete-popup">
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
            <?php include('includes/components/process-edit-panel.php');?>
            <div class='d-flex-row justify-content-between w-100 flex-float-bottom'>
                <a href="#" class="cu-cancel-btn m-1" onclick="hide('#edit-process-popup')">Cancel</a>
                <label for="q-submit-btn" tabindex="0" class='cu-submit-btn m-1'>Confirm</label>
            </div>
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
            echo "<span> / </span>
            <span>
                <a href='workstation_members.php?q=".$karyawan['ws_id']."'>".$karyawan['ws_name']."</a>
            </span>";

            echo "<span> / </span>
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
                <div class="p-picture-container">
                    <img src="
                        <?php 
                            $img_path = "img/profile_pictures/".$karyawan['npk'].".jpg";
                            if(file_exists($img_path)) echo $img_path;
                            else echo "img/profile_pictures/default.jpg";
                        ?>
                    "></img>
                </div>
                <div class="p-title-container">
                    <div class='d-flex-row p-name-text'>
                        <span class='w-25'>
                            <p>Nama</p>
                        </span>
                        <span class='w-75'>
                            <p>: <?php echo $karyawan['name']?></p>
                        </span>
                    </div>
                    <div class='d-flex-row p-name-text'>
                        <span class='w-25'>
                            <p>NPK</p>
                        </span>
                        <span class='w-75'>
                            <p>: <?php echo $karyawan['npk']?></p>
                        </span>
                    </div>
                    <div class='d-flex-row p-name-text'>
                        <span class='w-25'>
                            <p>Department</p>
                        </span>
                        <span class='w-75'>
                            <p>: <?php echo $karyawan['dept_name']?></p>
                        </span>
                    </div>
                    <div class='d-flex-row p-name-text'>
                        <span class='w-25'>
                            <p>Role</p>
                        </span>
                        <span class='w-75'>
                            <p>: <?php echo $karyawan['role_name']?></p>
                        </span>
                    </div>
                </div>
            </div>
            <div class="p-stats m-3 p-4">
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
        </div>
        <div class="profile-right">
            <div class="profile-table">
                <div id="pt-tab-buttons" class="fill-container">
                    <form id="pt-tab-radio" class="fill-container d-flex-row">
                    <input type="radio" id="chart-info" name="pt-tab" value="chart-info" checked>
                    <div class="pt-tab-button pt-tab-left">
                        <label for="chart-info">
                            <p>
                                CHART INFO
                            </p>
                        </label>
                    </div>
                    <input type="radio" id="update-assessment" name="pt-tab" value="update-assessment">
                    <div class="pt-tab-button pt-tab-right">
                        <label for="update-assessment">
                            <p>
                                UPDATE ASSESSMENT
                            </p>
                        </label>
                    </div>
                    </form>
                </div> 
                <div class="pt-tab pt-chart-info hidden">
                    <?php include("includes/components/mp-table-info.php")?>
                </div> 
                <div class="pt-tab pt-update-assessment">
                    <div id="update-assessment">
                        <?php 
                        echo 
                        "<form id='update-assessment-form' action='actions/update-assessment.php?q=".$karyawan['npk']."' method='post'>";
                            if (!in_array($karyawan['role'], $roles_with_kao)) unset($mp_categories['kao']);
                            foreach ($mp_categories as $cat => $cat_name) {
                                echo 
                                "<div class='cat-update-container'>
                                    <div class='cu-name'>
                                        <p>$cat_name:</p>
                                    </div>
                                    <div class='cu-radiogroup'>";
                                for ($i = 1; $i <=5 ; $i++) {
                                    echo 
                                    "<input type='radio' id='$cat-value-$i' class='update-assessment-button' name='$cat' value='$i'";
                                    if ($karyawan[$cat] == $i) echo "checked";
                                    echo
                                    "><div class='cu-radio-button'>
                                        <label for='$cat-value-$i'>
                                        <div>
                                            <p>$i</p>
                                        </div>
                                        </label>
                                    </div>";
                                }
                                echo 
                                    "</div>";
                                echo "<a href='preview_mp_file.php?q=".$karyawan['npk']."&cat=".$cat."' class='mp-file-img-container'>";
                                echo "<img src='img/file-import-solid.svg'></img>";
                                echo "</a>";
                                echo
                                "</div>";
                            }
                        ?>
                            <div class="cu-submit-wrapper">
                                <a href="#" onclick="show('#delete-popup')" class="cu-delete-btn">DELETE</a>
                                <a href="#" onclick="show('#update-popup')" class="cu-submit-btn">UPDATE</a>
                                <div class="hidden">
                                    <input type="submit" name="delete" id="cu-delete-btn">DELETE</input>
                                    <input type="submit" name="update" id="cu-submit-btn">UPDATE</input>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class='d-flex justify-content-center w-100 pt-2 pb-2'>
                <div class='p-process-panel d-flex flex-column align-items-center h-100 p-1'>
                    <div class='p-process-panel-text d-flex flex-row justify-content-between w-100 pl-1 pr-1'>
                        <p class='m-0'>Process Qualification</p>
                        <a href='#' onclick='show("#edit-process-popup")' id='process-edit-btn' class='d-flex justify-content-center align-items-center'>
                            <p class='m-0'>EDIT</p>
                        </a>
                    </div>
                    <div class="w-100 h-100 p-1">
                        <div class='p-process-panel-list w-100'>
                            <?php
                            $q_res = $conn->query("
                                SELECT process.name as name FROM karyawan
                                JOIN qualifications ON karyawan.npk = qualifications.npk
                                JOIN process ON qualifications.process_id = process.id
                                WHERE karyawan.npk = '".$karyawan['npk']."'
                            ");
                            while ($q_row = $q_res->fetch_assoc()) {
                                echo "
                                <div class='p-process-panel-list-item p-1 mb-1'>
                                    <p class='m-0'>".$q_row['name']."</p>
                                </div>
                                ";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
