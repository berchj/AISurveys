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

            // Obtener preguntas existentes
            $questions = get_option('AISurveys_questions', array());

            // Obtener nuevas preguntas del formulario
            $new_questions = isset($_POST['questions']) ? $_POST['questions'] : array();

            // Combinar preguntas existentes con las nuevas preguntas
            $questions = array_merge($questions, $new_questions);

            // Guardar todas las preguntas
            update_option('AISurveys_questions', $questions);
        }
    }

    $api_key = get_option('AISurveys_api_key', '');
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
