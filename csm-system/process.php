<?php
include 'db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Escape and sanitize form data
    $survey_date = $conn->real_escape_string($_POST['survey_date']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $age = $conn->real_escape_string($_POST['age']);
    $cc1 = $conn->real_escape_string($_POST['cc1']);
    $cc2 = $conn->real_escape_string($_POST['cc2']);
    $cc3 = $conn->real_escape_string($_POST['cc3']);

    // Escape levels (responses) for service_quality
    $sqd0 = $conn->real_escape_string($_POST['sqd0']);
    $responsiveness = $conn->real_escape_string($_POST['responsiveness']);
    $reliability = $conn->real_escape_string($_POST['reliability']);
    $access = $conn->real_escape_string($_POST['access']);
    $communication = $conn->real_escape_string($_POST['communication']);
    $costs = $conn->real_escape_string($_POST['costs']);
    $integrity = $conn->real_escape_string($_POST['integrity']);
    $assurance = $conn->real_escape_string($_POST['assurance']);
    $outcome = $conn->real_escape_string($_POST['outcome']);

    // Insert data into demographics table
    $age_group = $conn->real_escape_string(getAgeGroup($age)); // Convert age into an age group
    $demographicSql = "INSERT INTO demographics (age_group, gender, survey_date) VALUES ('$age_group', '$gender', '$survey_date')";
    
    if (!$conn->query($demographicSql)) {
        echo "Error inserting demographic data: " . $conn->error;
        exit();
    }
    $demographic_id = $conn->insert_id; // Get the last inserted ID for demographics

    // Insert data into cc_awareness table
    $questions = [
        "CC1" => $cc1,
        "CC2" => $cc2,
        "CC3" => $cc3
    ];

    foreach ($questions as $question => $response) {
        $question = $conn->real_escape_string($question);
        $response = $conn->real_escape_string($response);
        $ccSql = "INSERT INTO cc_awareness (question, responses, demographic_id) VALUES ('$question', '$response', '$demographic_id')";
        if (!$conn->query($ccSql)) {
            echo "Error inserting CC awareness data: " . $conn->error;
            exit();
        }
    }

    // Insert data into service_quality table (mirroring the cc_awareness process)
    $serviceQuestions = [
        "SQD0" => $sqd0,
        "Responsiveness" => $responsiveness,
        "Reliability" => $reliability,
        "Access and Facilities" => $access,
        "Communication" => $communication,
        "Costs" => $costs,
        "Integrity" => $integrity,
        "Assurance" => $assurance,
        "Outcome" => $outcome
    ];

    foreach ($serviceQuestions as $dimension => $level) {
        $dimension = $conn->real_escape_string($dimension); // Escape dimension
        $level = $conn->real_escape_string($level); // Escape level
        $serviceSql = "INSERT INTO service_quality (dimension, level, demographic_id) VALUES ('$dimension', '$level', '$demographic_id')";
        if (!$conn->query($serviceSql)) {
            echo "Error inserting Service Quality data: " . $conn->error;
            exit();
        }
    }

    // If everything is successful, redirect to a success page or display a success message
    echo "Data saved successfully!";
    header("Location: home.php");
    exit; 
} else {
    echo "Invalid request method.";
}

// Function to group ages into predefined age groups
function getAgeGroup($age) {
    if ($age < 18) {
        return "Under 18";
    } elseif ($age >= 18 && $age <= 24) {
        return "18-24";
    } elseif ($age >= 25 && $age <= 34) {
        return "25-34";
    } elseif ($age >= 35 && $age <= 44) {
        return "35-44";
    } elseif ($age >= 45 && $age <= 54) {
        return "45-54";
    } elseif ($age >= 55 && $age <= 64) {
        return "55-64";
    } else {
        return "65 and over";
    }
}
?>
