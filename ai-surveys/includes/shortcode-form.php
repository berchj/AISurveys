<div class="aisurveys-form">
    <h2>AISurveys Form</h2>
    <form action="post">
    <?php
    $questions = get_option('AISurveys_questions', array());    
    foreach ($questions as $question) {
        echo '<label for="'.$question.'"><p>' . $question . '</p></label>';
        echo '<input type="text" name="'.$question.'"required/>';
    }
    ?>
    <br><br>
    
    <input type="submit" name="submit" value="submit">
    </form>
</div>