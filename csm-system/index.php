<?php
include 'db.php';

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
</head>
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
                    <form method="POST" action="save_results.php">
                        <div class="modal-body">
                            <!-- Citizen's Charter Questions Section -->
                            <div class="border rounded p-3 mb-4 shadow-sm">
                                <h6 class="text-primary">Citizen's Charter Questions</h6>
                                <div class="mb-3">
                                    <label class="form-label">CC1. Which of the following describes your awareness of the CC?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cc1" value="I know what a CC is and I saw this office's CC" required>
                                        <label class="form-check-label">I know what a CC is and I saw this office's CC</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cc1" value="I know what a CC is but I did not see this office's CC">
                                        <label class="form-check-label">I know what a CC is but I did not see this office's CC</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cc1" value="I learned of the CC only when I saw this office's CC">
                                        <label class="form-check-label">I learned of the CC only when I saw this office's CC</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cc1" value="I do not know what a CC is and I did not see this office's CC">
                                        <label class="form-check-label">I do not know what a CC is and I did not see this office's CC</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">CC2. If aware of CC, would you say that the CC of this office was...?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cc2" value="Easy to see" required>
                                        <label class="form-check-label">Easy to see</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cc2" value="Somewhat easy to see">
                                        <label class="form-check-label">Somewhat easy to see</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cc2" value="Difficult to see">
                                        <label class="form-check-label">Difficult to see</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cc2" value="Not visible at all">
                                        <label class="form-check-label">Not visible at all</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">CC3. If aware of CC, how much did the CC help you in your transaction?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cc3" value="Helped very much" required>
                                        <label class="form-check-label">Helped very much</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cc3" value="Somewhat helped">
                                        <label class="form-check-label">Somewhat helped</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cc3" value="Did not help">
                                        <label class="form-check-label">Did not help</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Service Quality Dimensions Section -->
                            <div class="border rounded p-3 shadow-sm">
                                <h6 class="text-primary">Service Quality Dimensions</h6>
                                <div class="mb-3">
                                    <label class="form-label">SQD1: Responsiveness</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="responsiveness" value="Strongly Agree" required>
                                        <label class="form-check-label">Strongly Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="responsiveness" value="Agree">
                                        <label class="form-check-label">Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="responsiveness" value="Neither Agree nor Disagree">
                                        <label class="form-check-label">Neither Agree nor Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="responsiveness" value="Disagree">
                                        <label class="form-check-label">Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="responsiveness" value="Strongly Disagree">
                                        <label class="form-check-label">Strongly Disagree</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">SQD2: Reliability</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="reliability" value="Strongly Agree" required>
                                        <label class="form-check-label">Strongly Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="reliability" value="Agree">
                                        <label class="form-check-label">Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="reliability" value="Neither Agree nor Disagree">
                                        <label class="form-check-label">Neither Agree nor Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="reliability" value="Disagree">
                                        <label class="form-check-label">Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="reliability" value="Strongly Disagree">
                                        <label class="form-check-label">Strongly Disagree</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">SQD3: Access and Facilities</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="access" value="Strongly Agree" required>
                                        <label class="form-check-label">Strongly Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="access" value="Agree">
                                        <label class="form-check-label">Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="access" value="Neither Agree nor Disagree">
                                        <label class="form-check-label">Neither Agree nor Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="access" value="Disagree">
                                        <label class="form-check-label">Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="access" value="Strongly Disagree">
                                        <label class="form-check-label">Strongly Disagree</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">SQD4: Communication</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="communication" value="Strongly Agree" required>
                                        <label class="form-check-label">Strongly Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="communication" value="Agree">
                                        <label class="form-check-label">Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="communication" value="Neither Agree nor Disagree">
                                        <label class="form-check-label">Neither Agree nor Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="communication" value="Disagree">
                                        <label class="form-check-label">Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="communication" value="Strongly Disagree">
                                        <label class="form-check-label">Strongly Disagree</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">SQD5: Costs</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="costs" value="Strongly Agree" required>
                                        <label class="form-check-label">Strongly Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="costs" value="Agree">
                                        <label class="form-check-label">Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="costs" value="Neither Agree nor Disagree">
                                        <label class="form-check-label">Neither Agree nor Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="costs" value="Disagree">
                                        <label class="form-check-label">Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="costs" value="Strongly Disagree">
                                        <label class="form-check-label">Strongly Disagree</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">SQD6: Integrity</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="integrity" value="Strongly Agree" required>
                                        <label class="form-check-label">Strongly Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="integrity" value="Agree">
                                        <label class="form-check-label">Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="integrity" value="Neither Agree nor Disagree">
                                        <label class="form-check-label">Neither Agree nor Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="integrity" value="Disagree">
                                        <label class="form-check-label">Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="integrity" value="Strongly Disagree">
                                        <label class="form-check-label">Strongly Disagree</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">SQD7: Assurance</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="assurance" value="Strongly Agree" required>
                                        <label class="form-check-label">Strongly Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="assurance" value="Agree">
                                        <label class="form-check-label">Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="assurance" value="Neither Agree nor Disagree">
                                        <label class="form-check-label">Neither Agree nor Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="assurance" value="Disagree">
                                        <label class="form-check-label">Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="assurance" value="Strongly Disagree">
                                        <label class="form-check-label">Strongly Disagree</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">SQD8: Outcome</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="outcome" value="Strongly Agree" required>
                                        <label class="form-check-label">Strongly Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="outcome" value="Agree">
                                        <label class="form-check-label">Agree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="outcome" value="Neither Agree nor Disagree">
                                        <label class="form-check-label">Neither Agree nor Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="outcome" value="Disagree">
                                        <label class="form-check-label">Disagree</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="outcome" value="Strongly Disagree">
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
                    <th>Question</th>
                    <th>Responses</th>
                    <th>Percentage (%)</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $cc_data->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['question'] ?></td>
                        <td><?= $row['responses'] ?></td>
                        <td><?= $row['percentage'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3>Service Quality Dimensions</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Dimension</th>
                    <th>Strongly Agree</th>
                    <th>Agree</th>
                    <th>Neutral</th>
                    <th>Disagree</th>
                    <th>Strongly Disagree</th>
                    <th>Total Responses</th>
                    <th>Overall (%)</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $service_data->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['dimension'] ?></td>
                        <td><?= $row['strongly_agree'] ?></td>
                        <td><?= $row['agree'] ?></td>
                        <td><?= $row['neutral'] ?></td>
                        <td><?= $row['disagree'] ?></td>
                        <td><?= $row['strongly_disagree'] ?></td>
                        <td><?= $row['total_responses'] ?></td>
                        <td><?= $row['overall'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
