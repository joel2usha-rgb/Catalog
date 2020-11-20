<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Search Results</title>
</head>
<body>
    <h1>Book Search Results</h1>
    <?php
    // TODO 1: Create short variable names.

    require_once('login.php');

    $searchTerm = $_POST['searchterm'];
    $searchType = $_POST['searchtype'];
    // TODO 2: Check and filter data coming from the user.

    if ($searchTerm == null || $searchType == null)
    die("All fields must not be empty");

    // TODO 3: Setup a connection to the appropriate database.
    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn->connect_error) die($conn->connect_error);

    // TODO 4: Query the database.
    $query = "SELECT isbn, author, title, price FROM catalogs WHERE $searchType = '$searchTerm' ";
    $results = $conn->query($query);


    // TODO 5: Retrieve the results.
    $rows = $result->num_rows;


    // TODO 6: Display the results back to user.

    echo "
    <table>
        <tr>
            <th>Isbn</th>
            <th>Author</th>
            <th>Title</th>
            <th>Price</th>
        </tr>
    ";

    for ($i = 0; $i < $rows; $i++) {
        $row = $result->fetch_array(MYSQLI_NUM);
        echo "<tr>";
            for ($j=0; $j < 4; $j++) {
                echo "<td>" . htmlspecialchars($row[$j]) . "</td>";
                echo "</td>";
            }
        echo "</tr>";
    }
    echo "</table>";
    // TODO 7: Disconnecting from the database.

    $result->close();
    $conn->close();
    ?>
</body>
</html>
