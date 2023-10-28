<?php
include('../connection.php');
session_start();
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Make a database query to fetch the client's information
    $sql_credentials = "SELECT * FROM credentials WHERE user_id = $user_id";
    $result_credentials = mysqli_query($conn, $sql_credentials);

    if($row_credentials = mysqli_fetch_assoc($result_credentials)) {
        $user_type = $row_credentials['user_type'];
        if($user_type === 'tenant') {
            $sql_tenant = "SELECT * FROM tenant WHERE user_id = $user_id";
            $result_tenant = mysqli_query($conn, $sql_tenant);

            if($row_tenant = mysqli_fetch_assoc($result_tenant)) {
                // Fetch all data from the tenant table and put it into variables
                $name = $row_tenant['name'];
                $birthdate = $row_tenant['birthdate'];
                $gender = $row_tenant['gender'];
                   $id = $row_tenant['tenant_id'];
                // ... (fetch other data as needed)
            }
        } elseif($user_type === 'owner') {
            $sql_owner = "SELECT * FROM owner WHERE user_id = $user_id";
            $result_owner = mysqli_query($conn, $sql_owner);

            if($row_owner = mysqli_fetch_assoc($result_owner)) {
                // Fetch all data from the owner table and put it into variables
                $name = $row_owner['name'];
                $birthdate = $row_owner['birthdate'];
                $gender = $row_owner['gender'];
                    $id = $row_owner['owner_id'];
              $sql = "SELECT l.owner_id, COUNT(DISTINCT l.listing_id) AS listing_count, COUNT(a.application_id) AS rent_count
        FROM listing l
        LEFT JOIN application a ON l.listing_id = a.listing_id
      Where l.owner_id = $id   GROUP BY l.owner_id ";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $rent_count = $row['rent_count'];
        $listing_count = $row["listing_count"];
    }
} else {
   $rent_count = 0;
   $listing_count = 0;
}

            }
        }
    }
} else {
    header("Location: ../index.php");
    exit;
}
?>
