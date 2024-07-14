<div class="wrap">
    <h2>AISurveys Settings</h2>
    <p>This plugin uses Google artificial intelligence (GEMINI) to take a survey and gives you recomendations based on question and configuration in admin view</p>
    <form method="post" action="" id="survey_form">
        <?php wp_nonce_field('aic_surveys_settings_nonce', 'aic_surveys_nonce');?>
        <label for="api_key"><h3>GEMINI API Key:</h3></label>
        <input type="password" id="api_key" name="api_key" value="<?php echo esc_attr($api_key); ?>" required><br>
        <p>You can get one for free <a href="https://ai.google.dev/gemini-api/docs/api-key" target="_blank">here</a></p>
            <label for="purpose"><h3>Purpose:</h3></label>
        <p>This is the purpose of your survey, remember that it must be coherent according to the questions you define</p>
        <input type="text" id="purpose" name="purpose" value="<?php echo esc_attr($purpose); ?>" required><br>
        <br><br>
        <h3>Survey configuration:</h3>
        <p>In this section, you can configure the questions that will be displayed in the form. This form will be displayed using a WordPress shortcode: <b>aisurveys_form</b></p>
        <label for="questions"> <h4> Add a Question to the form: </h4></label>
        <button id="add_question">Add</button>
        <div id="question_list">
            <?php
foreach ($questions as $question) {
    echo '<p><input type="checkbox" name="deleted_questions[]" value="' . $question . '"> ' . $question . '</p>';
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
            e.preventDefault();
            $("#question_list").append('<p><input type="text" name="questions[]" placeholder="Enter your question"> <input type="checkbox" name="deleted_questions[]" value="" > Mark for deletion</p>');
        });
    });
</script>
