<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styless.css">
</head>
<body>
    <header>
        <h1>Dashboard</h1>
        <button id="logout-btn" onclick="logout()">Logout</button>
    </header>
    <div class="container">
        <aside>
            <div class="menu-item" onclick="showSection('evaluation-criteria')">Evaluation Criteria</div>
            <div class="menu-item" onclick="showSection('evaluation-cycle')">Evaluation Cycle</div>
            <div class="menu-item" onclick="showSection('employee-assessment')">Employee Assessment</div>
            <div class="menu-item" onclick="showSection('employee-details')">Employee Details</div>
        </aside>
        <main>
            <section id="evaluation-criteria" class="content-section">
                <h2>Evaluation Criteria</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Assessment Score</th>
                            <th>Behavioral Competencies</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" value="85"></td>
                            <td><input type="text" value="Good"></td>
                            <td><button onclick="editItem(this)">Edit</button></td>
                            <td><button onclick="deleteItem(this)">Delete</button></td>
                        </tr>
                    </tbody>
                </table>
                <button onclick="addRow('evaluation-criteria')">Add Row</button>
            </section>
            <section id="evaluation-cycle" class="content-section">
                <h2>Evaluation Cycle</h2>
                <label><input type="checkbox"> Quarterly</label>
                <label><input type="checkbox"> Semi-Annual</label>
                <label><input type="checkbox"> Annual</label>
            </section>
            <section id="employee-assessment" class="content-section">
                <h2>Employee Assessment</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Goal Setting</th>
                            <th>Feedback</th>
                            <th>Performance</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" value="Increase Sales"></td>
                            <td><input type="text" value="Well Done"></td>
                            <td>
                                <select>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                            <td><button onclick="editItem(this)">Edit</button></td>
                            <td><button onclick="deleteItem(this)">Delete</button></td>
                        </tr>
                    </tbody>
                </table>
                <button onclick="addRow('employee-assessment')">Add Row</button>
            </section>
            <section id="employee-details" class="content-section">
                <h2>Employee Details</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Job Type</th>
                            <th>Performance Score</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" value="John Doe"></td>
                            <td><input type="text" value="Sales"></td>
                            <td><input type="text" value="Full-time"></td>
                            <td><input type="text" value="90"></td>
                            <td><button onclick="editItem(this)">Edit</button></td>
                            <td><button onclick="deleteItem(this)">Delete</button></td>
                        </tr>
                    </tbody>
                </table>
                <button onclick="addRow('employee-details')">Add Row</button>
            </section>
        </main>
    </div>

    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => section.style.display = 'none');
            document.getElementById(sectionId).style.display = 'block';
        }

        function editItem(button) {
            const row = button.parentElement.parentElement;
            const inputs = row.querySelectorAll('input');
            inputs.forEach(input => input.focus());
        }
        

        function deleteItem(button) {
            const row = button.parentElement.parentElement;
            const inputs = row.querySelectorAll('input');
            inputs.forEach(input => input.value = '');
        }

        function addRow(sectionId) {
            const section = document.getElementById(sectionId);
            const table = section.querySelector('table tbody');
            const newRow = document.createElement('tr');

            if (sectionId === 'evaluation-criteria') {
                newRow.innerHTML = `
                    <td><input type="text"></td>
                    <td><input type="text"></td>
                    <td><button onclick="editItem(this)">Edit</button></td>
                    <td><button onclick="deleteItem(this)">Delete</button></td>
                `;
            } else if (sectionId === 'employee-assessment') {
                newRow.innerHTML = `
                    <td><input type="text"></td>
                    <td><input type="text"></td>
                    <td>
                        <select>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        </td>
                    <td><button onclick="editItem(this)">Edit</button></td>
                    <td><button onclick="deleteItem(this)">Delete</button></td>
                `;
            } else if (sectionId === 'employee-details') {
                newRow.innerHTML = `
                    <td><input type="text"></td>
                    <td><input type="text"></td>
                    <td><input type="text"></td>
                    <td><input type="text"></td>
                    <td><button onclick="editItem(this)">Edit</button></td>
                    <td><button onclick="deleteItem(this)">Delete</button></td>
                `;
            }

            table.appendChild(newRow);
        }

        function logout() {
            if (confirm('Logged out!!')) {
                window.location.href = 'index.html';
            }
        }

        // Show the first section by default
        showSection('evaluation-criteria');
    </script>
</body>
</html>

<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dashboard";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);

if ($method == 'GET') {
    $stmt = $conn->prepare("SELECT * FROM details");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);

} elseif ($method == 'POST') {
    $name = $input['name'];
    $department = $input['department'];
    $jobType = $input['jobType'];
    $performanceScore = $input['performanceScore'];

    $stmt = $conn->prepare("INSERT INTO details (Name, Department, JobType, PerformanceScore) VALUES (:name, :department, :jobType, :performanceScore)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':department', $department);
    $stmt->bindParam(':jobType', $jobType);
    $stmt->bindParam(':performanceScore', $performanceScore);
    if($stmt->execute()) {
        echo json_encode(["message" => "Record added successfully"]);
    } else {
        echo json_encode(["error" => "Error adding record"]);
    }

} elseif ($method == 'DELETE') {
    $id = $input['id'];

    $stmt = $conn->prepare("DELETE FROM details WHERE id = :id");
    $stmt->bindParam(':id', $id);
    if($stmt->execute()) {
        echo json_encode(["message" => "Record deleted successfully"]);
    } else {
        echo json_encode(["error" => "Error deleting record"]);
    }
}
?>
