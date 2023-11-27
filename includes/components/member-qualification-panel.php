<div class='d-flex justify-content-center w-100' style='height: 22.5%'>
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
                    WHERE karyawan.npk = '".$karyawan['npk']."' AND qualifications.value >= process.min_skill
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