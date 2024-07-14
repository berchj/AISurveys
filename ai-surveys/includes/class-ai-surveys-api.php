<?php

class AISurveys_API
{
    public static function call($question, $api_key ,$questions, $purpose)
    {
        // URL para la llamada API
        $url = 'https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=' . $api_key;
        $prompt = "based on these questions Using this JSON schema :{'title': str,'content':str} (Return only the JSON String without spaces)";
        // Argumentos de la solicitud
        $args = array(
            'timeout' => 60,
            'body' => wp_json_encode(array(
                "contents" => array(
                    array(
                        "parts" => array(
                            array(
                                "text" => $prompt,
                            ),
                        ),
                    ),
                ),
            )),
            'headers' => array(
                'Content-Type' => 'application/json',
            ),
            'method' => 'POST',
        );

        // Respuesta
        $response = wp_remote_post($url, $args);

        // Si algo sale mal
        if (is_wp_error($response)) {
            return new WP_Error('api_error', $response->get_error_message());
        }

        // Recuperar cuerpo
        $body = wp_remote_retrieve_body($response);

        // Formatear datos
        if (empty($body)) {
            return new WP_Error('api_error', 'Empty response from API.');
        }

        $data = json_decode($body, true);

        if (!isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            return new WP_Error('api_error', 'Invalid API response structure.');
        }

        // AI Post
        $article = json_decode($data['candidates'][0]['content']['parts'][0]['text'], true);

        if (!isset($article['title']) || !isset($article['content'])) {
            return new WP_Error('api_error', 'API response does not contain title or content.');
        }
        
        echo print_r($article);
    }

    public static function aisurveys_handle_form_submission()
    {
        // Verificar nonce
        if (!isset($_POST['aisurveys_nonce']) || !wp_verify_nonce($_POST['aisurveys_nonce'], 'aisurveys_submit_form')) {
            wp_die('Nonce verification failed.');
        }

        // Imprimir todo el $_POST para depuración
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';

        // Recoger datos del formulario
        if (!isset($_POST['questions']) || !is_array($_POST['questions'])) {
            wp_die('Form data is missing or invalid.');
        }

        $responses = array_map('sanitize_text_field', $_POST['questions']);

        
        $api_key = get_option('AISurveys_api_key', '');

        // Llamar a la función para hacer la petición HTTP
        $question_text = 'Aquí puedes incluir el formato que deseas. Ejemplo: "Responde las siguientes preguntas: ' . json_encode($responses) . '"';

        $result = self::call($question_text, $api_key);

        if (is_wp_error($result)) {
            wp_die('API Error: ' . $result->get_error_message());
        }

        
    }
}
