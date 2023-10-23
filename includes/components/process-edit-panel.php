<script src='js/edit-qualification-form.js'></script>
<?php
    $q_process = $conn->query(
        "SELECT
            process.id as process_id,
            process.name as process_name,
            workstations.name as workstation_name,
            IF(
                process.id IN 
                    (SELECT qualifications.process_id FROM qualifications WHERE qualifications.npk = '".$karyawan['npk']."')
                , 'yes', 'no'
            ) as qualified
        FROM process
        LEFT JOIN workstations ON workstations.id = process.workstation_id
        LEFT JOIN karyawan_workstation ON karyawan_workstation.workstation_id = workstations.id
        WHERE karyawan_workstation.npk = '".$karyawan['npk']."' AND process.name != ''
        ORDER BY process.name ASC, workstations.name ASC"
    );

    echo "
    <form action='actions/update-qualifications.php?q=".$karyawan['npk']."' method='post' class='w-100 h-75 d-block overflow-auto'>
    ";
    echo "<div class='d-block h-100' style='overflow: auto'>";
    while($p = $q_process->fetch_assoc()) {
        echo "<div class='d-flex flex-row align-items-center'>";
        echo "<input type='checkbox'  id='p-".$p['process_id']."' class='edit-process-checkbox' value='".$p['process_id']."'";
        if ($p['qualified'] == 'yes') echo "checked";
        echo ">";
        echo "<label class='process-edit-checkbox-button m-0' for='p-".$p['process_id']."'>";
        echo "<p class='m-0'>".$p['process_name'].' ('.$p['workstation_name'].")</p>";
        echo "</label><br>";
        echo "</div>";
    }
    echo "</div>";
    echo "<input type='text' name='qualifications' id='ap-form-qualification-val' value='' hidden>";
    echo "<div class='hidden'> <input type='submit' name='update' id='q-submit-btn'>CONFIRM</input> </div>";
    echo "
    </form>
    ";
?>
