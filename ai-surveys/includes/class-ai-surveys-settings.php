<?php

class AISurveys_Settings
{

    public static function add_menu_page()
    {
        add_menu_page(
            'AISurveys Settings',
            'AISurveys',
            'manage_options',
            'AISurveys-settings',
            [self::class, 'settings_page']
        );
    }

    public static function settings_page()
{
    if (isset($_POST['submit'])) {
        if (isset($_POST['aic_surveys_nonce']) && wp_verify_nonce($_POST['aic_surveys_nonce'], 'aic_surveys_settings_nonce')) {
            // Procesar los datos del formulario
            update_option('AISurveys_api_key', sanitize_text_field($_POST['api_key']));
            update_option('AISurveys_purpose', sanitize_text_field($_POST['purpose']));
            // Obtener preguntas existentes
            $questions = get_option('AISurveys_questions', array());

            // Obtener nuevas preguntas del formulario
            $new_questions = isset($_POST['questions']) ? $_POST['questions'] : array();

            // Obtener las preguntas marcadas para eliminación
            $deleted_questions = isset($_POST['deleted_questions']) ? $_POST['deleted_questions'] : array();

            // Marcar las preguntas a eliminar en un array
            $questions_to_delete = array_intersect($questions, $deleted_questions);

            // Eliminar las preguntas marcadas para eliminación
            foreach ($questions_to_delete as $deleted_question) {
                $question_key = array_search($deleted_question, $questions);
                if ($question_key !== false) {
                    unset($questions[$question_key]);
                }
            }

            // Combinar preguntas existentes con las nuevas preguntas
            $questions = array_merge($questions, $new_questions);

            // Guardar todas las preguntas actualizadas
            update_option('AISurveys_questions', $questions);
        }
    }

    $api_key = get_option('AISurveys_api_key', '');
    $purpose = get_option( 'AISurveys_purpose', '' );
    $questions = get_option('AISurveys_questions', array());

    // Mostrar formulario y preguntas en la página de administración
    include plugin_dir_path(__FILE__) . 'settings-page.php';
}


    public static function render_form_shortcode()
    {
        ob_start();
        include plugin_dir_path(__FILE__) . 'shortcode-form.php';
        return ob_get_clean();
    }

}
