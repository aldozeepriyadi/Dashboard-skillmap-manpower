<?php
function member_preview_button($member){
    $img_path = "img/profile_pictures/".$member['npk'].".jpg";
    if(!file_exists($img_path)) $img_path = "img/profile_pictures/default.jpg";
    echo
    "<div class='d-inline-block'>
        <div class='member-container mr-3'>
            <a href='preview_member.php?q=".$member['npk']."'>
                <div class='member-info'>
                    <div class='member-info-texts'>
                        <div class='d-flex-row'>
                            <span class='w-25'>
                                <p>Name</p>
                            </span>
                            <span class='w-75'>
                                <p>: ".$member['name']."</p>
                            </span>
                        </div>
                        <div class='d-flex-row'>
                            <span class='w-25'>
                                <p>NPK</p>
                            </span>
                            <span class='w-75'>
                                <p>: ".$member['npk']."</p>
                            </span>
                        </div>
                    </div>
                    <div class='member-info-photo-container'>
                        <img src='".$img_path."'></img>
                    </div>
                </div>
            </a>
            <div class='member-stats'>";
                include('includes/components/personal-radarchart.php');
            echo
            "</div>
        </div>
    </div>";
}
?>