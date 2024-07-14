<div class="aisurveys-form">
    <h2>AISurveys Form</h2>
    <?php
    $questions = get_option('AISurveys_questions', array());
    foreach ($questions as $question) {
        echo '<p>' . $question . '</p>';
    }
    ?>
</div>