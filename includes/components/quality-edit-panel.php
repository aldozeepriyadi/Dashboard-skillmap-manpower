<script src='js/edit-qualification-quality-form.js'></script>
<?php
if ($karyawan['ws_id'] == 8) {
    $q_quality = $conn->query(
        "SELECT
        quality.id as quality_id,
        quality.name as quality_name,
        quality.min_skill as quality_min_skill,
        sub_workstations.name as workstation_name,
        sub_workstations.id as sub_workstation_id,
        IF(
            quality.id IN 
                (SELECT qualifications_quality.quality_id FROM qualifications_quality WHERE qualifications_quality.npk = '{$karyawan['npk']}')
            , (SELECT value FROM qualifications_quality WHERE npk = '{$karyawan['npk']}' AND quality.id = qualifications_quality.quality_id), 0
        ) as qualification_skill,
        IF(
            quality.id IN 
                (SELECT qualifications_quality.quality_id FROM qualifications_quality WHERE qualifications_quality.npk = '{$karyawan['npk']}')
            , (SELECT status FROM qualifications_quality WHERE npk = '{$karyawan['npk']}' AND quality.id = qualifications_quality.quality_id), 0
        ) as quality_mandatory,
        IF(
            quality.id IN 
                (SELECT qualifications_quality.quality_id FROM qualifications_quality WHERE qualifications_quality.npk = '{$karyawan['npk']}')
            , (SELECT jadwal_training_quality FROM qualifications_quality WHERE npk = '{$karyawan['npk']}' AND quality.id = qualifications_quality.quality_id), ''
        ) as quality_jadwal
    FROM quality
    LEFT JOIN sub_workstations ON sub_workstations.id = quality.workstation_id
    LEFT JOIN workstations ON workstations.id = sub_workstations.workstation_id
    LEFT JOIN karyawan_workstation ON karyawan_workstation.workstation_id = sub_workstations.id
    WHERE karyawan_workstation.npk = '{$karyawan['npk']}' AND quality.name != '' OR workstations.id = '{$karyawan['ws_id']}'
    GROUP BY quality.name
    ORDER BY sub_workstations.id ASC, quality.name ASC"
    );
} else {
    $q_quality = $conn->query(
        "SELECT
            quality.id as quality_id,
            quality.name as quality_name,
            quality.min_skill as quality_min_skill,
            sub_workstations.name as workstation_name,
            IF(
                quality.id IN 
                    (SELECT qualifications_quality.quality_id FROM qualifications_quality WHERE qualifications_quality.npk = '{$karyawan['npk']}')
                , (SELECT value FROM qualifications_quality WHERE npk = '{$karyawan['npk']}' AND quality.id = qualifications_quality.quality_id), 0
            ) as qualification_skill,
            IF(
                quality.id IN 
                    (SELECT qualifications_quality.quality_id FROM qualifications_quality WHERE qualifications_quality.npk = '{$karyawan['npk']}')
                , (SELECT status FROM qualifications_quality WHERE npk = '{$karyawan['npk']}' AND quality.id = qualifications_quality.quality_id), 0
            ) as quality_mandatory,
            IF(
                quality.id IN 
                    (SELECT qualifications_quality.quality_id FROM qualifications_quality WHERE qualifications_quality.npk = '{$karyawan['npk']}')
                , (SELECT jadwal_training_quality FROM qualifications_quality WHERE npk = '{$karyawan['npk']}' AND quality.id = qualifications_quality.quality_id), ''
            ) as quality_jadwal
        FROM quality
        LEFT JOIN sub_workstations ON sub_workstations.id = quality.workstation_id
        LEFT JOIN karyawan_workstation ON karyawan_workstation.workstation_id = sub_workstations.id
        WHERE karyawan_workstation.npk = '{$karyawan['npk']}' AND quality.name != ''
        ORDER BY sub_workstations.name ASC, quality.name ASC"
    );
}

echo "<style>
.mandatory-label {
    display: flex;
    align-items: center;
    margin-left: 10px;
    font-size: 16px;
}

.mandatory-checkbox-quality {
    width: 20px;
    height: 20px;
    margin-right: 5px;
}

.custom-checkbox {
    width: 24px; /* Lebar checkbox */
    height: 24px; /* Tinggi checkbox */
    background-color: #f0f0f0; /* Warna latar belakang */
    border-radius: 5px; /* Membuat tepi menjadi bulat */
    border: 1px solid #ccc; /* Warna tepi */
    transition: 0.3s; /* Waktu transisi ketika di-click */
}

.custom-checkbox:checked {
    background-color: #4CAF50; /* Warna ketika checkbox dicentang */
}
</style>";


$current_sub_workstation_id = null;
echo "<form action='actions/update-qualifications-quality.php?q=" . $karyawan['npk'] . "' method='post' class='w-100 h-75 d-block overflow-auto'>";
echo "<div class='d-block h-100' id='update-qualification-quality-input-container' style='overflow: auto'>";
while ($p3 = $q_quality->fetch_assoc()) {
    if ($karyawan['ws_id'] == 8) {
        if ($current_sub_workstation_id != $p3['sub_workstation_id']) {
            $current_sub_workstation_id = $p3['sub_workstation_id'];
            echo "<h4>" . $p3['workstation_name'] . "</h4>";
            
        }


        echo "<div class='d-flex flex-row align-items-center'>";
        echo "<input type='checkbox'  id='p3-" . $p3['quality_id'] . "' class='hidden edit-quality-checkbox' value='{$p3['quality_id']}-{$p3['qualification_skill']}'";
        if ($p3['qualification_skill'] > 0)
            echo "checked";
        echo ">";
        // echo "<label class='process-edit-checkbox-button m-0 d-flex flex-row align-items-center' for='p-".$p['process_id']."'>";
        echo "<div class='ehs-edit-checkbox-button m-0 d-flex flex-row align-items-center' for='p3-" . $p3['quality_id'] . "'>";
        echo "<p class='m-0' style='width:25%'>" . $p3['quality_name'] . ' (' . $p3['workstation_name'] . ")</p>";
        echo "<button type='button' class='p3-edit-min-value-btn ehs-edit-val-btn' value='{$p3['quality_id']}' id='pval3-min-btn-{$p3['quality_id']}'><p>-</p></button>";
        // echo "<p class='m-0' id='pval-{$p['process_id']}'>0</p>";
        echo "<img src='img/C{$p3['qualification_skill']}.png' class='ml-1 mr-1' style='width: 20px; height: 20px;' id='pval3-{$p3['quality_id']}' value='0'>";
        echo "<button type='button' class='p3-edit-add-value-btn ehs-edit-val-btn' value='{$p3['quality_id']}' id='pval3-add-btn-{$p3['quality_id']}'><p>+</p></button>";
        echo "<img class='ml-auto mr-3' src='img/C{$p3['quality_min_skill']}.png' style='width: 20px; height: 20px;' value='0'>";

        // echo "</label><br>";
        // Contoh mengambil tanggal dari database
        $quality_jadwal = $p3['quality_jadwal']; // misalnya '2024-05-20'

        // Memformat tanggal ke format 'yyyy-mm'
        $formatted_jadwal = date('Y-m', strtotime($quality_jadwal));
        echo "<div class='ml-auto mr-4'>
    <input type='text' class='form-control datepicker' name='jadwal_training_quality-{$p3['quality_id']}' value='{$formatted_jadwal}' placeholder='yyyy-mm-dd' id='monthYearPickerQuality{$p3['quality_id']}'></div>";
        echo "<input type='checkbox' name='mandatory' class='mandatory-checkbox-quality' id='mandatory-quality-" . $p3['quality_id'] . "'";
        if ($p3['quality_mandatory'] == 1)
            echo " checked";
        echo ">";

        echo "<input type='hidden' name='mandatory_value-quality-{$p3['quality_id']}' id='mandatory_value-quality-{$p3['quality_id']}' value='{$p3['quality_mandatory']}'>";
        echo "</div><br>";
        echo "</div>";


        echo " <script>
    $(document).ready(function () {
       
        $('#monthYearPickerQuality{$p3['quality_id']}').datepicker({
            format: 'yyyy-mm',
            startView: 'months',
            minViewMode: 'months',
            autoclose: true

        });
       
    // Function to update hidden input based on checkbox state
    function updateHiddenInput(checkbox, hiddenInput) {
        if(checkbox.is(':checked')) {
            hiddenInput.val(1);
        } else {
            hiddenInput.val(0);
        }
    }

    // Listen for changes on the mandatory checkboxes
    $('.mandatory-checkbox-quality').change(function() {
        var checkboxId = $(this).attr('id');
        var hiddenInputId = checkboxId.replace('mandatory-quality', 'mandatory_value-quality');
        var hiddenInput = $('#' + hiddenInputId);
        updateHiddenInput($(this), hiddenInput);
    });

    // Initialize all checkboxes and their corresponding hidden inputs on load
    $('.mandatory-checkbox-quality').each(function() {
        var checkboxId = $(this).attr('id');
        var hiddenInputId = checkboxId.replace('mandatory-quality', 'mandatory_value-quality');
        var hiddenInput = $('#' + hiddenInputId);
        updateHiddenInput($(this), hiddenInput);
    });
        
    });
</script>";
    } else {
        echo "<div class='d-flex flex-row align-items-center'>";
        echo "<input type='checkbox'  id='p3-" . $p3['quality_id'] . "' class='hidden edit-quality-checkbox' value='{$p3['quality_id']}-{$p3['qualification_skill']}'";
        if ($p3['qualification_skill'] > 0)
            echo "checked";
        echo ">";
        // echo "<label class='process-edit-checkbox-button m-0 d-flex flex-row align-items-center' for='p-".$p['process_id']."'>";
        echo "<div class='ehs-edit-checkbox-button m-0 d-flex flex-row align-items-center' for='p3-" . $p3['quality_id'] . "'>";
        echo "<p class='m-0' style='width:25%'>" . $p3['quality_name'] . ' (' . $p3['workstation_name'] . ")</p>";
        echo "<button type='button' class='p3-edit-min-value-btn ehs-edit-val-btn' value='{$p3['quality_id']}' id='pval3-min-btn-{$p3['quality_id']}'><p>-</p></button>";
        // echo "<p class='m-0' id='pval-{$p['process_id']}'>0</p>";
        echo "<img src='img/C{$p3['qualification_skill']}.png' class='ml-1 mr-1' style='width: 20px; height: 20px;' id='pval3-{$p3['quality_id']}' value='0'>";
        echo "<button type='button' class='p3-edit-add-value-btn ehs-edit-val-btn' value='{$p3['quality_id']}' id='pval3-add-btn-{$p3['quality_id']}'><p>+</p></button>";
        echo "<img class='ml-auto mr-3' src='img/C{$p3['quality_min_skill']}.png' style='width: 20px; height: 20px;' value='0'>";

        // echo "</label><br>";
        // Contoh mengambil tanggal dari database
        $quality_jadwal = $p3['quality_jadwal']; // misalnya '2024-05-20'

        // Memformat tanggal ke format 'yyyy-mm'
        $formatted_jadwal = date('Y-m', strtotime($quality_jadwal));
        echo "<div class='ml-auto mr-4'>
    <input type='text' class='form-control datepicker' name='jadwal_training_quality-{$p3['quality_id']}' value='{$formatted_jadwal}' placeholder='yyyy-mm-dd' id='monthYearPickerQuality{$p3['quality_id']}'></div>";
        echo "<input type='checkbox' name='mandatory' class='mandatory-checkbox-quality' id='mandatory-quality-" . $p3['quality_id'] . "'";
        if ($p3['quality_mandatory'] == 1)
            echo " checked";
        echo ">";

        echo "<input type='hidden' name='mandatory_value-quality-{$p3['quality_id']}' id='mandatory_value-quality-{$p3['quality_id']}' value='{$p3['quality_mandatory']}'>";
        echo "</div><br>";
        echo "</div>";


        echo " <script>
    $(document).ready(function () {
       
        $('#monthYearPickerQuality{$p3['quality_id']}').datepicker({
            format: 'yyyy-mm',
            startView: 'months',
            minViewMode: 'months',
            autoclose: true

        });
       
    // Function to update hidden input based on checkbox state
    function updateHiddenInput(checkbox, hiddenInput) {
        if(checkbox.is(':checked')) {
            hiddenInput.val(1);
        } else {
            hiddenInput.val(0);
        }
    }

    // Listen for changes on the mandatory checkboxes
    $('.mandatory-checkbox-quality').change(function() {
        var checkboxId = $(this).attr('id');
        var hiddenInputId = checkboxId.replace('mandatory-quality', 'mandatory_value-quality');
        var hiddenInput = $('#' + hiddenInputId);
        updateHiddenInput($(this), hiddenInput);
    });

    // Initialize all checkboxes and their corresponding hidden inputs on load
    $('.mandatory-checkbox-quality').each(function() {
        var checkboxId = $(this).attr('id');
        var hiddenInputId = checkboxId.replace('mandatory-quality', 'mandatory_value-quality');
        var hiddenInput = $('#' + hiddenInputId);
        updateHiddenInput($(this), hiddenInput);
    });
        
    });
</script>";

    }
}
echo "</div>";
echo "<input type='text' name='qualificationsquality' id='ap-form-qualification-val-quality' value='' hidden>";
echo "<div class='hidden'> <input type='submit' name='update' id='q3-submit-btn'>CONFIRM</input> </div>";
echo "
    </form>
    ";
?>