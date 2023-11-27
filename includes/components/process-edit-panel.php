<script src='js/edit-qualification-form.js'></script>
<?php
    $q_process = $conn->query(
        "SELECT
            process.id as process_id,
            process.name as process_name,
            process.min_skill as process_min_skill,
            sub_workstations.name as workstation_name,
            IF(
                process.id IN 
                    (SELECT qualifications.process_id FROM qualifications WHERE qualifications.npk = '{$karyawan['npk']}')
                , (SELECT value FROM qualifications WHERE npk = '{$karyawan['npk']}' AND process.id = qualifications.process_id), 0
            ) as qualification_skill
        FROM process
        LEFT JOIN sub_workstations ON sub_workstations.id = process.workstation_id
        LEFT JOIN karyawan_workstation ON karyawan_workstation.workstation_id = sub_workstations.id
        WHERE karyawan_workstation.npk = '{$karyawan['npk']}' AND process.name != ''
        ORDER BY process.name ASC, sub_workstations.name ASC"
    );

    echo "
    <form action='actions/update-qualifications.php?q=".$karyawan['npk']."' method='post' class='w-100 h-75 d-block overflow-auto'>
    ";
    echo "<div class='d-block h-100' style='overflow: auto'>";
    while($p = $q_process->fetch_assoc()) {
        echo "<div class='d-flex flex-row align-items-center'>";
        echo "<input type='checkbox'  id='p-".$p['process_id']."' class='hidden edit-process-checkbox' value='{$p['process_id']}-{$p['qualification_skill']}'";
        if ($p['qualification_skill'] > 0) echo "checked";
        echo ">";
        // echo "<label class='process-edit-checkbox-button m-0 d-flex flex-row align-items-center' for='p-".$p['process_id']."'>";
        echo "<div class='process-edit-checkbox-button m-0 d-flex flex-row align-items-center' for='p-".$p['process_id']."'>";
        echo "<p class='m-0' style='width:50%'>".$p['process_name'].' ('.$p['workstation_name'].")</p>";
        echo "<button type='button' class='p-edit-min-value-btn' value='{$p['process_id']}' id='pval-min-btn-{$p['process_id']}'>-</button>";
        // echo "<p class='m-0' id='pval-{$p['process_id']}'>0</p>";
        echo "<img src='img/C{$p['qualification_skill']}.png' class='ml-1 mr-1' style='width: 20px; height: 20px;' id='pval-{$p['process_id']}' value='0'>";
        echo "<button type='button' class='p-edit-add-value-btn' value='{$p['process_id']}' id='pval-add-btn-{$p['process_id']}'>+</button>";
        echo "<img class='ml-auto mr-3' src='img/C{$p['process_min_skill']}.png' style='width: 20px; height: 20px;' value='0'>";
        // echo "</label><br>";
        echo "</div><br>";
        echo "</div>";
    }
    echo "</div>";
    echo "<input type='text' name='qualifications' id='ap-form-qualification-val' value='' hidden>";
    echo "<div class='hidden'> <input type='submit' name='update' id='q-submit-btn'>CONFIRM</input> </div>";
    echo "
    </form>
    ";
?>
