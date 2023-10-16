<div id="content">
    <div class="popup hidden" id="update-popup">
        <div class='popup-content-wrapper'>
            <p>Are you sure you want to update <?php echo $karyawan['name']?>?</p>
            <div class='d-flex-row'>
                <a href="#" class="cu-cancel-btn m-1" onclick="hide('#update-popup')">Cancel</a>
                <label for="cu-submit-btn" tabindex="0" class='cu-submit-btn m-1'>Confirm</label>
            </div>
        </div>
    </div>

    <div class="popup hidden" id="delete-popup">
        <div class='popup-content-wrapper'>
            <p>Are you sure you want to delete <?php echo $karyawan['name']?>?</p>
            <div class='d-flex-row'>
                <a href="#" class="cu-cancel-btn m-1" onclick="hide('#delete-popup')">Cancel</a>
                <label for="cu-delete-btn" tabindex="0" class='cu-delete-btn m-1'>Confirm</label>
            </div>
        </div>
    </div>

    <div id="profile-container">
        <div class="profile-left">
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
                    <p class="p-title-text"> ASSESSMENT MP PRODUCTION </p>
                    <p class="p-name-text">
                        <?php echo $karyawan['name']?>
                    </p>
                </div>
            </div>
            <div class="p-stats">
                <div class="p-radar-container">
                    <?php 
                        $member = $karyawan;
                        include('includes/components/personal-radarchart.php');
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
                    <div id="biodata">
                        <p>Nama: <?php echo $karyawan['name']?></p>
                        <p>NPK: <?php echo $karyawan['npk']?></p>
                        <p>Work Station: <?php echo $karyawan['dept_name']?></p>
                        <p>Role: <?php echo $karyawan['role_name']?></p>
                    </div>
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
                                    "</div>
                                </div>";
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
        </div>
    </div>
</div>
