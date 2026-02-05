<?php

$baseUrl = "https://jsonplaceholder.typicode.com/users";

$action = isset($_POST['action']) ? $_POST['action'] : 'GET';

$result = null;


$url = $baseUrl;

//PUT,PATCH,DElETE requires id in the url
if (in_array($action, ['PUT', 'PATCH', 'DELETE'])) {
    $url .= "/1";
}

$ch = curl_init($url);

//We don't want to print the data immediately in the browser, but store it and show in table later
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

switch ($action) {
    case 'GET':
        // Default request is GET, no additional options required
        break;

    case 'POST':
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'name' => 'Sandesh Khatiwada',
            'email' => 'sandesh@gmail.com'
        ]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        break;

    case 'PUT':
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'name' => 'Sandesh Khatiwada',
            'email' => 'sandesh@gmail.com'
        ]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        break;

    case 'PATCH':
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'email' => 'sandesh@gmail.com'
        ]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        break;

    case 'DELETE':
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        break;
}

$response = curl_exec($ch);

if (curl_errno($ch)) {
    $result = "Curl Error: " . curl_error($ch);
} else {
    $result = $response;
}

//Converting json string to associative array
$data = json_decode($response, true);

unset($ch);

?>


<!DOCTYPE html>
<html>
<head>
    <title>Users Table</title>
    <style>
        table { border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 8px; }
        button { padding: 8px 16px; margin-right: 10px; }
        pre { background: #f0f0f0; padding: 10px; }
    </style>
</head>
<body>

<h2>User Table</h2>

<?php if ($action === 'GET' && is_array($data)){ ?>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
    </tr>
    <?php foreach ($data as $user) {?>
    <tr>
        <td><?php echo $user['id'] ?></td>
        <td><?php echo $user['name'] ?></td>
        <td><?php echo $user['email'] ?></td>
        <td><?php echo $user['phone'] ?></td>
    </tr>
    <?php }?>
</table>
<?php } ?>


<form method="post">
    <button name="action" value="GET">GET Users</button>
    <button name="action" value="POST">POST User</button>
    <button name="action" value="PUT">PUT User</button>
    <button name="action" value="PATCH">PATCH User</button>
    <button name="action" value="DELETE">DELETE User</button>
</form>

<h3>Result:</h3>
<pre><?php echo $result ?></pre>

</body>
</html>
