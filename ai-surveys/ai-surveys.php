<?php
/**
 * Plugin Name:       AI Surveys
 * Description:       Surveys based on AI configurable form
 * Version:           1.0.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Julio Bermúdez
 * Author URI:        https://github.com/berchj/
 * Plugin URI:        https://github.com/berchj/AISurveys
 * License:           GPLv2 or later.
 */

defined('ABSPATH') || exit;

require_once plugin_dir_path(__FILE__) . 'includes/class-ai-surveys.php';

AISurveys::instance();
