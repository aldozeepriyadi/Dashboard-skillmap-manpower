<?php
include('includes/a_config.php');
if (!in_array($member['role'], $roles_with_kao)) $labels = "['MSK', 'KT', 'PSSP', 'PNG', '5JQ']";
else $labels = "['MSK', 'KT', 'PSSP', 'PNG', '5JQ', 'KAO']";

$data = "[".$member['msk'].",".
            $member['kt'].",".
            $member['pssp'].",".
            $member['png'].",".
            $member['fivejq'].",";
if (in_array($member['role'], $roles_with_kao)) $data .= $member['kao'];
$data .= ']';

$chart_id = "radar_".$member['npk'];
echo "
<div>
    <canvas id=".$chart_id."></canvas>
</div>
<script>
    ctx_".$chart_id." = document.getElementById('".$chart_id."');
    var style = getComputedStyle(document.body);
    var primCol = style.getPropertyValue('--secondary-color');
    var lightCol = style.getPropertyValue('--main-color');
    new Chart(ctx_".$chart_id.", {
        type: 'radar',
        data: {
        labels: ".$labels.",
        datasets: [{
            label: 'score',
            data: ".$data.",
            borderWidth: 3
        }]
        },
        options: {
            scales: {
                r: {
                    grid: {
                        color: lightCol
                    },
                    angleLines: {
                        color: 'rgba(255,255,255,0)',

                    },
                    ticks: {
                        stepSize: 1,
                        backdropColor: primCol,
                        color: lightCol
                    },
                    pointLabels: {
                        color: lightCol
                    },
                    min: 0,
                    max: 5
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>";
?>
