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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#csmModal">
            Add CSM Results
        </button>

        <!-- Bootstrap Modal for CSM Results -->
        <div class="modal fade" id="csmModal" tabindex="-1" aria-labelledby="csmModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="csmModalLabel">Add CSM Results</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="save_results.php">
                        <div class="modal-body">
                            <!-- Input fields for CSM Results -->
                            <div class="mb-3">
                                <label for="response1" class="form-label">Response 1</label>
                                <input type="text" class="form-control" id="response1" name="response1" required>
                            </div>
                            <div class="mb-3">
                                <label for="response2" class="form-label">Response 2</label>
                                <input type="text" class="form-control" id="response2" name="response2" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- Inline small buttons with custom colors -->
                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal" style="width: 80px;">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success" style="width: 80px;">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <h3>Citizen's Charter Awareness</h3>
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
