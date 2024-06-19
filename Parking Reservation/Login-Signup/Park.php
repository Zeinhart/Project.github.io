<?php
session_start();

// Prevent caching
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Check if the user is not logged in
if (!isset($_SESSION['id']) || !isset($_SESSION['fname'])) {
    // Redirect to error page
    header('Location: error.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Park Monitor</title>
    <style>
	
		.topnav {
			overflow: hidden;
			background-color: blue;
		}
			
		
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 18px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.split {
  float: right;
  background-color: #004CFF;
  color: #fff;
}

.scaled {
	transform: scale(0.9);
}

.logo-image{ 

    height: 10px;	
    overflow: hidden;
    margin-top: 1px;
	 background-size: contain;
  background-repeat: no-repeat;
  background-position: left;	
  display: absolute;
}

		
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 0 auto;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            width: 160px;
            text-align: center;
        }

        .table-container {
            display: flex;
            justify-content: space-between;
        }

        .table-container table {
            width: 45%;
            border-collapse: collapse;
        }

        .table-container th,
        .table-container td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .red {
            background-color: red;
        }

        .occupied {
            color: blue;
        }

        .not-available {
            color: red;
        }

        #toggleButton {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

		img {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
    </style>
</head>
<body>


<header>
<div class="topnav">
  <a class="active" href="http://localhost/Login-signup/home.php">Home</a>
  <a href="http://localhost/Login-signup/home.php" class="split">Logout</a>
    <a href="http://localhost/reserve/" class="split">Reservation</a>
</div>
</header>

<?php
// File name of the image
$imageFileName = "Map.png";

// Relative path to the image file
$imagePath = "http://localhost/Login-Signup/Map.png";
echo '<img src="' . $imagePath . '" alt="Park Map"style="float: left; margin-right: 5px; width: 650px; height: auto;">';


// Construct the full image source path
$imageSrc = $imagePath . $imageFileName;

?>
	<h1  style="text-align:center;"> Car</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Park Number</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Car 1</td>
                <td id="statusCell1">Available</td>
                <td><button onclick="toggleStatus(1)">Toggle</button></td>
            </tr>
            <tr>
                <td>Car 2</td>
                <td id="statusCell2">Available</td>
                <td><button onclick="toggleStatus(2)">Toggle</button></td>
            </tr>
			 <tr>
                <td>Car 3</td>
                <td id="statusCell3">Available</td>
                <td><button onclick="toggleStatus(3)">Toggle</button></td>
            </tr>
            <tr>
                <td>Car 4</td>
                <td id="statusCell4">Available</td>
                <td><button onclick="toggleStatus(4)">Toggle</button></td>
            </tr>
        </tbody>
    </table>
	
	<h1  style="text-align:center;"> Motorcycle 1-10</h1>
    <table>
        <thead>
            <tr>
                <th>Park Number</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Motor 1</td>
                <td id="statusCell5">Available</td>
                <td><button onclick="toggleStatus(5)">Toggle</button></td>
            </tr>
            <tr>
                <td>Motor 2</td>
                <td id="statusCell6">Available</td>
                <td><button onclick="toggleStatus(6)">Toggle</button></td>
            </tr>
			 <tr>
                <td>Motor 3</td>
                <td id="statusCell7">Available</td>
                <td><button onclick="toggleStatus(7)">Toggle</button></td>
            </tr>
            <tr>
                <td>Motor 4</td>
                <td id="statusCell8">Available</td>
                <td><button onclick="toggleStatus(8)">Toggle</button></td>
            </tr>
			<tr>
                <td>Motor 5</td>
                <td id="statusCell9">Available</td>
                <td><button onclick="toggleStatus(9)">Toggle</button></td>
            </tr>
            <tr>
                <td>Motor 6</td>
                <td id="statusCell10">Available</td>
                <td><button onclick="toggleStatus(10)">Toggle</button></td>
            </tr>
			 <tr>
                <td>Motor 7</td>
                <td id="statusCell11">Available</td>
                <td><button onclick="toggleStatus(11)">Toggle</button></td>
            </tr>
            <tr>
                <td>Motor 8</td>
                <td id="statusCell12">Available</td>
                <td><button onclick="toggleStatus(12)">Toggle</button></td>
            </tr>
            <tr>
                <td>Motor 9</td>
                <td id="statusCell13">Available</td>
                <td><button onclick="toggleStatus(13)">Toggle</button></td>
            </tr>
            <tr>
                <td>Motor 10</td>
                <td id="statusCell14">Available</td>
                <td><button onclick="toggleStatus(14)">Toggle</button></td>
            </tr>
        </tbody>
    </table>

    <br/>
    <br/>
    <br/>

    <div class="table-container">
    <h1  style="text-align:center;"> Motorcycle 11-17</h1>
    <table>
        <thead>
            <tr>
                <th>Park Number</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Motor 11</td>
                <td id="statusCell15">Available</td>
                <td><button onclick="toggleStatus(15)">Toggle</button></td>
            </tr>
            <tr>
                <td>Motor 12</td>
                <td id="statusCell16">Available</td>
                <td><button onclick="toggleStatus(16)">Toggle</button></td>
            </tr>
			 <tr>
                <td>Motor 13</td>
                <td id="statusCell17">Available</td>
                <td><button onclick="toggleStatus(17)">Toggle</button></td>
            </tr>
            <tr>
                <td>Motor 14</td>
                <td id="statusCell18">Available</td>
                <td><button onclick="toggleStatus(18)">Toggle</button></td>
            </tr>
            <tr>
                <td>Motor 15</td>
                <td id="statusCell19">Available</td>
                <td><button onclick="toggleStatus(19)">Toggle</button></td>
            </tr>
            <tr>
                <td>Motor 16</td>
                <td id="statusCell20">Available</td>
                <td><button onclick="toggleStatus(20)">Toggle</button></td>
            </tr>
			 <tr>
                <td>Motor 17</td>
                <td id="statusCell21">Available</td>
                <td><button onclick="toggleStatus(21)">Toggle</button></td>
            </tr>
            </tbody>
    </table>

    <h1  style="text-align:center;"> Motorcycle 18-24</h1>
    <table>
        <thead>
            <tr>
                <th>Park Number</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Motor 18</td>
                <td id="statusCell22">Available</td>
                <td><button onclick="toggleStatus(22)">Toggle</button></td>
            </tr>
            <tr>
                <td>Motor 19</td>
                <td id="statusCell23">Available</td>
                <td><button onclick="toggleStatus(23)">Toggle</button></td>
            </tr>
			 <tr>
                <td>Motor 20</td>
                <td id="statusCell24">Available</td>
                <td><button onclick="toggleStatus(24)">Toggle</button></td>
            </tr>
            <tr>
                <td>Motor 21</td>
                <td id="statusCell25">Available</td>
                <td><button onclick="toggleStatus(25)">Toggle</button></td>
            </tr>
            <tr>
                <td>Motor 22</td>
                <td id="statusCell26">Available</td>
                <td><button onclick="toggleStatus(26)">Toggle</button></td>
            </tr>
            <tr>
                <td>Motor 23</td>
                <td id="statusCell27">Available</td>
                <td><button onclick="toggleStatus(27)">Toggle</button></td>
            </tr>
			 <tr>
                <td>Motor 24</td>
                <td id="statusCell28">Available</td>
                <td><button onclick="toggleStatus(28)">Toggle</button></td>
            </tr>
            </tbody>
    </table>
</div>

    <script>
  // Retrieve status from localStorage or set default if not found
        var statusMap = JSON.parse(localStorage.getItem("statusMap")) || {
            1: "Available",
            2: "Not Available",
            3: "Occupied"
        };

        function toggleStatus(id) {
            var statusCell = document.getElementById("statusCell" + id);
            var currentStatus = statusMap[id];

            if (currentStatus === "Available") {
                statusCell.textContent = "Not Available";
                statusCell.classList.add("not-available");
                statusMap[id] = "Not Available";
            } else if (currentStatus === "Not Available") {
                statusCell.textContent = "Occupied";
                statusCell.classList.remove("not-available");
                statusCell.classList.add("occupied");
                statusMap[id] = "Occupied";
            } else {
                statusCell.textContent = "Available";
                statusCell.classList.remove("occupied");
                statusMap[id] = "Available";
            }

            // Save status to localStorage
            localStorage.setItem("statusMap", JSON.stringify(statusMap));
        }

        // Initialize the status on page load
        window.onload = function() {
            for (var id in statusMap) {
                var statusCell = document.getElementById("statusCell" + id);
                if (statusMap[id] === "Not Available") {
                    statusCell.textContent = "Not Available";
                    statusCell.classList.add("not-available");
                } else if (statusMap[id] === "Occupied") {
                    statusCell.textContent = "Occupied";
                    statusCell.classList.add("occupied");
                }
            }
        };
    </script>
</body>
</html>


