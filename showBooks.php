<!DOCTYPE html>
<html>
<head>
  <title>Book Shop Display</title>
</head>
<body>
  <h1>Display all books</h1>
  <?php
    $db = new mysqli('localhost', 'root', '', 'books');
    if (mysqli_connect_errno()) {
       echo '<p>Error: Could not connect to database.<br/>
       Please try again later.</p>';
       exit;
    }
    $query = "SELECT ISBN, Author, Title, Price FROM Books";
    $stmt = $db->prepare($query); 
    $stmt->execute();
    $stmt->store_result();
  
    $stmt->bind_result($isbn, $author, $title, $price);
    echo "<p>Number of books found: ".$stmt->num_rows."</p>";
    echo "<table border=\"2px\"><tr><td>Title</td><td>Author</td><td>ISBN</td><td>Price</td></tr>";
    while($stmt->fetch()) {
      echo "<tr>";
      echo "<td>".$title."</td>";
      echo "<td>".$author."</td>";
      echo "<td>".$isbn."</td>";
      echo "<td>".number_format($price,2)."</td>";
      echo "</tr>";
    }
    echo "</table>";
    $stmt->free_result();
    $db->close();
  ?>
</body>
</html>