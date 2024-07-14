<div class="aisurveys-form">
    <h2>AISurveys Form</h2>
    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
        <?php wp_nonce_field('aisurveys_submit_form', 'aisurveys_nonce'); ?>
        <?php
        $questions = get_option('AISurveys_questions', array());
        foreach ($questions as $question) {
            echo '<label for="'.esc_attr($question).'"><p>' . esc_html($question) . '</p></label>';
            echo '<input type="text" name="questions['.esc_attr($question).']" required/>';
        }
        ?>
        <br><br>

        <input type="hidden" name="action" value="aisurveys_submit_form">
        <input type="submit" name="submit" value="Submit">
    </form>
</div>
