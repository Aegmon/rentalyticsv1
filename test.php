<?php

include ('connection.php');

$sql = "SELECT 
            MONTH(a.date_of_application) AS month,
            COUNT(*) AS total,
            SUM(CASE WHEN a.status = 'approved' THEN 1 ELSE 0 END) AS approved,
            SUM(CASE WHEN a.status = 'rejected' THEN 1 ELSE 0 END) AS rejected,
            SUM(CASE WHEN a.status = 'renter' THEN 1 ELSE 0 END) AS renter
        FROM application a
        LEFT JOIN tenant t ON a.tenant_id = t.tenant_id
        LEFT JOIN credentials c ON t.user_id = c.user_id
        LEFT JOIN listing l ON l.listing_id = a.listing_id
        LEFT JOIN payment p ON a.application_id = p.application_id
        WHERE l.owner_id = '8' AND a.status IN ('approved', 'rejected', 'renter')
        GROUP BY month
        ORDER BY month";

// Execute the SQL query
$result = mysqli_query($your_db_connection, $sql);

// Fetch the result and format it for JavaScript
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Convert the PHP array to a JSON string
$jsonData = json_encode($data);
?>
<?php echo $jsonData?>


