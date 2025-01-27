<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input CSM Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="container mt-4">
    <h1>Input CSM Results</h1>
    <form action="process.php" method="POST" class="mt-4">
        <h3>Citizen's Charter Awareness</h3>
        <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <input type="text" class="form-control" name="question" required>
        </div>
        <div class="mb-3">
            <label for="responses" class="form-label">Responses</label>
            <input type="number" class="form-control" name="responses" required>
        </div>
        <div class="mb-3">
            <label for="percentage" class="form-label">Percentage (%)</label>
            <input type="number" step="0.01" class="form-control" name="percentage" required>
        </div>

        <h3>Service Quality Dimensions</h3>
        <div class="mb-3">
            <label for="dimension" class="form-label">Dimension</label>
            <input type="text" class="form-control" name="dimension" required>
        </div>
        <div class="row">
            <div class="col">
                <label>Strongly Agree</label>
                <input type="number" class="form-control" name="strongly_agree" required>
            </div>
            <div class="col">
                <label>Agree</label>
                <input type="number" class="form-control" name="agree" required>
            </div>
            <div class="col">
                <label>Neutral</label>
                <input type="number" class="form-control" name="neutral" required>
            </div>
            <div class="col">
                <label>Disagree</label>
                <input type="number" class="form-control" name="disagree" required>
            </div>
            <div class="col">
                <label>Strongly Disagree</label>
                <input type="number" class="form-control" name="strongly_disagree" required>
            </div>
        </div>
        <div class="mb-3 mt-3">
            <label for="total_responses" class="form-label">Total Responses</label>
            <input type="number" class="form-control" name="total_responses" required>
        </div>
        <div class="mb-3">
            <label for="overall" class="form-label">Overall Percentage (%)</label>
            <input type="number" step="0.01" class="form-control" name="overall" required>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</body>
</html>
