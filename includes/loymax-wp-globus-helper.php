<?php

/**
 * Класс длдя работы с плагином Wp_Globus
 */
class LoymaxWebApp_Wp_Globus_helper {
    private $is_wpglobus_active;

    public function __construct() {
        if (!function_exists('get_plugins')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }
        $this->is_wpglobus_active = false;
        if ( class_exists( 'WPGlobus' ) ) {
            $wpglobus_dir_name = wp_basename( WPGlobus::$PLUGIN_DIR_PATH );
            $this->is_wpglobus_active = is_plugin_active( $wpglobus_dir_name . '/' . array_keys( get_plugins( '/' . $wpglobus_dir_name ) )[0] );
        }
    }

    /**
     * Получает активирован ли плагин Wp_Globus
     * @return bool
     */
    public function get_is_wpglobus_active() {
        return $this->is_wpglobus_active;
    }

    /**
     * Подключает скрипт, необходимый для работы LoymaxApp с плагином Wp_Globus
     */
    public function add_inline_script() {
        wp_add_inline_script(
            'loymax-app',
            '
                        var wpGlobusLanguage = "' . WPGlobus::Config()->language . '".toLowerCase();
                        var wpGlobusLanguageLocale = "' . WPGlobus::Config()->locale[WPGlobus::Config()->language] . '".toLowerCase();
                        var locale = wpGlobusLanguageLocale.match(new RegExp("^" + wpGlobusLanguage + "([-_]|$)")) ?
                            wpGlobusLanguage :
                            wpGlobusLanguageLocale;
                        localStorage.setItem("ls.locale", locale);
                    ',
            'before'
        );
    }
}
