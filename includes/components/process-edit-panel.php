<?php
    $q_process = $conn->query(
        "SELECT
            process.id as process_id,
            process.name as process_name,
            IF(
                process.id IN 
                    (SELECT qualifications.process_id FROM qualifications WHERE qualifications.npk = '".$karyawan['npk']."')
                , 'yes', 'no'
            ) as qualified
        FROM process
        LEFT JOIN workstations ON workstations.id = process.workstation_id
        LEFT JOIN karyawan_workstation ON karyawan_workstation.workstation_id = workstations.id
        WHERE karyawan_workstation.npk = '".$karyawan['npk']."' AND process.name != ''"
    );

    echo "
    <form action='' class='w-100 d-block overflow-auto'>
    ";
    while($p = $q_process->fetch_assoc()) {
        echo "<div class='d-flex flex-row align-items-center'>";
        echo "<input type='checkbox'  id='p-".$p['process_id']."' name='edit-process-checkbox' value='".$p['process_id']."'";
        if ($p['qualified'] == 'yes') echo "checked";
        echo ">";
        echo "<label class='process-edit-checkbox-button m-0' for='p-".$p['process_id']."'>";
        echo "<p class='m-0'>".$p['process_name']."</p>";
        echo "</label><br>";
        echo "</div>";
    }
    echo "
    </form>
    ";
?>
