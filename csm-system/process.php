<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Insert CC Awareness Data
    $question = $_POST['question'];
    $responses = $_POST['responses'];
    $percentage = $_POST['percentage'];

    $stmt = $conn->prepare("INSERT INTO cc_awareness (question, responses, percentage) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $question, $responses, $percentage);
    $stmt->execute();

    // Insert Service Quality Data
    $dimension = $_POST['dimension'];
    $strongly_agree = $_POST['strongly_agree'];
    $agree = $_POST['agree'];
    $neutral = $_POST['neutral'];
    $disagree = $_POST['disagree'];
    $strongly_disagree = $_POST['strongly_disagree'];
    $na = 0;  // Default for NA
    $total_responses = $_POST['total_responses'];
    $overall = $_POST['overall'];

    $stmt = $conn->prepare("INSERT INTO service_quality (dimension, strongly_agree, agree, neutral, disagree, strongly_disagree, na, total_responses, overall) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siiiiiiid", $dimension, $strongly_agree, $agree, $neutral, $disagree, $strongly_disagree, $na, $total_responses, $overall);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>
