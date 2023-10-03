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
                <div id="pt-tab-buttons">
                    <input type="radio" id="chart-info" name="pt-tab" value="HTML" checked>
                    <div class="pt-tab-button pt-tab-left">
                        <label for="chart-info">
                            <p>
                                CHART INFO
                            </p>
                        </label>
                    </div>
                    <input type="radio" id="update-assessment" name="pt-tab" value="HTML">
                    <div class="pt-tab-button pt-tab-right">
                        <label for="update-assessment">
                            <p>
                                UPDATE ASSESSMENT
                            </p>
                        </label>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
