<?php

require __DIR__ . '/../src/WeekPeriodInterface.php';
require __DIR__ . '/../src/ValueWeekPeriod.php';
require __DIR__ . '/../src/PredictWeekPeriod.php';

function createAverage(WeekPeriodInterface $visit, WeekPeriodInterface $activite) {
    $results = new \SplFixedArray(7);

    foreach ($visit AS $day => $value) {
        $results[($day - 1)] = $activite->getDay($day) / $value;
    }

    return new ValueWeekPeriod($results[0], $results[1], $results[2], $results[3], $results[4], $results[5], $results[6]);
}

$service = new PredictWeekPeriod();

// activite
$activity_3 = new ValueWeekPeriod(28, 43, 70, 25, 12, 2, 1);
$activity_2 = new ValueWeekPeriod(24, 40, 60, 50, 6, 10, 0);
$activity_1 = new ValueWeekPeriod(42, 23, 60, 30, 4, 20, 5);
$activity_0 = $service->predict($activity_3, $activity_2, $activity_1);

// visit
$visit_3 = new ValueWeekPeriod(360, 490, 800, 300, 210, 100, 20);
$visit_2 = new ValueWeekPeriod(350, 530, 900, 200, 200, 150, 22);
$visit_1 = new ValueWeekPeriod(300, 520, 950, 120, 240, 200, 50);
$visit_0 = $service->predict($visit_3, $visit_2, $visit_1);

// average
$average_3 = createAverage($visit_3, $activity_3);
$average_2 = createAverage($visit_2, $activity_2);
$average_1 = createAverage($visit_1, $activity_1);
$average_0 = $service->predict($average_3, $average_2, $average_1);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Test predict</title>
    <meta charset="utf-8" />
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 </head>
 <body>
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(function() {
            var data = new google.visualization.DataTable();

            data.addColumn('string', 'Day');
            data.addColumn('number', 'Activity');
            data.addColumn('number', 'Activity predict');
            data.addColumn('number', 'Average activity per visit');
            data.addColumn('number', 'Average activity per visit predit');
            data.addRows(28);

            var day = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
            for (var i = 0; i <= 27; ++i) {
                data.setValue(i, 0, day[i % 7]);
            }
<?php

foreach ($activity_3 as $day => $value) {
    echo 'data.setValue(',($day - 1),', 1, ',$value,');',"\n";
}
foreach ($activity_2 as $day => $value) {
    echo 'data.setValue(',($day + 6),', 1, ',$value,');',"\n";
}
foreach ($activity_1 as $day => $value) {
    echo 'data.setValue(',($day + 13),', 1, ',$value,');',"\n";
}

echo 'data.setValue(20, 2, ',$value,');',"\n";
foreach ($activity_0 as $day => $value) {
    echo 'data.setValue(',($day + 20),', 2, ',$value,');',"\n";
}

foreach ($average_3 as $day => $value) {
    echo 'data.setValue(',($day - 1),', 3, ',round($value * 100,2),');',"\n";
}
foreach ($average_2 as $day => $value) {
    echo 'data.setValue(',($day + 6),', 3, ',round($value * 100,2),');',"\n";
}
foreach ($average_1 as $day => $value) {
    echo 'data.setValue(',($day + 13),', 3, ',round($value * 100,2),');',"\n";
}

echo 'data.setValue(20, 4, ',round($value * 100,2),');',"\n";
foreach ($average_0 as $day => $value ) {
    echo 'data.setValue(',($day + 20),', 4, ',round($value * 100,2),');',"\n";
}

?>
            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, {width: 1180, height: 300, title: 'Activity rate'});
        });
    </script>
    <div id="chart_div"></div>
</body>
</html>
