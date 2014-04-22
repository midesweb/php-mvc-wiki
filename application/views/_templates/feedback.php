<?php

// get the feedback (they are arrays, to make multiple positive/negative messages possible)
$feedback_positive = isset($_SESSION['feedback_positive'])? $_SESSION['feedback_positive'] : null;
$feedback_negative = isset($_SESSION['feedback_negative'])? $_SESSION['feedback_negative'] : null;

// echo out positive messages
if (isset($feedback_positive)) {
    foreach ($feedback_positive as $feedback) {
        echo '<div class="success">'.$feedback.'</div>';
    }
}

// echo out negative messages
if (isset($feedback_negative)) {
    foreach ($feedback_negative as $feedback) {
        echo '<div class="error">'.$feedback.'</div>';
    }
}