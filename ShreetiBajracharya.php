<!-- PHP cURL API Task Itonics -->
<?php
//  JSONPlaceholder API URL Used
$apiUrl = "https://jsonplaceholder.typicode.com/posts";
//Initializing curl
$curl = curl_init();

// Set cURL options
curl_setopt($curl, CURLOPT_URL, $apiUrl); //API endpoint
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //return response as a string
curl_setopt($curl, CURLOPT_TIMEOUT, 10); //timeout after 10 seconds

$response = curl_exec($curl); //Execute cURL request

//error handling
if (curl_errno($curl)) {
    echo "cURL Error: " . curl_error($curl);
    curl_close($curl);
    exit();
}

curl_close($curl); //Close cURL session

$posts = json_decode($response, true); //Decode JSON response

echo "<h1>Posts from JSONPlaceholder API</h1>";

if (!empty($posts)) {
    for ($i = 0; $i < 5; $i++) { //Display first 5 posts
        echo "<hr>";
        echo "<strong>Post ID:</strong> " . $posts[$i]['id'] . "<br>";
        echo "<strong>Title:</strong> " . $posts[$i]['title'] . "<br>";
        echo "<strong>Body:</strong> " . $posts[$i]['body'] . "<br>";
    }
} else {
    echo "No posts found.";
}
