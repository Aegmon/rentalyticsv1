<!-- <?php

// include ('connection.php');
// include ('testing1.php');
// Assuming $conn is your database connection object

// $currentMonth = date('m');
// $currentYear = date('Y');

// Calculate the previous two years
// $previousYear1 = $currentYear - 1;
// $previousYear2 = $currentYear - 2;

// $sql1 = "SELECT 
//             CASE 
//                 WHEN MONTH(a.date_of_application) IN (1,2,3,4,5,6) THEN 'First Half' 
//                 ELSE 'Second Half' 
//             END AS semi_annual_period,
//             COUNT(*) AS total,
//             SUM(CASE WHEN a.status = 'approved' THEN 1 ELSE 0 END) AS approved,
//             SUM(CASE WHEN a.status = 'rejected' THEN 1 ELSE 0 END) AS rejected,
//             SUM(CASE WHEN a.status = 'renter' THEN 1 ELSE 0 END) AS renter,
//             l.n_bedroom
//         FROM application a
//         LEFT JOIN tenant t ON a.tenant_id = t.tenant_id
//         LEFT JOIN credentials c ON t.user_id = c.user_id
//         LEFT JOIN listing l ON l.listing_id = a.listing_id
//         LEFT JOIN payment p ON a.application_id = p.application_id
//         WHERE l.listing_id = '23' 
//         AND a.status IN ('approved', 'rejected', 'renter')
//         AND YEAR(a.date_of_application) IN ('$previousYear2', '$previousYear1', '$currentYear')
//         GROUP BY semi_annual_period
//         ORDER BY semi_annual_period";

// Execute the SQL query
// $result1 = mysqli_query($conn, $sql1);

// Check if the query was successful
// if ($result1) {
//     // Fetch each row from the result set
//     while ($row = mysqli_fetch_assoc($result1)) {
//         // Display the results using echo or var_dump
//         echo "Semi-Annual Period: " . $row['semi_annual_period'] . "<br>";
//         echo "Total: " . $row['total'] . "<br>";
//         echo "Approved: " . $row['approved'] . "<br>";
//         echo "Rejected: " . $row['rejected'] . "<br>";
//         echo "Renter: " . $row['renter'] . "<br>";
//         echo "Number of Bedrooms: " . $row['n_bedroom'] . "<br>";
//         echo "------------------------<br>";
//     }
// }
// ?>




 // $sql1 = "SELECT 
//             CASE WHEN MONTH(a.date_of_application) IN (1,2,3,4,5,6) THEN 'First Half' ELSE 'Second Half' END AS semi_annual_period,
//             COUNT(*) AS total,
//             SUM(CASE WHEN a.status = 'approved' THEN 1 ELSE 0 END) AS approved,
//             SUM(CASE WHEN a.status = 'rejected' THEN 1 ELSE 0 END) AS rejected,
//             SUM(CASE WHEN a.status = 'renter' THEN 1 ELSE 0 END) AS renter,
//             l.n_bedroom
//         FROM application a
//         LEFT JOIN tenant t ON a.tenant_id = t.tenant_id
//         LEFT JOIN credentials c ON t.user_id = c.user_id
//         LEFT JOIN listing l ON l.listing_id = a.listing_id
//         LEFT JOIN payment p ON a.application_id = p.application_id
//         WHERE l.listing_id = '$listing_id' 
//         AND a.status IN ('approved', 'rejected', 'renter')
//         GROUP BY semi_annual_period
//         ORDER BY semi_annual_period";

// $result1 = mysqli_query($conn, $sql1);
// // echo '<script>alert("tota:'. $result1. '")</script>';
// // Check if the query was successful
// if ($result1) {
//     // Initialize overall success count to zero
//     $overall_success_count = 0;

//     // Initialize first half success count to zero
//     $first_half_success_count = 0;

//     // Initialize n_bedroom variable
//     $noofbedroom = 0;

//     // Fetch the result as an associative array
//     while ($row1 = mysqli_fetch_assoc($result1)) {
//         // Access the 'approved' column from the result
//         $approved_count = $row1['approved'];

//         // Add the approved count to the overall success count
//         $overall_success_count += $approved_count;
//         // Check if it's the first half and update the first half success coun
//         if ($row1['semi_annual_period'] == 'First Half') {
//           $renter_count = $row1['renter'];
//             $first_half_success_count = $renter_count;
            
//         // Update the n_bedroom variable
//         $noofbedroom = $row1['n_bedroom'];
//     }

//     // Calculate forecast based on the first half success count

//     $previousforecast = (0.8 * $first_half_success_count) + (0.2 * $first_half_success_count);
//        $forecast = (0.8 * $overall_success_count) + (0.2 * $overall_success_count);
//     // Calculate occupancy rate
//     $previousforecast1 =  $previousforecast + $forecast / 2;

//     $previousforecast2 = $previousforecast1 + $forecast /2;

//     $occupancy_rate = ($overall_success_count / $noofbedroom) * 100;


//     $accuracy_rate_prev = ($renter_count / $noofbedroom ) * 100;

//     $rate_now = ( $approved_count / $noofbedroom) * 100;

//     $accuracy_rate_count = $rate_now - $accuracy_rate_prev;


//     $rateText = '';
//     $rateColor ='';
//     if($occupancy_rate > 30){
//       $rateText = '&#8593';
//       $rateColor = 'green';
//     }elseif($occupancy_rate > 30){
//       $rateText = '&#8595';
//       $rateColor = 'red';
//     }
   
// }
//     // Output the results

// }  -->

<?php
session_start();

// Validate and sanitize the phone number (you might need a more robust validation)
$phoneNumber = filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_NUMBER_INT);

// Generate a random 6-digit OTP
$otp = mt_rand(100000, 999999);

// Store the OTP in the session (you may use a database for a more persistent solution)
$_SESSION['otp'] = $otp;

// Here you would typically send the OTP to the user's phone number via SMS
// In this example, we'll just return the OTP as JSON for demonstration purposes
echo json_encode(['success' => true, 'otp' => $otp]);
?>