<?php
include 'db.php';

// Fetch age group distribution
$ageQuery = "SELECT age_group, COUNT(*) as total FROM demographics GROUP BY age_group";
$ageStmt = $conn->prepare($ageQuery);
$ageStmt->execute();
$ageResult = $ageStmt->get_result();
$ageResults = $ageResult->fetch_all(MYSQLI_ASSOC);

// Fetch gender distribution
$genderQuery = "SELECT gender, COUNT(*) as total FROM demographics GROUP BY gender";
$genderStmt = $conn->prepare($genderQuery);
$genderStmt->execute();
$genderResult = $genderStmt->get_result();
$genderResults = $genderResult->fetch_all(MYSQLI_ASSOC);

// Calculate totals for percentage calculations
$totalQuery = "SELECT COUNT(*) as grand_total FROM demographics";
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
$genderData = [];
foreach ($genderResults as $row) {
    $gender = $row['gender'];
    $total = $row['total'];
    $genderData[$gender] = $total;
}

// Fetch Data
$cc_data = $conn->query("SELECT * FROM cc_awareness");
$service_data = $conn->query("SELECT * FROM service_quality");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM Report</title>
    <link rel="website icon" type="png" href="logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles.css">

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
   
</head>
<body>
    <div class="container mt-4">
        <h1>CSM Consolidated Report</h1>

        <!-- Demographics Section -->
        <div class="mb-4 p-4 bg-light rounded">
            <h2>Demographic Distribution</h2>

            <!-- Age Group Distribution -->
            <h4>Age Group Distribution</h4>
            <table>
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
            <table>
                <thead>
                    <tr>
                        <th>Gender</th>
                        <th>Percentage (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($genderData)): ?>
                        <?php foreach ($genderData as $gender => $total): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($gender); ?></td>
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
        </div>
        
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
                <!-- Row 1 (Make it thicker) -->
                <tr class="thicker-row">
                    <td><b>CC1.</b> Which of the following describes your awareness of the CC?</td>
                    <td></td>
                    <td></td>
                </tr>
                <!-- Row 2 -->
                <tr>
                    <td><b>1.</b> I know what a CC is and I saw this office's CC.</td>
                    <td>x</td>
                    <td>yy.yy%</td>
                </tr>
                <!-- Row 3 -->
                <tr>
                    <td><b>2.</b> I know what a CC is but I did not see this office's CC.</td>
                    <td>x</td>
                    <td>yy.yy%</td>
                </tr>
                <!-- Row 4 -->
                <tr>
                    <td><b>3.</b> I learned of the CC only when I saw this office's CC.</td>
                    <td>x</td>
                    <td>yy.yy%</td>
                </tr>
                <!-- Row 5 -->
                <tr>
                    <td><b>4.</b> I do not know what a CC is and I did not see this office's CC.</td>
                    <td>x</td>
                    <td>yy.yy%</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <!-- CC2 -->
                <tr class="thicker-row">
                    <td><b>CC2.</b> If aware of CC, would you say that the CC of this was...?</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b>1.</b> Easy to see</td>
                    <td>x</td>
                    <td>yy.yy%</td>
                </tr>
                <!-- Row 3 -->
                <tr>
                    <td><b>2.</b> Somewhat easy to see</td>
                    <td>x</td>
                    <td>yy.yy%</td>
                </tr>
                <!-- Row 4 -->
                <tr>
                    <td><b>3.</b> Difficult to see</td>
                    <td>x</td>
                    <td>yy.yy%</td>
                </tr>
                <!-- Row 5 -->
                <tr>
                    <td><b>4.</b> Not visible at all</td>
                    <td>x</td>
                    <td>yy.yy%</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                 <!-- CC3 -->
                 <tr class="thicker-row">
                    <td><b>CC3.</b> If aware of CC, how much did the CC help you in your transaction?</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b>1.</b> Helped very much</td>
                    <td>x</td>
                    <td>yy.yy%</td>
                </tr>
                <!-- Row 3 -->
                <tr>
                    <td><b>2.</b> Somewhat helped</td>
                    <td>x</td>
                    <td>yy.yy%</td>
                </tr>
                <!-- Row 4 -->
                <tr>
                    <td><b>3.</b> Did not help</td>
                    <td>x</td>
                    <td>yy.yy%</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>


            <tbody>
                <?php while ($row = $cc_data->fetch_assoc()): ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3>Service Quality Dimensions</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Service Quality Dimensions</th>
                    <th>Strongly Agree</th>
                    <th>Agree</th>
                    <th>Neither Agree nor Disagree</th>
                    <th>Disagree</th>
                    <th>Strongly Disagree</th>
                    <th>N/A</th>
                    <th>Total Responses</th>
                    <th>Overall (%)</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                    <td>Responsiveness</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>yy.yy%</td>
                </tr>
                <tr>
                    <td>Reliability</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>yy.yy%</td>
                </tr>
                <tr>
                    <td>Access and Facilities</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>yy.yy%</td>
                </tr>
                <tr>
                    <td>Communication</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>yy.yy%</td>
                </tr>
                <tr>
                    <td>Costs</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>yy.yy%</td>
                </tr>
                <tr>
                    <td>Integrity</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>yy.yy%</td>
                </tr>
                <tr>
                    <td>Assurance</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>yy.yy%</td>
                </tr>
                <tr>
                    <td>Outcome</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>yy.yy%</td>
                </tr>
                <tr>
                    <td>Overall</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>yy.yy%</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>

            </tbody>
            <tbody>
                <?php while ($row = $service_data->fetch_assoc()): ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>