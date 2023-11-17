<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="./images/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hell-MS</title>
    <link href="./style.css" rel="stylesheet" type="text/css" media="all">
  </head>
  <body>
    <div class="wrap">
      <div class="navigator">
        <div class="container" onclick="showhide(this)">
          <div class="bar1"></div>
          <div class="bar2"></div>
          <div class="bar3"></div>
        </div>
        <ul id="navelements" class="visible">
        <?php
        
error_reporting(E_ALL);
ini_set("display_errors", 1);
$user = "root";
$pass = "sarkaa3";
try {
    $dbh = new PDO("mysql:host=localhost;dbname=quiz2", $user, $pass);
} catch (PDOException $e) {
    echo "ERROR";
}

if (isset($_POST["switch"])) {
    if ($dbh) {
        $deleteTableQuery = "DROP TABLE lectures";

        $result = $dbh->exec($deleteTableQuery);

        if ($result !== false) {
            echo "Table 'lectures' deleted successfully.";
        } else {
            echo "Table deletion failed: " . $dbh->errorInfo()[2];
        }

        $deleteTableQuery = "DROP TABLE labs";

        $result = $dbh->exec($deleteTableQuery);

        if ($result !== false) {
            echo "Table 'labs' deleted successfully.";
        } else {
            echo "Table deletion failed: " . $dbh->errorInfo()[2];
        }
    }
}

if (isset($_POST["switch"])) {
    // SQL query to create a new table
    $createTableQuery = "CREATE TABLE lectures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Title lONGTEXT NOT NULL,
    Description lONGTEXT NOT NULL,
    link lONGTEXT NOT NULL
)";

    // Execute the query
    $result = $dbh->exec($createTableQuery);

    if ($result !== false) {
        echo "Table 'lectures' created successfully.\n";

        $filename = isset($_POST["mbe"]) ? "mbe.json" : "websys.json";
        $data = file_get_contents($filename);
        $array1 = json_decode($data, true);
        $array = $array1[isset($_POST["mbe"]) ? "ITWS4967" : "ITWS2110"]["Lectures"];

        foreach ($array as $value) {
            $string = implode(", ", $value["Description"]);
            $string2 = implode(", ", $value["Link to Slideshow"]);
            $query =
                "INSERT INTO lectures (Title, Description, link) VALUES ('" .
                $value["Title"] .
                "', '$string','$string2')";
            $result = $dbh->exec($query);
        }
    } else {
        echo "Failed to create 'lectures' table.";
    }
}

if (isset($_POST["switch"])) {
    $createTableQuery = "CREATE TABLE labs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Title lONGTEXT NOT NULL,
    Description lONGTEXT NOT NULL,
    link lONGTEXT NOT NULL
)";
    $result = $dbh->exec($createTableQuery);

    if ($result !== false) {
        echo "Table 'labs' created successfully.\n";
        $filename2 = isset($_POST["mbe"]) ? "mbe.json" : "websys.json";
        $data2 = file_get_contents($filename2);
        $array3 = json_decode($data2, true);
        $array2 = $array3[isset($_POST["mbe"]) ? "ITWS4967" : "ITWS2110"]["Labs"];

        // Insert data into 'labs' table

        foreach ($array2 as $value) {
            $query =
                "INSERT INTO labs (Title, Description, link) VALUES ('" .
                $value["Title"] .
                "', '" .
                $value["Description"] .
                "','" .
                $value["Link to Instructions"] .
                "')";
            $result = $dbh->exec($query);
        }
    } else {
        echo "Failed to create 'labs' table.";
    }
}

if (isset($_POST["new_table"]) || isset($_POST["switch"])) {
    if ($dbh) {
        // Query to fetch data from a table
        $query = "SELECT * FROM lectures";

        // Execute the query
        $stmt = $dbh->query($query);

        if ($stmt) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<a href='#".$row["Title"]."'><li>".$row["Title"]."</li></a>";
            }
        } else {
            echo "Query error: " . $dbh->errorInfo()[2];
        }

        $query = "SELECT * FROM labs";

        // Execute the query
        $stmt = $dbh->query($query);

        if ($stmt) {

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<a href='#".$row["Title"]."'><li>".$row["Title"]."</li></a>";
            }

        } else {
            echo "Query error: " . $dbh->errorInfo()[2];
        }
    }
}
?>
        </ul>
      </div>
      <div class="content">
        <img id="logo" src="./images/logo.png">
        <div class="classitem">
          <h3 class="title">
            <img class="bapho" src="./images/bapho.jpg">Dummy Title <img class="bapho" src="./images/bapho.jpg">
          </h3>
          <div class="item">
            <form method="post" action="">
              <input type="submit" name="create_lecture" value="Create lectures">
            </form>
            <form method="post" action="">
              <input type="submit" name="create_lab" value="Create labs">
            </form>
            <form method="post" action="">
              <input type="submit" name="new_table" value="View New Table (Once both are created)">
            </form>
            <?php
            if (isset($_POST["new_table"]) || isset($_POST["switch"])){
                echo '<form method="post" action="">';
                echo '<input type="submit" name="switch" value="Switch between WebSys and MBE (Once both are created)">';
                if (!isset($_POST["mbe"])){
                    echo '<input type="hidden" name="mbe" value="1">';
                }
                echo '</form>';
            }
            ?>
            <form method="post" action="">
              <input type="submit" name="delete_tables" value="Delete new tables (grading, both must be created)">
            </form>
          </div>
        </div>
            <?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$user = "root";
$pass = "sarkaa3";
try {
    $dbh = new PDO("mysql:host=localhost;dbname=quiz2", $user, $pass);
} catch (PDOException $e) {
    echo "ERROR";
}

if ($dbh) {
    echo "Connected to the database successfully!<br>";
}

// PHP code to handle the form submission

if (isset($_POST["create_lecture"])) {
    // SQL query to create a new table
    $createTableQuery = "CREATE TABLE lectures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Title lONGTEXT NOT NULL,
    Description lONGTEXT NOT NULL,
    link lONGTEXT NOT NULL
)";

    // Execute the query
    $result = $dbh->exec($createTableQuery);

    if ($result !== false) {
        echo "Table 'lectures' created successfully.\n";

        $filename = isset($_POST["mbe"]) ? "mbe.json" : "websys.json";
        $data = file_get_contents($filename);
        $array1 = json_decode($data, true);
        $array = $array1[isset($_POST["mbe"]) ? "ITWS4967" : "ITWS2110"]["Lectures"];

        foreach ($array as $value) {
            $string = implode(", ", $value["Description"]);
            $string2 = implode(", ", $value["Link to Slideshow"]);
            $query =
                "INSERT INTO lectures (Title, Description, link) VALUES ('" .
                $value["Title"] .
                "', '$string','$string2')";
            $result = $dbh->exec($query);
        }
    } else {
        echo "Failed to create 'lectures' table.";
    }
}

if (isset($_POST["create_lab"])) {
    $createTableQuery = "CREATE TABLE labs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Title lONGTEXT NOT NULL,
    Description lONGTEXT NOT NULL,
    link lONGTEXT NOT NULL
)";
    $result = $dbh->exec($createTableQuery);

    if ($result !== false) {
        echo "Table 'labs' created successfully.\n";
        $filename2 = isset($_POST["mbe"]) ? "mbe.json" : "websys.json";
        $data2 = file_get_contents($filename2);
        $array3 = json_decode($data2, true);
        $array2 = $array3[isset($_POST["mbe"]) ? "ITWS4967" : "ITWS2110"]["Labs"];

        // Insert data into 'labs' table

        foreach ($array2 as $value) {
            $query =
                "INSERT INTO labs (Title, Description, link) VALUES ('" .
                $value["Title"] .
                "', '" .
                $value["Description"] .
                "','" .
                $value["Link to Instructions"] .
                "')";
            $result = $dbh->exec($query);
        }
    } else {
        echo "Failed to create 'labs' table.";
    }
}

if (isset($_POST["new_table"]) || isset($_POST["switch"])) {
    if ($dbh) {
        // Query to fetch data from a table
        $query = "SELECT * FROM lectures";

        // Execute the query
        $stmt = $dbh->query($query);

        if ($stmt) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<div class='classitem'>";
              echo "<h3 class='title' id='".$row["Title"]."'><img class='bapho' src='./images/bapho.jpg'>".$row["Title"]."<img class='bapho' src='./images/bapho.jpg'></h3>";
              echo "<div class='item'>";
              echo "<p class='description'>".$row["Description"]."</p>";
              echo "<p class='link'>". $row["link"] ."</p>";
              echo "</div>";
              echo "</div>";
            }

        } else {
            echo "Query error: " . $dbh->errorInfo()[2];
        }

        $query = "SELECT * FROM labs";

        // Execute the query
        $stmt = $dbh->query($query);

        if ($stmt) {

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<div class='classitem'>";
              echo "<h3 class='title' id='".$row["Title"]."'><img class='bapho' src='./images/bapho.jpg'>".$row["Title"]."<img class='bapho' src='./images/bapho.jpg'></h3>";
              echo "<div class='item'>";
              echo "<p class='description'>".$row["Description"]."</p>";
              echo "<p class='link'>". $row["link"] ."</p>";
              echo "</div>";
              echo "</div>";
            }

        } else {
            echo "Query error: " . $dbh->errorInfo()[2];
        }
    }
}

if (isset($_POST["delete_tables"])) {
    if ($dbh) {
        $deleteTableQuery = "DROP TABLE lectures";

        $result = $dbh->exec($deleteTableQuery);

        if ($result !== false) {
            echo "Table 'lectures' deleted successfully.";
        } else {
            echo "Table deletion failed: " . $dbh->errorInfo()[2];
        }

        $deleteTableQuery = "DROP TABLE labs";

        $result = $dbh->exec($deleteTableQuery);

        if ($result !== false) {
            echo "Table 'labs' deleted successfully.";
        } else {
            echo "Table deletion failed: " . $dbh->errorInfo()[2];
        }
    }
}
?>
      </div>
    </div>
    </div>
  </body>
  <script>
    function showhide(x) {
      document.getElementById('navelements').classList.toggle('visible');
      x.classList.toggle("change");
    }
  </script>
</html>