<div class="wrap">
    <h2>AISurveys Settings</h2>

    <form method="post" action="">
        <?php wp_nonce_field('aic_surveys_settings_nonce', 'aic_surveys_nonce'); ?>
        <label for="api_key"><h3>GEMINI API Key:</h3></label>
        <input type="password" id="api_key" name="api_key" value="<?php echo esc_attr($api_key); ?>" required><br>
        <br><br>
        <label for="questions">Add a Question to the form :</label>        
        <button id="add_question">Add</button>
        <div id="question_list">
            <?php
            foreach ($questions as $question) {
                echo '<p>' . $question . '</p>';
            }
            ?>
        </div>

        <input type="submit" name="submit" value="Submit">
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $("#add_question").on("click", function(e) {
        e.preventDefault()
        $("#question_list").append('<p><input type="text" name="questions[]" placeholder="Enter your question"></p>');
    });
});
</script>
