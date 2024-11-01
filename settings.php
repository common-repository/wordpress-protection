<?php
global $wpdb, $EDSITE;
define('WPL_BASIC_WEB_HOME_PAGE_NAME_SHORT', 'eDarpan');
define('WPL_BASIC_FULL_NAME', 'WordPress Protection');
define('WPL_BASIC_WEB_HOME_PAGE_NAME', WPL_BASIC_WEB_HOME_PAGE_NAME_SHORT . '.com');
define('WPL_BASIC_FULL_HOME_PAGE_LINK', 'http://www.' . strtolower(WPL_BASIC_WEB_HOME_PAGE_NAME) . '/');
define('WPL_BASIC_URL_NAME', str_replace(' ', '-', strtolower(WPL_BASIC_FULL_NAME)));
define('WPL_BASIC_FULL_PAGE_LINK', strtolower(WPL_BASIC_FULL_HOME_PAGE_LINK) . 'pages/' . WPL_BASIC_URL_NAME);
define('WPL_BASIC_FULL_NAME_PRO', 'Professional '.WPL_BASIC_FULL_NAME . '');
define('WPL_BASIC_FULL_NAME_HEADING', WPL_BASIC_FULL_NAME . ' Lite');
define('WPL_BASIC_SHORT_NAME', WPL_BASIC_FULL_NAME);
define('WPL_BASIC_TABLE_NAME', strtolower(WPL_BASIC_WEB_HOME_PAGE_NAME_SHORT) . '_' . str_replace(' ', '_', strtolower(WPL_BASIC_FULL_NAME)));
define('WPL_BASIC_TABLE_NAME_OPTIONS', WPL_BASIC_TABLE_NAME . "_options");
define('WPL_BASIC_BASE', get_bloginfo('wpurl')."/wp-content/plugins/".basename(dirname(__FILE__)));
define('WPL_ADMIN_URL', get_admin_url()."options-general.php?page=".basename(dirname(__FILE__) . '.php'));
define('WPL_BASIC_ASSETS', WPL_BASIC_BASE . '/assets');
define('WPL_BASIC_DB_VERSION', '8');
define('WPL_BASIC_SUPPORT_EMAIL', 'support@' . strtolower(WPL_BASIC_WEB_HOME_PAGE_NAME));
define('WPL_BASIC_FACEBOOK_LINK', "https://www.facebook.com/" . WPL_BASIC_WEB_HOME_PAGE_NAME_SHORT);
define('WPL_BASIC_TWITTER_LINK', 'https://twitter.com/' . WPL_BASIC_WEB_HOME_PAGE_NAME_SHORT);
define('WPL_BASIC_ATTRIB', '<center><font style="font-size:12px;">Website is Protected by <a href="' . WPL_BASIC_FULL_PAGE_LINK . '" target="_blank">' . WPL_BASIC_FULL_NAME . '</a> from <a href="' . WPL_BASIC_FULL_HOME_PAGE_LINK . '" target="_blank">' . WPL_BASIC_WEB_HOME_PAGE_NAME . '</a>.</font></center><br />');

$EDSITE = array();
$EDSITE['WWW_SITE_URL'] = get_bloginfo('wpurl').'/';
$EDSITE['DIR_SITE_URL'] = ABSPATH;
$EDSITE['WWW_PLUGIN_BASE_URL']['WPL'] = $EDSITE['WWW_SITE_URL']."wp-content/plugins/".basename(dirname(__FILE__)).'/';
$EDSITE['DIR_PLUGIN_BASE_URL']['WPL'] = $EDSITE['DIR_SITE_URL']."wp-content/plugins/".basename(dirname(__FILE__)).'/';


?>