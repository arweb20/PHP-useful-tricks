<?php
// Test data.
/*$array = array(array('id' => 'MGH01KL', 'brand' => 'ABC', 'model' => 'xyz', 'size' => 13),
array('id' => 'MGH01KY', 'brand' => 'QWE', 'model' => 'poi', 'size' => 23),
array('id' => 'MGH01KL', 'brand' => 'ABC', 'model' => 'xyz', 'size' => 18),
);*/
$conn = mysqli_connect("localhost", "root", "", "grup_arr");
$sql = "SELECT a.name_id, b.fullname, a.hobby FROM hobby a INNER JOIN user b ON a.name_id=b.id";
$row_q = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($row_q)) {
    $array[] = $row;
}

$newArray = array();

// Create a new array from the source array.
foreach ($array as $item) {
    $itemname = $item["name_id"];
    $new_array[$itemname]["id"] = $item["name_id"];
    $new_array[$itemname]["fullname"] = $item["fullname"];
    $new_array[$itemname]["hobby"][$item["hobby"]] = 1;
}

foreach ($new_array as $itemname => $data) {
    if (isset($data['hobby']) && is_array($data['hobby'])) {
        $new_array[$itemname]['hobby'] = array_keys($new_array[$itemname]['hobby']);
    }
}

// *** DEBUG ***
echo "<pre>";
//print_r(array_values($new_array));
print_r(json_encode(array_values($new_array), JSON_PRETTY_PRINT));
echo "</pre>";
