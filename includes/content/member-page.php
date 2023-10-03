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
                "<a href='preview_member.php?q=".$member['id']."'>".
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
                "</a>".
                "<div class='member-stats'>";
            include('includes/components/personal-radarchart.php');
            echo
                "</div>".
            "</div>";
        }
        ?>
    </div>
    <div id="list-nav">
        <?php
        $q_res = $conn->query("SELECT * FROM karyawan WHERE dept_id = ".$dept_id);
        $num_results = $q_res->num_rows;
        $total_pages = ceil($num_results/4);

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        if ($page_num != 1) {
            echo "<a href='$current_url[0]?q=$dept_id&p=".($page_num-1)."'><img src='img/arrow-left-solid.svg' class='move-member-page-icon'></img></a>";
        }
        echo "<p>Page ".$page_num." of ".$total_pages."</p>";
        if ($page_num != $total_pages) {
            echo "<a href='$current_url[0]?q=$dept_id&p=".($page_num+1)."'><img src='img/arrow-right-solid.svg' class='move-member-page-icon'></img></a>";
        }
        ?>
    </div>
</div>
