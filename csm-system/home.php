<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM System</title>
    <link rel="website icon" type="png" href="logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style> 
        .custom-radio {
            border: 2px solid black;  /* Black border around the radio button */
            border-radius: 50%;  /* Ensure it's a round border */
            padding: 5px;  /* Adjust padding for better visibility */
        }

        .custom-radio:checked {
        
            border-color: gray;  /* Keep border black even when checked */
        }

        .custom-radio:focus {
            outline: none;  /* Remove default focus outline */
        }
        
        /* Make the first row a bit thicker */
        .thicker-row {
            font-weight: bold;  /* Make the text bold */
            background-color: #f0f0f0;  /* Light gray background for distinction */
            border-top: 3px solid black;  /* Thicker top border */
            border-bottom: 3px solid black;  /* Thicker bottom border */
        }

        /* Align the first column (Questions) to the left */
        .table td:first-child, .table th:first-child {
            text-align: left;
        }

    </style>
    <?php
        if (isset($_SESSION['error'])) {
            echo "<script>
                window.onload = function() {
                    toastr.error('" . $_SESSION['error'] . "');
                }
            </script>";
            unset($_SESSION['error']);
        }
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<nav class="navbar navbar-expand-lg" style="background: linear-gradient(90deg, #4B0082, #6A5ACD); box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <div class="container-fluid">
        <!-- System Name -->
        <a class="navbar-brand text-white fw-bold" href="#">CSM System</a>

        <!-- Toggle button for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Include Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<body>
    <div class="container mt-4">
        <h1>CSM Consolidated Report</h1>

        <!-- Add this button to trigger the modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#csmModal" style="width: auto; padding: 5px 10px; font-size: 14px;">
            Add CSM Results
        </button>

        <div class="modal fade" id="csmModal" tabindex="-1" aria-labelledby="csmModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="csmModalLabel">Add CSM Results</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="process.php">
                        <div class="modal-body">
                            <!-- Demographic Distribution -->
                            <div class="border rounded p-3 mb-4 shadow-sm">
                            <h6 class="text-primary">Demographic</h6>
                                <div class="row">
                                    <!-- Gender Column -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Gender</label><br>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input custom-radio" id="male" name="gender" value="Male" required>
                                            <label for="male">Male</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input custom-radio" id="female" name="gender" value="Female">
                                            <label for="female">Female</label>
                                        </div>
                                    </div>
                                    
                                    <!-- Age Column -->
                                    <div class="col-md-6 mb-3">
                                        <label for="age" class="form-label">Age</label>
                                        <input type="number" class="form-control" id="age" name="age" required style="width: 60px; height: 30px; padding-left: 5px;">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="survey_date" class="form-label">Date of Survey</label>
                                        <input type="date" class="form-control" id="survey_date" name="survey_date" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Citizen's Charter Questions Section -->
                            <div class="border rounded p-3 mb-4 shadow-sm">
                                <h6 class="text-primary">Citizen's Charter Questions</h6>
                                <div class="mb-3">
                                    <label class="form-label">CC1. Which of the following describes your awareness of the CC?</label>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="cc1" value="I know what a CC is and I saw this office's CC" required>
                                        <label class="form-check-label">I know what a CC is and I saw this office's CC</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="cc1" value="I know what a CC is but I did not see this office's CC">
                                        <label class="form-check-label">I know what a CC is but I did not see this office's CC</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="cc1" value="I learned of the CC only when I saw this office's CC">
                                        <label class="form-check-label">I learned of the CC only when I saw this office's CC</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="cc1" value="I do not know what a CC is and I did not see this office's CC">
                                        <label class="form-check-label">I do not know what a CC is and I did not see this office's CC</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">CC2. If aware of CC, would you say that the CC of this office was...?</label>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="cc2" value="Easy to see" required>
                                        <label class="form-check-label">Easy to see</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="cc2" value="Somewhat easy to see">
                                        <label class="form-check-label">Somewhat easy to see</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="cc2" value="Difficult to see">
                                        <label class="form-check-label">Difficult to see</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="cc2" value="Not visible at all">
                                        <label class="form-check-label">Not visible at all</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">CC3. If aware of CC, how much did the CC help you in your transaction?</label>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="cc3" value="Helped very much" required>
                                        <label class="form-check-label">Helped very much</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="cc3" value="Somewhat helped">
                                        <label class="form-check-label">Somewhat helped</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="cc3" value="Did not help">
                                        <label class="form-check-label">Did not help</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Service Quality Dimensions Section -->
                            <div class="border rounded p-3 shadow-sm">
                                <h6 class="text-primary">Service Quality Dimensions</h6>
                                <div class="mb-3">
                                    <label class="form-label">SQD1: Responsiveness</label>
                                    <input type="hidden" name="respo" value="Responsiveness"> 
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="responsiveness" value="Strongly Agree" required>
                                        <label class="form-check-label">Strongly Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="responsiveness" value="Agree">
                                        <label class="form-check-label">Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="responsiveness" value="Neither Agree nor Disagree">
                                        <label class="form-check-label">Neither Agree nor Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="responsiveness" value="Disagree">
                                        <label class="form-check-label">Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="responsiveness" value="Strongly Disagree">
                                        <label class="form-check-label">Strongly Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="responsiveness" value="N/A">
                                        <label class="form-check-label">N/A</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">SQD2: Reliability</label>
                                    <input type="hidden" name="relia" value="Reliability"> 
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="reliability" value="Strongly Agree" required>
                                        <label class="form-check-label">Strongly Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="reliability" value="Agree">
                                        <label class="form-check-label">Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="reliability" value="Neither Agree nor Disagree">
                                        <label class="form-check-label">Neither Agree nor Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="reliability" value="Disagree">
                                        <label class="form-check-label">Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="reliability" value="Strongly Disagree">
                                        <label class="form-check-label">Strongly Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="reliability" value="N/A">
                                        <label class="form-check-label">N/A</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">SQD3: Access and Facilities</label>
                                    <input type="hidden" name="acce" value="Access and Facilities"> 
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="access" value="Strongly Agree" required>
                                        <label class="form-check-label">Strongly Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="access" value="Agree">
                                        <label class="form-check-label">Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="access" value="Neither Agree nor Disagree">
                                        <label class="form-check-label">Neither Agree nor Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="access" value="Disagree">
                                        <label class="form-check-label">Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="access" value="Strongly Disagree">
                                        <label class="form-check-label">Strongly Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="access" value="N/A">
                                        <label class="form-check-label">N/A</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">SQD4: Communication</label>
                                    <input type="hidden" name="commu" value="Communication"> 
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="communication" value="Strongly Agree" required>
                                        <label class="form-check-label">Strongly Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="communication" value="Agree">
                                        <label class="form-check-label">Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="communication" value="Neither Agree nor Disagree">
                                        <label class="form-check-label">Neither Agree nor Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="communication" value="Disagree">
                                        <label class="form-check-label">Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="communication" value="Strongly Disagree">
                                        <label class="form-check-label">Strongly Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="communication" value="N/A">
                                        <label class="form-check-label">N/A</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">SQD5: Costs</label>
                                    <input type="hidden" name="cost" value="Costs"> 
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="costs" value="Strongly Agree" required>
                                        <label class="form-check-label">Strongly Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="costs" value="Agree">
                                        <label class="form-check-label">Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="costs" value="Neither Agree nor Disagree">
                                        <label class="form-check-label">Neither Agree nor Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="costs" value="Disagree">
                                        <label class="form-check-label">Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="costs" value="Strongly Disagree">
                                        <label class="form-check-label">Strongly Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="costs" value="N/A">
                                        <label class="form-check-label">N/A</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">SQD6: Integrity</label>
                                    <input type="hidden" name="integ" value="Integrity"> 
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="integrity" value="Strongly Agree" required>
                                        <label class="form-check-label">Strongly Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="integrity" value="Agree">
                                        <label class="form-check-label">Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="integrity" value="Neither Agree nor Disagree">
                                        <label class="form-check-label">Neither Agree nor Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="integrity" value="Disagree">
                                        <label class="form-check-label">Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="integrity" value="Strongly Disagree">
                                        <label class="form-check-label">Strongly Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="integrity" value="N/A">
                                        <label class="form-check-label">N/A</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">SQD7: Assurance</label>
                                    <input type="hidden" name="assur" value="Assurance"> 
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="assurance" value="Strongly Agree" required>
                                        <label class="form-check-label">Strongly Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="assurance" value="Agree">
                                        <label class="form-check-label">Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="assurance" value="Neither Agree nor Disagree">
                                        <label class="form-check-label">Neither Agree nor Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="assurance" value="Disagree">
                                        <label class="form-check-label">Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="assurance" value="Strongly Disagree">
                                        <label class="form-check-label">Strongly Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="assurance" value="N/A">
                                        <label class="form-check-label">N/A</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">SQD8: Outcome</label>
                                    <input type="hidden" name="out" value="Outcome"> 
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="outcome" value="Strongly Agree" required>
                                        <label class="form-check-label">Strongly Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="outcome" value="Agree">
                                        <label class="form-check-label">Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="outcome" value="Neither Agree nor Disagree">
                                        <label class="form-check-label">Neither Agree nor Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="outcome" value="Disagree">
                                        <label class="form-check-label">Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="outcome" value="Strongly Disagree">
                                        <label class="form-check-label">Strongly Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio" type="radio" name="outcome" value="N/A">
                                        <label class="form-check-label">N/A</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal" style="width: 80px;">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success" style="width: 80px;">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <form method="GET" class="row g-2 mt-3">
            <div class="col-md-6">
                <label for="monthSelect" class="form-label">Select Month:</label>
                <select id="monthSelect" name="selected_month" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">All</option>
                    <?php
                        for ($m = 1; $m <= 12; $m++) {
                            $monthValue = str_pad($m, 2, '0', STR_PAD_LEFT);
                            $selected = (isset($_GET['selected_month']) && $_GET['selected_month'] == $monthValue) ? "selected" : "";
                            echo "<option value='$monthValue' $selected>" . date("F", mktime(0, 0, 0, $m, 1)) . "</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="yearSelect" class="form-label">Select Year:</label>
                <select id="yearSelect" name="selected_year" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">All</option>
                    <?php
                        $currentYear = date("Y");
                        for ($y = $currentYear; $y >= ($currentYear - 10); $y--) {
                            $selected = (isset($_GET['selected_year']) && $_GET['selected_year'] == $y) ? "selected" : "";
                            echo "<option value='$y' $selected>$y</option>";
                        }
                    ?>
                </select>
            </div>
        </form>

        <?php
            $selected_month = isset($_GET['selected_month']) ? $_GET['selected_month'] : '';
            $selected_year = isset($_GET['selected_year']) ? $_GET['selected_year'] : '';

            // Build WHERE clause based on selected filters
            $whereClauses = [];
            if (!empty($selected_month)) {
                $whereClauses[] = "MONTH(survey_date) = '$selected_month'";
            }
            if (!empty($selected_year)) {
                $whereClauses[] = "YEAR(survey_date) = '$selected_year'";
            }

            // Combine WHERE conditions
            $whereClause = !empty($whereClauses) ? "WHERE " . implode(" AND ", $whereClauses) : "";

            // Fetch age group distribution
            $ageQuery = "SELECT age_group, COUNT(*) as total FROM demographics $whereClause GROUP BY age_group";
            $ageStmt = $conn->prepare($ageQuery);
            $ageStmt->execute();
            $ageResult = $ageStmt->get_result();
            $ageResults = $ageResult->fetch_all(MYSQLI_ASSOC);

            // Fetch gender distribution
            $genderQuery = "SELECT gender, COUNT(*) as total FROM demographics $whereClause GROUP BY gender";
            $genderStmt = $conn->prepare($genderQuery);
            $genderStmt->execute();
            $genderResult = $genderStmt->get_result();
            $genderResults = $genderResult->fetch_all(MYSQLI_ASSOC);

            // Calculate total responses for the selected period
            $totalQuery = "SELECT COUNT(*) as grand_total FROM demographics $whereClause";
            $totalStmt = $conn->prepare($totalQuery);
            $totalStmt->execute();
            $totalResult = $totalStmt->get_result();
            $grandTotal = $totalResult->fetch_assoc()['grand_total'];

            // Process age data
            $ageData = [];
            foreach ($ageResults as $row) {
                $ageGroup = $row['age_group'];
                $total = $row['total'];
                $ageData[$ageGroup] = $total;
            }

            // Process gender data
            $defaultGenders = ['Male' => 0, 'Female' => 0]; // Default genders with zero counts
            $genderData = $defaultGenders; // Initialize genderData with default values

            foreach ($genderResults as $row) {
                $gender = $row['gender'];
                $total = $row['total'];
                $genderData[$gender] = $total;
            }
        ?>
        <!-- Demographics Section -->
        <div class="mb-4 p-4 bg-light rounded">
            <h2>Demographic Distribution</h2>

            <!-- Age Group Distribution -->
            <h4>Age Group Distribution</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Age Group</th>
                        <th>Percentage (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($ageData)): ?>
                        <?php foreach ($ageData as $ageGroup => $total): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($ageGroup); ?></td>
                                <td><?php echo number_format(($total / $grandTotal) * 100, 2); ?>%</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" style="text-align:center;">No responses recorded</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Gender Distribution -->
            <h4>Gender Distribution</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Gender</th>
                        <th>Percentage (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($genderData as $gender => $total): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($gender); ?></td>
                            <td><?php echo number_format(($grandTotal > 0 ? ($total / $grandTotal) * 100 : 0), 2); ?>%</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php
            $query = "
                SELECT question, responses, COUNT(responses) AS response_count 
                FROM cc_awareness 
                JOIN demographics ON cc_awareness.demographic_id = demographics.id 
                $whereClause
                GROUP BY question, responses
            ";
            $result = $conn->query($query);        

            // Organize data in an associative array
            $data = [];
            $total_responses = [];

            while ($row = $result->fetch_assoc()) {
            $question = trim($row['question']);  // CC1, CC2, CC3
            $response = trim(html_entity_decode($row['responses'], ENT_QUOTES)); // Decode special characters
            $count = $row['response_count'];

            // Store total responses per question for percentage calculation
            if (!isset($total_responses[$question])) {
                $total_responses[$question] = 0;
            }
            $total_responses[$question] += $count;

            // Store response counts
            $data[$question][$response] = $count;
            }

            // Define questions and possible responses (matching exactly with DB saved values)
            $questions = [
            "CC1" => [
                "I know what a CC is and I saw this office\'s CC",
                "I know what a CC is but I did not see this office\'s CC",
                "I learned of the CC only when I saw this office\'s CC",
                "I do not know what a CC is and I did not see this office\'s CC"
            ],
            "CC2" => [
                "Easy to see",
                "Somewhat easy to see",
                "Difficult to see",
                "Not visible at all"
            ],
            "CC3" => [
                "Helped very much",
                "Somewhat helped",
                "Did not help"
            ]
            ];
        ?>
        <!-- Citizen's Charter Questions Table -->
        <h3>Citizen's Charter Questions</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center;">Citizen's Charter Answers</th>
                    <th>Responses</th>
                    <th>Percentage (%)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions as $key => $responses): ?>
                    <!-- Section Heading -->
                    <tr class="thicker-row">
                        <td><b><?php echo htmlspecialchars($key); ?></b></td>
                        <td></td>
                        <td></td>
                    </tr>
                    
                    <?php foreach ($responses as $text): ?>
                        <?php 
                            // Remove backslashes only for display
                            $displayText = stripslashes($text);
                            $normalizedText = trim(html_entity_decode($text, ENT_QUOTES)); // Ensure exact match
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($displayText); ?></td>
                            <td>
                                <?php 
                                    $count = $data[$key][$normalizedText] ?? 0;
                                    echo $count > 0 ? $count : "x";
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if (isset($data[$key][$normalizedText]) && $total_responses[$key] > 0) {
                                        $percentage = ($data[$key][$normalizedText] / $total_responses[$key]) * 100;
                                        echo number_format($percentage, 2) . "%";
                                    } else {
                                        echo "yy.yy%";
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <!-- Empty row for spacing -->
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <?php
            $query = "
                SELECT dimension, level, COUNT(level) AS response_count 
                FROM service_quality 
                JOIN demographics ON service_quality.demographic_id = demographics.id 
                $whereClause
                GROUP BY dimension, level
            ";
            $result = $conn->query($query);        

            // Define service quality dimensions
            $dimensions = [
                "Responsiveness", "Reliability", "Access and Facilities", "Communication",
                "Costs", "Integrity", "Assurance", "Outcome"
            ];

            // Define response levels with corresponding values
            $levels = [
                "Strongly Agree" => 5, "Agree" => 4, "Neither Agree nor Disagree" => 3, 
                "Disagree" => 2, "Strongly Disagree" => 1, "N/A" => 0
            ];

            // Initialize arrays for storing data
            $data = [];
            $total_per_dimension = [];
            $total_per_column = array_fill_keys(array_keys($levels), 0);
            $grand_total = 0;
            $weighted_scores = [];

            // Process data from database
            while ($row = $result->fetch_assoc()) {
                $dimension = $row['dimension'];
                $level = $row['level'];
                $count = $row['response_count'];
                
                // Store total responses for each dimension
                $total_per_dimension[$dimension] = ($total_per_dimension[$dimension] ?? 0) + $count;
                
                // Store counts by dimension and level
                $data[$dimension][$level] = $count;
                
                // Add to total per column
                $total_per_column[$level] += $count;
                $grand_total += $count;
                
                // Calculate weighted score
                $weighted_scores[$dimension] = ($weighted_scores[$dimension] ?? 0) + ($levels[$level] * $count);
            }
        ?>
        <!-- Service Quality Dimensions Table -->
        <h3>Service Quality Dimensions</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Service Quality Dimensions</th>
                    <?php foreach (array_keys($levels) as $level): ?>
                        <th><?php echo htmlspecialchars($level); ?></th>
                    <?php endforeach; ?>
                    <th>Total Responses</th>
                    <th>Overall (%)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dimensions as $dimension): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($dimension); ?></td>
                        <?php $row_total = $total_per_dimension[$dimension] ?? 0; ?>
                        <?php foreach (array_keys($levels) as $level): ?>
                            <td>
                                <?php 
                                $count = $data[$dimension][$level] ?? 0;
                                echo $count > 0 ? $count : "x"; 
                                ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?php echo $row_total > 0 ? $row_total : "x"; ?></td>
                        <td>
                            <?php 
                            if ($row_total > 0) {
                                $weighted_avg = $weighted_scores[$dimension] / $row_total;
                                echo number_format(($weighted_avg / 5) * 100, 2) . "%";
                            } else {
                                echo "yy.yy%";
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
                <!-- Overall row -->
                <tr>
                    <td><b>Overall</b></td>
                    <?php foreach (array_keys($levels) as $level): ?>
                        <td>
                            <?php 
                            $column_total = $total_per_column[$level] ?? 0;
                            echo $column_total > 0 ? $column_total : "x"; 
                            ?>
                        </td>
                    <?php endforeach; ?>
                    <td><?php echo $grand_total > 0 ? $grand_total : "x"; ?></td>
                    <td><b>100.00%</b></td>
                </tr>
            </tbody>
        </table>
    </div>  
</body>
</html>