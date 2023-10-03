<div id="content">
    <div id="page-title" class="flex-title-float-left">
        <?php echo "<p>MP Assessments for ".$current_dept."</p>"?>
        <!-- <p>Overall Assessments</p> -->
    </div>
    <div id="member-list"> 
        <?php
        $q_res = $conn->query("SELECT * FROM karyawan WHERE dept_id = ".$dept_id." ORDER BY name ASC LIMIT ".intval(($page_num-1)*4).",4");
        while ($member = $q_res->fetch_assoc())
        {
            echo
            "<div class='member-container'>".
                "<div class='member-info'>".
                    "<div class='member-info-texts'>".
                        "<p>Name: ".$member['name']."</p>".
                        "<p>NPK: ".$member['id']."</p>".
                        "<p>Workstation: ".$current_dept."</p>".
                    "</div>".
                    "<div class='member-info-photo-container'>".
                        "<img src='img/default-pp.jpg'></img>".
                    "</div>".
                "</div>".
                "<div class='member-stats'>";
            include('includes/components/personal-radarchart.php');
            echo
                "</div>".
            "</div>";
        }
        ?>
    </div>
    <div id="list-nav">
        1 of 2
    </div>
</div>
