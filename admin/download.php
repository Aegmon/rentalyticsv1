<?php include('../connection.php')?>
<?php

if (isset($_GET['file_id'])) {
    // Retrieve the file information from the database
    $file_id = $_GET['file_id'];
    $stmt = $conn->prepare("SELECT * FROM listing WHERE listing_id = ?");
    $stmt->bind_param("i", $file_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $file = $result->fetch_assoc();
        // Send the file headers
        header("Content-type: " . $file['mime']);
        header("Content-disposition: attachment; filename=" . $file['name']);
        echo $file['data'];
        exit;
    } else {
        echo "File not found.";
    }
    $stmt->close();
} else {
    echo "Invalid request.";
}
?>