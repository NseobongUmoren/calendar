<?php
$days_of_the_week = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
$months_of_the_year = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
$start = 2000;
$current_year = isset($_GET['year']) ? $_GET['year'] : date("Y");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="calendar.php" method="get">
    <select name="year" id="year">
      <option value="">Select Year</option>
      <?php
      foreach (range(date("Y"), $start) as $year) {
        echo "<option value='$year'>$year</option>";
      }
      ?>
    </select>
    <button type="submit">Search</button>
    <table>
      <h1><?= $current_year; ?></h1>
      <?php
      foreach ($months_of_the_year as $month) {
        echo "<tr><th colspan=7>$month</th></tr>";
        echo "<tr>";
        foreach ($days_of_the_week as $day) {
          echo "<th>$day</th>";
        }
        echo "</tr>";
        $d_month = date("m", strtotime($month));
        $start_from = date('w', strtotime(($current_year . '-' . $d_month . '-1')));
        $num_days = cal_days_in_month(CAL_GREGORIAN, date($d_month), date($current_year));
        echo "<tr>";
        for ($i = 1; $i <= $num_days + $start_from; $i++) {
          if ($i > $start_from) {
            echo "<td id = 'dates'>" . ($i - $start_from) . "</td>";
          } else {
            echo "<td></td>";
          }
          if ($i % 7 == 0) {
            echo "</tr><tr>";
          }
        }
        echo "</tr>";
      }
      ?>
    </table>
  </form>
</body>

</html>