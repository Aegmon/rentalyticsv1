<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/error.log'); // Specify the path to your error log file

header('Content-Type: application/json');

try {
    if (isset($_GET['barangay'])) {
        $selectedBarangay = $_GET['barangay'];

    $result = $conn->query("SELECT type, gender_req, COUNT(*) as gender_count 
                            FROM listing 
                            WHERE barangay = '$selectedBarangay'
                            GROUP BY type, gender_req");

    $gender_counts = array();

    while ($row = $result->fetch_assoc()) {
        $type = $row['type'];
        $gender_req = $row['gender_req'];
        $count = $row['gender_count'];

        if (!isset($gender_counts[$type])) {
            $gender_counts[$type] = array(
                'Male' => 0,
                'Female' => 0,
                'Both' => 0,
            );
        }

        $gender_counts[$type][$gender_req] = $count;
    }

    $response = array(
        'total_male_apartment_count' => isset($gender_counts['apartment']['Male']) ? $gender_counts['apartment']['Male'] : 0,
        'total_female_apartment_count' => isset($gender_counts['apartment']['Female']) ? $gender_counts['apartment']['Female'] : 0,
        'total_both_apartment_count' => isset($gender_counts['apartment']['Both']) ? $gender_counts['apartment']['Both'] : 0,
        'total_male_dormitory_count' => isset($gender_counts['dormitory']['Male']) ? $gender_counts['dormitory']['Male'] : 0,
        'total_female_dormitory_count' => isset($gender_counts['dormitory']['Female']) ? $gender_counts['dormitory']['Female'] : 0,
        'total_both_dormitory_count' => isset($gender_counts['dormitory']['Both']) ? $gender_counts['dormitory']['Both'] : 0,
        'total_male_bedspace_count' => isset($gender_counts['bedspace']['Male']) ? $gender_counts['bedspace']['Male'] : 0,
        'total_female_bedspace_count' => isset($gender_counts['bedspace']['Female']) ? $gender_counts['bedspace']['Female'] : 0,
        'total_both_bedspace_count' => isset($gender_counts['bedspace']['Both']) ? $gender_counts['bedspace']['Both'] : 0,
        'total_male_boarding_house_count' => isset($gender_counts['boarding_house']['Male']) ? $gender_counts['boarding_house']['Male'] : 0,
        'total_female_boarding_house_count' => isset($gender_counts['boarding_house']['Female']) ? $gender_counts['boarding_house']['Female'] : 0,
        'total_both_boarding_house_count' => isset($gender_counts['boarding_house']['Both']) ? $gender_counts['boarding_house']['Both'] : 0,
    );

     echo json_encode($response);
    } else {
        throw new Exception('Barangay parameter not provided.');
    }
} catch (Exception $e) {
    $errorResponse = ['error' => $e->getMessage()];
    echo json_encode($errorResponse);
}
?>