<div id="content">
    <div id="profile-container">
        <div class="profile-left">
            <div class="p-title">
                <div class="p-picture-container">
                    <img src="img/default-pp.jpg"></img>
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
            <div id="npk-search-container">
                <input type="text" placeholder="Search NPK..."></input>
            </div>
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
                </div> 
                <div class="pt-tab pt-update-assessment">
                    <div id="biodata">
                        <p>Nama: <?php echo $karyawan['name']?></p>
                        <p>NPK: <?php echo $karyawan['id']?></p>
                        <p>Work Station: <?php echo $karyawan['dept_name']?></p>
                    </div>
                    <div id="update-assessment">
                        <?php 
                        echo 
                        "<form action='actions/update-assessment.php?q=".$karyawan['id']."' method='post'>";
                            if ($karyawan['member_type'] != 0) unset($mp_categories['kao']);
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
                                <button type="submit" id="cu-submit-btn">UPDATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
