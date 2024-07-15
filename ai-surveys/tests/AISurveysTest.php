<?php

require_once dirname(__DIR__) . '/includes/class-ai-surveys.php';

if (!function_exists('plugin_dir_path')) {
    function plugin_dir_path($file)
    {
        return trailingslashit(dirname($file));
    }
}

if (!function_exists('trailingslashit')) {
    function trailingslashit($string)
    {
        return rtrim($string, '/') . '/';
    }
}

if (!function_exists('add_action')) {
    function add_action($hook, $callback, $priority = 10, $args = 1)
    {
        // Mock implementation of add_action - You can customize this based on your needs
        // For testing purposes, you can log the action being added or perform other test-specific actions
        return "Added action: $hook\n";
    }
}

if (!function_exists('add_shortcode')) {
    function add_shortcode($tag, $callback)
    {
        // Mock implementation for add_shortcode
        return "Added shortcode: [$tag]\n"; // Example mock behavior
    }
}

if (!function_exists('has_action')) {
    function has_action($hook_name, $callback = false) {
        // Mock implementation for has_action
        // Aquí puedes definir la lógica del mock según tus necesidades de prueba
        // En este ejemplo, siempre devolvemos true como si existiera una acción
        return true; 
    }
}

if (!function_exists('has_shortcode')) {
    function has_shortcode($content, $tag = '') {
        // Mock implementation for has_shortcode
        // Aquí puedes definir la lógica del mock según tus necesidades de prueba
        // En este ejemplo, simulamos que siempre existe el shortcode con el tag especificado
        return true; 
    }
}



use PHPUnit\Framework\TestCase;

class AISurveysTest extends TestCase
{
    /**
     *  @covers AISurveys::createInstance
     */
    public function testCreateInstance()
    {
        $instance = AISurveys::createInstance();
        $this->assertInstanceOf(AISurveys::class, $instance);
    }
    /**
     *  @covers AISurveys::instance
     */
    public function testInstance()
    {
        $instance1 = AISurveys::instance();
        $instance2 = AISurveys::instance();

        $this->assertSame($instance1, $instance2);
    }
    /**
     * @covers AISurveys::includes
     */
    public function testIncludes()
    {
        $this->expectOutputString('');

        $instance = AISurveys::createInstance();

        $this->assertFileExists(plugin_dir_path(__DIR__) . 'includes/class-ai-surveys-settings.php');
        $this->assertFileExists(plugin_dir_path(__DIR__) . 'includes/class-ai-surveys-api.php');
    }
    /**
     * @covers AISurveys::init_hooks
     */
    public function testInitHooks()
    {
        $this->expectOutputString('');

        $instance = AISurveys::createInstance();

        // Verificar que las acciones se han agregado correctamente
        $this->assertTrue(has_action('admin_menu', [AISurveys_Settings::class, 'add_menu_page']));
        $this->assertTrue(has_shortcode('aisurveys_form'));

        // Verificar que las acciones de formularios se han agregado correctamente
        $this->assertTrue(has_action('admin_post_aisurveys_submit_form', [AISurveys_API::class, 'aisurveys_handle_form_submission']));
        $this->assertTrue(has_action('admin_post_nopriv_aisurveys_submit_form', [AISurveys_API::class, 'aisurveys_handle_form_submission']));
    }
}
