<?php
/**
 * LoymaxWebApp - uninstall script
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
//Ensure the uninstall.php file was only called by WordPress and not directly
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die();
}

global $wpdb;

if ( ! defined( 'LOYMAX_WEB_APP_CONFIGS_TABLE_NAME' ) ) {
    define( 'LOYMAX_WEB_APP_CONFIGS_TABLE_NAME', strval( $wpdb->prefix ) . 'loymax' );
}

if ( ! defined( 'LOYMAX_WEB_APP_COMPONENT_TABLE_NAME' ) ) {
    define( 'LOYMAX_WEB_APP_COMPONENT_TABLE_NAME', strval( $wpdb->prefix ) . 'loymax_components' );
}

$wpdb->query( "DROP TABLE IF EXISTS " . LOYMAX_WEB_APP_CONFIGS_TABLE_NAME );
$wpdb->query( "DROP TABLE IF EXISTS " . LOYMAX_WEB_APP_COMPONENT_TABLE_NAME );

/** Текущая версия данных плагина в БД */
delete_option( 'jal_db_version' );
/** Признак необходимости отображения сообщения помощника установки */
delete_option( 'loymax_install_wizard_in_progress' );
/** Идентификатор страницы ЛК */
delete_option( 'loymax_page_ID' );
/** Адрес страницы ЛК */
delete_option( 'loymax-page-link' );
/** Идентификатор меню для ЛК */
delete_option( 'loymax-navigation-menu-id' );
/** Признак необходимости отображения сообщения об ошибке удаления страницы ЛК */
delete_option( 'loymax_page_delete_prevented' );
/** Признак необходимости отображения сообщения об ошибке удаления меню для страницы ЛК */
delete_option( 'loymax_menu_delete_prevented' );
/** Название страницы ЛК */
delete_option( 'loymax-page-title' );
/** Объект, хранящий порядок отображения компонентов */
delete_option( 'loymax-component-order' );
/** Идентификатор пункта меню Личные данные */
delete_option( 'loymax-personal-menu-item-id' );
