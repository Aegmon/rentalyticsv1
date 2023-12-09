    <?php
    include ('connection.php');
    $listing_id = $_GET['listing_id'];
    // Fetch data for the first half of each year
    // Initialize variables to store counts
    // for ($year = 2020; $year <= 2023; $year++) {
    //     // Initialize variables to store counts for each year
    //     $total_approved_count_first_half = 0;
    //     $total_rejected_count_first_half = 0;
    //     $total_renter_count_first_half = 0;

    //     $query_first_half = "SELECT * FROM application WHERE YEAR(date_of_application) = $year AND MONTH(date_of_application) BETWEEN 1 AND 6";
    //     $result_first_half = mysqli_query($conn, $query_first_half);

    //     // Process data for the first half of the year
    //     echo "Results for the first half of $year:<br><br>";

    //     while ($row_first_half = mysqli_fetch_assoc($result_first_half)) {
    //         // Process data for the first half of the year
    //         // echo "Data: " . print_r($row_first_half, true) . "<br>";

    //         // Update counts based on approved, rejected, and renter status
    //         $total_approved_count_first_half += ($row_first_half['status'] == 'approved') ? 1 : 0;
    //         $total_rejected_count_first_half += ($row_first_half['status'] == 'rejected') ? 1 : 0;
    //         $total_renter_count_first_half += ($row_first_half['status'] == 'renter') ? 1 : 0;
    //     }

    //     // Display total counts for the first half of the year
    //     echo "Total Approved Count: $total_approved_count_first_half<br>";
    //     echo "Total Rejected Count: $total_rejected_count_first_half<br>";
    //     echo "Total Renter Count: $total_renter_count_first_half<br><br>";
    // }
    // // Initialize variables to store counts for the second half


    // // Fetch data for the second half of each year
    // for ($year = 2020; $year <= 2023; $year++) {

    //     $total_approved_count_second_half = 0;
    //     $total_rejected_count_second_half = 0;
    //     $total_renter_count_second_half = 0;

    //     $query_second_half = "SELECT * FROM application WHERE YEAR(date_of_application) = $year AND MONTH(date_of_application) BETWEEN 7 AND 12";
    //     $result_second_half = mysqli_query($conn, $query_second_half);

    //     // Process data for the second half of the year
    //     echo "Results for the second half of $year:<br><br>";

    //     while ($row_second_half = mysqli_fetch_assoc($result_second_half)) {
    //         // Process data for the second half of the year
    //         // echo "Data: " . print_r($row_second_half, true) . "<br>";

    //         // Update counts based on approved and renter status
    //         $total_approved_count_second_half += ($row_second_half['status'] == 'approved') ? 1 : 0;
    //         $total_rejected_count_second_half += ($row_second_half['status'] == 'rejected') ? 1 : 0;
    //         $total_renter_count_second_half += ($row_second_half['status'] == 'renter') ? 1 : 0;
    //     }

    //     // Display total counts for the second half of the year
    //     echo "Total Approved Count: $total_approved_count_second_half<br>";
    //     echo "Total Rejected Count: $total_rejected_count_second_half<br>";
    //     echo "Total Renter Count: $total_renter_count_second_half<br><br>";
    // }


    // Connect to your database (assuming you have $conn already)
    // ...

    // HTML Output
    ?>

    <?php



    for ($year = 2020; $year <= 2023; $year++) {
    
    // Initialize variables to store counts for the first half of the year
    $total_approved_count_first_half = 0;
    $total_rejected_count_first_half = 0;
    $total_renter_count_first_half = 0;
    if($year == "2020"){
    $query_first_half = "SELECT * FROM application WHERE YEAR(date_of_application) = $year AND MONTH(date_of_application) BETWEEN 1 AND 6 and lisitng_id = $listing_id";
    $result_first_half = mysqli_query($conn, $query_first_half);
    
    echo "Results for the first half of $year:<br><br>";
    
    while ($row_first_half = mysqli_fetch_assoc($result_first_half)) {
        // Update counts based on approved, rejected, and renter status for the first half
        $total_approved_count_first_half += ($row_first_half['status'] == 'approved') ? 1 : 0;
        $total_rejected_count_first_half += ($row_first_half['status'] == 'rejected') ? 1 : 0;
        $total_renter_count_first_half += ($row_first_half['status'] == 'renter') ? 1 : 0;
        
        $total_renter_2020f = $total_renter_count_first_half;
    }
    }
    elseif($year =="2021"){
    $query_first_half = "SELECT * FROM application WHERE YEAR(date_of_application) = $year AND MONTH(date_of_application) BETWEEN 1 AND 6";
    $result_first_half = mysqli_query($conn, $query_first_half);
    
    echo "Results for the first half of $year:<br><br>";
    
    while ($row_first_half = mysqli_fetch_assoc($result_first_half)) {
        // Update counts based on approved, rejected, and renter status for the first half
        $total_approved_count_first_half += ($row_first_half['status'] == 'approved') ? 1 : 0;
        $total_rejected_count_first_half += ($row_first_half['status'] == 'rejected') ? 1 : 0;
        $total_renter_count_first_half += ($row_first_half['status'] == 'renter') ? 1 : 0;

        $total_renter_2021f = $total_renter_count_first_half;
    }
    }elseif($year =="2022"){
    $query_first_half = "SELECT * FROM application WHERE YEAR(date_of_application) = $year AND MONTH(date_of_application) BETWEEN 1 AND 6";
    $result_first_half = mysqli_query($conn, $query_first_half);
    
    echo "Results for the first half of $year:<br><br>";
    
    while ($row_first_half = mysqli_fetch_assoc($result_first_half)) {
        // Update counts based on approved, rejected, and renter status for the first half
        $total_approved_count_first_half += ($row_first_half['status'] == 'approved') ? 1 : 0;
        $total_rejected_count_first_half += ($row_first_half['status'] == 'rejected') ? 1 : 0;
        $total_renter_count_first_half += ($row_first_half['status'] == 'renter') ? 1 : 0;

        $total_renter_2022f =  $total_renter_count_first_half;
    }
    
    }elseif($year == "2023"){
    $query_first_half = "SELECT * FROM application WHERE YEAR(date_of_application) = $year AND MONTH(date_of_application) BETWEEN 1 AND 6";
    $result_first_half = mysqli_query($conn, $query_first_half);
    
    echo "Results for the first half of $year:<br><br>";
    
    while ($row_first_half = mysqli_fetch_assoc($result_first_half)) {
        // Update counts based on approved, rejected, and renter status for the first half
        $total_approved_count_first_half += ($row_first_half['status'] == 'approved') ? 1 : 0;
        $total_rejected_count_first_half += ($row_first_half['status'] == 'rejected') ? 1 : 0;
        $total_renter_count_first_half += ($row_first_half['status'] == 'renter') ? 1 : 0;

        $total_approved_2023f =$total_renter_count_first_half;
    }
   
    
    }
    echo "Total Approved Count (First Half): $total_approved_count_first_half<br>";
    echo "Total Rejected Count (First Half): $total_rejected_count_first_half<br>";
    echo "Total Renter Count (First Half): $total_renter_count_first_half<br><br>";
    // Fetch data for the first half of the year
    // $query_first_half = "SELECT * FROM application WHERE YEAR(date_of_application) = $year AND MONTH(date_of_application) BETWEEN 1 AND 6";
    // $result_first_half = mysqli_query($conn, $query_first_half);
    
    // Process data for the first half of the year
    
    
    
    // Display total counts for the first half of the year
    
    
    // Initialize variables to store counts for the second half of the year
    $total_approved_count_second_half = 0;
    $total_rejected_count_second_half = 0;
    $total_renter_count_second_half = 0;
    
    if($year == "2020"){
    $query_second_half = "SELECT * FROM application WHERE YEAR(date_of_application) = $year AND MONTH(date_of_application) BETWEEN 7 AND 12";
    $result_second_half = mysqli_query($conn, $query_second_half);
    
    // Process data for the second half of the year
    // echo "Results for the second half of $year:<br><br>";
    
    while ($row_second_half = mysqli_fetch_assoc($result_second_half)) {
        // Update counts based on approved, rejected, and renter status for the second half
        $total_approved_count_second_half += ($row_second_half['status'] == 'approved') ? 1 : 0;
        $total_rejected_count_second_half += ($row_second_half['status'] == 'rejected') ? 1 : 0;
        $total_renter_count_second_half += ($row_second_half['status'] == 'renter') ? 1 : 0;

        $total_renter_2020s =  $total_renter_count_second_half; 
    }
    }elseif($year =="2021"){
    $query_second_half = "SELECT * FROM application WHERE YEAR(date_of_application) = $year AND MONTH(date_of_application) BETWEEN 7 AND 12";
    $result_second_half = mysqli_query($conn, $query_second_half);
    
    // Process data for the second half of the year
    // echo "Results for the second half of $year:<br><br>";
    
    while ($row_second_half = mysqli_fetch_assoc($result_second_half)) {
        // Update counts based on approved, rejected, and renter status for the second half
        $total_approved_count_second_half += ($row_second_half['status'] == 'approved') ? 1 : 0;
        $total_rejected_count_second_half += ($row_second_half['status'] == 'rejected') ? 1 : 0;
        $total_renter_count_second_half += ($row_second_half['status'] == 'renter') ? 1 : 0;

        $total_renter_2021s =  $total_renter_count_second_half;
    }
    }elseif($year == "2022"){
    $query_second_half = "SELECT * FROM application WHERE YEAR(date_of_application) = $year AND MONTH(date_of_application) BETWEEN 7 AND 12";
    $result_second_half = mysqli_query($conn, $query_second_half);
    
    // Process data for the second half of the year
    // echo "Results for the second half of $year:<br><br>";
    
    while ($row_second_half = mysqli_fetch_assoc($result_second_half)) {
        // Update counts based on approved, rejected, and renter status for the second half
        $total_approved_count_second_half += ($row_second_half['status'] == 'approved') ? 1 : 0;
        $total_rejected_count_second_half += ($row_second_half['status'] == 'rejected') ? 1 : 0;
        $total_renter_count_second_half += ($row_second_half['status'] == 'renter') ? 1 : 0;

        $total_renter_2022s =  $total_renter_count_second_half ;
    } 
    }elseif($year == "2023"){
    $query_second_half = "SELECT * FROM application WHERE YEAR(date_of_application) = $year AND MONTH(date_of_application) BETWEEN 7 AND 12";
    $result_second_half = mysqli_query($conn, $query_second_half);
    
    // Process data for the second half of the year
    // echo "Results for the second half of $year:<br><br>";
    
    while ($row_second_half = mysqli_fetch_assoc($result_second_half)) {
        // Update counts based on approved, rejected, and renter status for the second half
        $total_approved_count_second_half += ($row_second_half['status'] == 'approved') ? 1 : 0;
        $total_rejected_count_second_half += ($row_second_half['status'] == 'rejected') ? 1 : 0;
        $total_renter_count_second_half += ($row_second_half['status'] == 'renter') ? 1 : 0;

        $total_approved_2023s = $total_renter_count_second_half;
    }
    }
    // Fetch data for the second half of the year
    
    
    // Display total counts for the second half of the year
    echo "Total Approved Count (Second Half): $total_approved_count_second_half<br>";
    echo "Total Rejected Count (Second Half): $total_rejected_count_second_half<br>";
    echo "Total Renter Count (Second Half): $total_renter_count_second_half<br><br>";
    
    echo "<hr>"; // Add a horizontal line to separate each year's results
    
   


    }
   
    $sql1 = "SELECT 
CASE WHEN MONTH(a.date_of_application) IN (1,2,3,4,5,6) THEN 'First Half' ELSE 'Second Half' END AS semi_annual_period,
COUNT(*) AS total,
SUM(CASE WHEN a.status = 'approved' THEN 1 ELSE 0 END) AS approved,
SUM(CASE WHEN a.status = 'rejected' THEN 1 ELSE 0 END) AS rejected,
SUM(CASE WHEN a.status = 'renter' THEN 1 ELSE 0 END) AS renter,
l.n_bedroom
FROM application a
LEFT JOIN tenant t ON a.tenant_id = t.tenant_id
LEFT JOIN credentials c ON t.user_id = c.user_id
LEFT JOIN listing l ON l.listing_id = a.listing_id
LEFT JOIN payment p ON a.application_id = p.application_id
WHERE l.listing_id = '23' 
AND a.status IN ('approved', 'rejected', 'renter')
GROUP BY semi_annual_period
ORDER BY semi_annual_period";

$result1 = mysqli_query($conn, $sql1);
if ($result1) {

    // Initialize n_bedroom variable
    $noofbedroom = 0;

    // Fetch the result as an associative array
    while ($row1 = mysqli_fetch_assoc($result1)) {

        $noofbedroom = $row1['n_bedroom'];
    }

    // Calculate forecast based on the first half success count

    $rate_2020f = ($total_renter_2020f / $noofbedroom) * 100;
    $rate_2020s = ($total_renter_2020s/ $noofbedroom ) * 100;


    $rate_2021f = ($total_renter_2021f / $noofbedroom) * 100;
    $rate_2021s = ($total_renter_2021s / $noofbedroom) * 100;

    $rate_2022f = ($total_renter_2022f / $noofbedroom) * 100;
    $rate_2022s = ($total_renter_2022s / $noofbedroom) * 100;

    $rate_2023f = ($total_approved_2023f / $noofbedroom) * 100;
    $rate_2023s = ($total_approved_2023s / $noofbedroom) * 100;

    $rate_2024f = ($rate_2023f + $rate_2023s) / 2;
    // forecasts
    // first half of 2022
    $forecastRate2022 = (0.2 *  $rate_2021f ) + (0.8 * $rate_2021s ); 
    // second half of 2022
    $forecastRate2022s = (0.2 * $rate_2021s ) + (0.8 *  $rate_2022f ); 

    // first half 2023
    $forecastRate2023 = (0.2 *  $rate_2022f ) + (0.8 *  $rate_2022s );
    // second half of 2023
    $forecastRate2023s = (0.2 *   $rate_2022s ) + (0.8 * $rate_2023f );

    $forecastRate2024 = (0.2 * $rate_2023f ) + (0.8 * $rate_2023s );

}
    // Output the results

   
    ?>
    <div>
        <p><?php echo "Forecast Occupancy Rate of 2022 first half: ".number_format($forecastRate2022,2) ?></p>
        <p><?php echo "Forecast Occupancy Rate of 2022 second half: ".number_format($forecastRate2022s,2) ?></p>
        <p><?php echo "Forecast Occupancy Rate of 2023 first half: ".number_format($forecastRate2023,2) ?></p>
        <p><?php echo "Forecast Occupancy Rate of 2023 second half: ".number_format( $forecastRate2023s ,2) ?></p>
        <p><?php echo "Forecast Occupancy Rate of 2024: ".number_format($forecastRate2024,2) ?></p>
        <p><?php echo "2020" ?></p>
        <p><?php echo "First Half" . '<br>' .$total_renter_2020f?></p>
        <p><?php echo "Ocupancy Rate:" . " " .$rate_2020f?></p>
        <p><?php echo  "Second Half" .'<br>' .  $total_renter_2020s ?></p>
        <p><?php echo "Ocupancy Rate:" . " " .$rate_2020s . '<br>' . '<hr>'?></p>


        <p><?php echo "2021"?></p>
        <p><?php echo "First Half" . '<br>' .$total_renter_2021f?></p>
        <p><?php echo "Ocupancy Rate:" . " " .number_format($rate_2021f,2)?></p>
        <p><?php echo  "Second Half" .'<br>' .  $total_renter_2021s ?></p>
        <p><?php echo "Ocupancy Rate:" . " " .number_format($rate_2021s,2).'<br>' . '<hr>'?></p>


        <p><?php echo "2022"?></p>
        <p><?php echo "First Half" . '<br>' .$total_renter_2022f?></p>
        <p><?php echo "Ocupancy Rate:" . " " .number_format($rate_2022f,2)?></p>
        <p><?php echo  "Second Half" .'<br>' .  $total_renter_2022s?></p>
        <p><?php echo "Ocupancy Rate:" . " " .number_format($rate_2022s,2).'<br>' . '<hr>'?></p>

        <p><?php echo "2023"?></p>
        <p><?php echo "First Half" . '<br>' .$total_approved_2023f?></p>
        <p><?php echo "Ocupancy Rate:" . " " .number_format($rate_2023f,2)?></p>
        <p><?php echo  "Second Half" .'<br>' .  $total_approved_2023s ?></p>
        <p><?php echo "Ocupancy Rate:" . " " .number_format($rate_2023s,2).'<br>' . '<hr>'?></p>

        <p><?php echo  "Bed Count" . $noofbedroom ?></p>
    </div>

    <div id="areaChartBasic1">
    </div>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
    var options = {
        series: [{
            name: "Forecast Occcupancy Rate",
            data: [
                <?php echo  number_format($forecastRate2022,2)?>,
                <?php echo  number_format($forecastRate2022s,2)?>,
                <?php echo  number_format($forecastRate2023,2)?>, 
                <?php echo number_format($forecastRate2023s,2)?>,
                <?php echo number_format($forecastRate2024,2)?>],

            color: '#7071E8'
        },
    {
      name: 'Actual Occupancy Rate',
      data: [
        <?php echo  number_format($rate_2022f,2)?>,
        <?php echo  number_format($rate_2022s,2)?>,
        <?php echo  number_format($rate_2023f,2)?>,
        <?php echo  number_format($rate_2023s,2)?>,
        null],
      color: '#E7BCDE' // Custom color for Line 2
    }],
        chart: {
            type: 'area',
            height: 350,
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth', // Changed to 'smooth' for a smoother curve
        },
        title: {
            text: 'Forecast Occupancy Rate ',
            align: 'left'
        },

        labels: [
           "Jan - Jun 2022","july - Dec 2022", "jan - jun 2023", "Jul - Dec 2023","Jan - Jun 2024"],
        xaxis: {
            type: 'category', // Changed to 'category' since your labels are not timestamps
        },
        yaxis: {
          opposite: true,
        labels: {
            formatter: function (val) {
                return val + '%'; // Add '%' to each label
            }
        },
        min: 0,
        max:100
        },
        legend: {
            horizontalAlign: 'center'
        }
    };

    // Ensure the container with ID "areaChartBasic1" exists
    var chartContainer = document.querySelector("#areaChartBasic1");

    if (chartContainer) {
        var chart = new ApexCharts(chartContainer, options);
        chart.render();
    } else {
        console.error("Chart container not found.");
    }
</script>