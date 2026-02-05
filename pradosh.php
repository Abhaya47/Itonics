<?php
$url = "https://fakerestaurantapi.runasp.net/api/Restaurant";

$data = curl_init($url);
curl_setopt($data, CURLOPT_RETURNTRANSFER, true);
$responses = curl_exec($data);
echo "<h2>Restaurant List</h2>";

echo "
<table border='1'>
    <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Address</th>
            <th>Parking Lot</th>
        </tr>
    </thead>
    <tbody>";
foreach (json_decode($responses) as $response) {
    echo "<tr>
            <td>" . $response->restaurantName . "</td>
            <td>" . $response->type . "</td>
            <td>" . $response->address . "</td>
            <td>" . ($response->parkingLot == 1 ? "Yes" : "No") . "</td>
        </tr>";
}
echo
"</tbody>
</table>";
