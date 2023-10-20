<div id="content">
    <div id="add-profile-page-container">
        <div id="page-title">
            <p>ADD PROFILE TO <?php echo strtoupper($current_dept)?></p>
        </div>
        <form  class="w-100" action="actions/add-profile.php" method="post" enctype="multipart/form-data">
            <div id="add-profile-form-container">
                <div class="ap-form-section">
                    <p>Nama:</p>
                    <input class="ap-form-input-box" name="name" type="text" maxlength='32'>
                </div>
                <div class="ap-form-section">
                    <p>NPK:</p>
                    <input class="ap-form-input-box" name="npk" type="text" maxlength="11">
                </div>
                <div class="ap-form-section">
                    <p>Role:</p>
                    <select class="ap-form-input-box" id="ap-form-role" name="role">
                        <?php 
                            $q_res = $conn->query("SELECT id, name FROM roles");
                            while ($role_row = $q_res->fetch_assoc()) {
                                $role = $role_row['name'];
                                $role_id = $role_row['id'];
                                echo "<option value='".$role_id."'>$role</option>";
                            }
                            ?>
                    </select>
                </div>
                <div class="ap-form-section">
                    <p>Workstation:</p>
                    <select class="ap-form-input-box" id="ap-form-ws" multiple>
                        <?php 
                        $q_res = $conn->query("
                            SELECT id, name 
                            FROM workstations
                            WHERE workstations.dept_id = ".$dept_id."
                            ");
                        while ($ws_row = $q_res->fetch_assoc()) {
                            $ws_name = $ws_row['name'];
                            $ws_id = $ws_row['id'];
                            echo "<option value='".$ws_id."'>$ws_name</option>";
                        }
                        ?>
                    </select>
                    <input type="text" name="ws" id="ap-form-ws-val" value='' hidden>
                </div>
                <div class="ap-form-section">
                    <p>Profile Picture:</p>
                    <input type="file" id="ap-form-photo" name="ap-form-photo" accept="image/*">
                </div>
                <div class="ap-form-section">
                    <a href="index.php" class="cu-cancel-btn">Cancel</a>
                    <button id="ap-form-submit" name="submit" class="cu-submit-btn">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
