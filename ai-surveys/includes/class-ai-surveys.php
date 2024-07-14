<?php

class AISurveys
{

    private static $instance = null;

    private function __construct()
    {
        $this->includes();
        $this->init_hooks();
    }

    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function includes()
    {
        require_once plugin_dir_path(__FILE__) . 'class-ai-surveys-settings.php';
        require_once plugin_dir_path(__FILE__) . 'class-ai-surveys-api.php';
    }

    private function init_hooks()
    {
        add_action('admin_menu', [AISurveys_Settings::class, 'add_menu_page']);
        add_shortcode('aisurveys_form', [AISurveys_Settings::class, 'render_form_shortcode']);
        add_action('admin_post_aisurveys_submit_form', [AISurveys_API::class, 'aisurveys_handle_form_submission']);
        add_action('admin_post_nopriv_aisurveys_submit_form', [AISurveys_API::class, 'aisurveys_handle_form_submission']);
    }
}
