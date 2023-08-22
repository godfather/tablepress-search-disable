<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://14bits.com.br
 * @since             1.0.0
 * @package           TablepressSearchDisable
 *
 * @wordpress-plugin
 * Plugin Name:       Tablepress Search disable
 * Plugin URI:        https://14bits.com.br
 * Description:       Desabilita a busca feita nos posts gerados pelo plugin TablePress melhorando o desempenho da busca.
 * Version:           1.0.0
 * Author:            Santiago Carmo
 * Author URI:        https://14bits.com.br
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tablepress-search-disable
 * Domain Path:       /
 */

namespace TablepressSearchDisable;

require_once ABSPATH . 'wp-admin/install-helper.php';

defined( 'ABSPATH' ) || exit;

if (!defined( 'TABLEPRESS_SEARCH_DISABLE_FILE')) define( 'TABLEPRESS_SEARCH_DISABLE_FILE', __FILE__ );

class TablepressSearchDisable {
    const PASTEUR_PLUGIN_VERSION = '1.0.0';
    const DB_OPTION_PLUGIN_VERSION = 'tablepress-search-disable-plugin-version';

    public function __construct() {
        register_activation_hook(TABLEPRESS_SEARCH_DISABLE_FILE , [$this, 'activePlugin']);

        add_action('plugins_loaded', [$this, 'updatePlugin']);

        add_filter( 'tablepress_wp_search_integration', '__return_false' );
    }

    public function activePlugin() {
        return;        
    }

    public function updatePlugin() {
        $currentInstalledVersion = get_option(self::DB_OPTION_PLUGIN_VERSION);
        
        if(self::PASTEUR_PLUGIN_VERSION !== $currentInstalledVersion) {
            update_option(self::DB_OPTION_PLUGIN_VERSION, self::PASTEUR_PLUGIN_VERSION);
        }
    }
}

$tablepressSearchDisable = new TablepressSearchDisable();



