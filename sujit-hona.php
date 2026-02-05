<?php
$ch = curl_init('https://jsonplaceholder.typicode.com/users');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$users = json_decode(curl_exec($ch), true);
curl_close($ch);
?>

<table border="1">
    <tr><th>ID</th><th>Name</th><th>Email</th></tr>
    <?php foreach($users as $u): ?>
    <tr>
        <td><?=$u['id']?></td>
        <td><?=$u['name']?></td>
        <td><?=$u['email']?></td>
    </tr>
    <?php endforeach; ?>
</table>