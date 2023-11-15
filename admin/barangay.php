<?php
include('../connection.php');

$sql="SELECT type, address2,gender_req, COUNT(*) as gender_count 
                        FROM listing 
                        GROUP BY type, gender_req";

if (isset($_POST['select-search'])) {
    $place_search = $_POST['select-search'];
}

if (isset($place_search)) {
    $sql .= " AND address2 = '$place_search'";
}



   $result = $conn->query($sql);
// Initialize variables
$gender_counts = array();

// Fetch the result and store it in a variable
while ($row = $result->fetch_assoc()) {
    $type = $row['type'];
    $gender_req = $row['gender_req'];
    $count = $row['gender_count'];
    if (!isset($gender_counts[$type])) {
        $gender_counts[$type] = array();
    }
    $gender_counts[$type][$gender_req] = $count;
}

if (isset($gender_counts['boarding_house'])) {
    $total_male_boarding_house_count = isset($gender_counts['boarding_house']['Male']) ? $gender_counts['boarding_house']['Male'] : 0;
    $total_female_boarding_house_count = isset($gender_counts['boarding_house']['Female']) ? $gender_counts['boarding_house']['Female'] : 0;
    $total_both_boarding_house_count = isset($gender_counts['boarding_house']['Both']) ? $gender_counts['boarding_house']['Both'] : 0;
} else {
    // Set default values if the variable is not set
    $total_male_boarding_house_count = 0;
    $total_female_boarding_house_count = 0;
    $total_both_boarding_house_count = 0;
}
if (isset($gender_counts['apartment'])) {
    $total_male_apartment_count = isset($gender_counts['apartment']['Male']) ? $gender_counts['apartment']['Male'] : 0;
    $total_female_apartment_count = isset($gender_counts['apartment']['Female']) ? $gender_counts['apartment']['Female'] : 0;
    $total_both_apartment_count = isset($gender_counts['apartment']['Both']) ? $gender_counts['apartment']['Both'] : 0;
}

if (isset($gender_counts['dormitory'])) {
    $total_male_dormitory_count = isset($gender_counts['dormitory']['Male']) ? $gender_counts['dormitory']['Male'] : 0;
    $total_female_dormitory_count = isset($gender_counts['dormitory']['Female']) ? $gender_counts['dormitory']['Female'] : 0;
    $total_both_dormitory_count = isset($gender_counts['dormitory']['Both']) ? $gender_counts['dormitory']['Both'] : 0;
}

if (isset($gender_counts['bedspace'])) {
    $total_male_bedspace_count = isset($gender_counts['bedspace']['Male']) ? $gender_counts['bedspace']['Male'] : 0;
    $total_female_bedspace_count = isset($gender_counts['bedspace']['Female']) ? $gender_counts['bedspace']['Female'] : 0;
    $total_both_bedspace_count = isset($gender_counts['bedspace']['Both']) ? $gender_counts['bedspace']['Both'] : 0;
}
$total_boarding_house_count = isset($gender_counts['boarding_house']) ? array_sum($gender_counts['boarding_house']) : 0;
$total_apartment_count = isset($gender_counts['apartment']) ? array_sum($gender_counts['apartment']) : 0;
$total_dormitory_count = isset($gender_counts['dormitory']) ? array_sum($gender_counts['dormitory']) : 0;
$total_bedspace_count = isset($gender_counts['bedspace']) ? array_sum($gender_counts['bedspace']) : 0;














?>