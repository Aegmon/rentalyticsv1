<?php

include ('connection.php');

$sql = "SELECT address2, type, COUNT(*) as type_count 
        FROM listing 
        GROUP BY address2, type";

$result = $conn->query($sql);

// Initialize variables
$address_counts = array();

// Fetch the result and store it in a variable
while ($row = $result->fetch_assoc()) {
    $address2 = $row['address2'];
    $type = $row['type'];
    $count = $row['type_count'];

    if (!isset($address_counts[$address2])) {
        $address_counts[$address2] = array();
    }

    $address_counts[$address2][$type] = $count;
}

// Display the stored data
echo '<pre>';
print_r($address_counts);
echo '</pre>';

// Convert all counts to integers
foreach ($address_counts as &$addressData) {
    $addressData = array_map('intval', $addressData);
}

// Now, you can use the 'type' values as keys for the inner arrays when generating the chart data.
$series = array();
foreach ($address_counts as $address => $addressData) {
    // Use $address as the name for the series
    $data = array();
    foreach ($addressData as $type => $count) {
        $data[] = $count;
    }
    $series[] = array(
        'name' => $address,
        'data' => $data,
    );
}

// Display the chart data
echo '<pre>';
print_r($series);
echo '</pre>';

// Chart options
$options = array(
    'series' => $series,
    'chart' => array(
        'type' => 'bar',
        'height' => 350,
        'stacked' => true,
        'toolbar' => array(
            'show' => true
        ),
        'zoom' => array(
            'enabled' => true
        )
    ),
    'responsive' => array(
        array(
            'breakpoint' => 480,
            'options' => array(
                'legend' => array(
                    'position' => 'bottom',
                    'offsetX' => -10,
                    'offsetY' => 0
                )
            )
        )
    ),
    'plotOptions' => array(
        'bar' => array(
            'horizontal' => false,
            'borderRadius' => 10,
            'dataLabels' => array(
                'total' => array(
                    'enabled' => true,
                    'style' => array(
                        'fontSize' => '13px',
                        'fontWeight' => 900
                    )
                )
            )
        ),
    ),
  'xaxis' => array(
    'categories' => array_keys($address_counts), // Use array_keys directly without reset
),
    'legend' => array(
        'position' => 'right',
        'offsetY' => 40
    ),
    'fill' => array(
        'opacity' => 1
    )
);

// Render the chart
?>

<script>
        var options = <?php echo json_encode($options); ?>;
        var chart = new ApexCharts(document.querySelector("#chartbar"), options);
        chart.render();
    </script>


