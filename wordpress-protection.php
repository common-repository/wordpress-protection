<?php
/*
Plugin Name: WordPress Protection Lite
Plugin URI: http://www.edarpan.com/pages/wordpress-protection
Description: <strong>WordPress Protection Plugin</strong> provides complete security for your wordpress website, so that the plagiarists could not copy the content and steal data or images from your wordpress site Pages. By using the WordPress Protection Plugin (Basic), you can disable the text-selection, shortcuts like CTRL+C, CTRL+A, CTRL+X, CTRL+V and block the use of right click on your website. However, to apply full security to your wordpress website, you can purchase the <a href="http://www.edarpan.com/pages/wordpress-protection">Professional WordPress Protection</a> Plugin.
Version: 8
Author: eDarpan.com
Author URI: http://www.edarpan.com/

*************************************************************************

Copyright (C) 2017 eDarpan.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

*************************************************************************/

global $wpdb, $EDSITE;

require_once($EDSITE['DIR_PLUGIN_BASE_URL']['WPL'].'settings.php');

if(!function_exists('EDARPAN_ENQUEUE_SCRIPTS'))
{
	function EDARPAN_ENQUEUE_SCRIPTS()
	{
		wp_enqueue_script('jquery');
	}
}

if(!function_exists('EDARPAN_WPL_FETCH_CONFIGURATION'))
{
	function EDARPAN_WPL_FETCH_CONFIGURATION()
	{
		global $EDSITE;
		$EDSITE['VALUES']['DTS'] = get_option('WordPressProtection_DTS');
		$EDSITE['VALUES']['DKS'] = get_option('WordPressProtection_DKS');
		$EDSITE['VALUES']['DRC'] = get_option('WordPressProtection_DRC');
		$EDSITE['VALUES']['ATTR'] = get_option('WordPressProtection_ATTR');
		return $EDSITE;
	}
}

if(!function_exists('EDARPAN_WPL_SAVE_CONFIGURATION'))
{
	function EDARPAN_WPL_SAVE_CONFIGURATION($values)
	{
		global $EDSITE;
		@update_option('WordPressProtection_DTS', $values['WordPressProtection_DTS']);
		@update_option('WordPressProtection_DKS', $values['WordPressProtection_DKS']);
		@update_option('WordPressProtection_DRC', $values['WordPressProtection_DRC']);
		@update_option('WordPressProtection_ATTR', $values['WordPressProtection_ATTR']);
		return $EDSITE;
	}
}

if(!function_exists('EDARPAN_WPL_HEAD'))
{
	function EDARPAN_WPL_HEAD()
	{
		global $EDSITE;
		EDARPAN_WPL_FETCH_CONFIGURATION();
		$preview_status = strpos(strtolower(getenv("REQUEST_URI")), '?preview=true');
		
		if ($preview_status === false)
		{
			if($EDSITE['VALUES']['DRC'] == 1)
			{
				EDARPAN_WPL_DRC();
			}
			if($EDSITE['VALUES']['DTS'] == true)
			{
				EDARPAN_WPL_DTS();
			}
			if($EDSITE['VALUES']['DKS'] == true)
			{
				EDARPAN_WPL_DKS();
			}
		}
		?>
        
        <?php
	}
}

if(!function_exists('EDARPAN_WPL_DKS'))
{
	function EDARPAN_WPL_DKS()
	{
		global $EDSITE;
		?>
		<script type="text/javascript">
		jQuery(document).ready(function()
		{
			jQuery(document).bind("cut copy paste",function(e) {
			  e.preventDefault();
			});
		});
		</script>
		<?php
	}
}
	
if(!function_exists('EDARPAN_WPL_DRC'))
{
	function EDARPAN_WPL_DRC()
	{
		?>
        <script type='text/javascript' security="edarpan">
		var message = "<?php echo (isset($text) ? $text : ''); ?>";
		jQuery(document).ready(function(){
			jQuery("html,body").on("contextmenu",function(e){
				<?php echo ( (isset($text) && !empty($text)) ? 'alert(message);' : '' ); ?>
				return false;
			});
		});
		</script>
        <?php
	}
}

if(!function_exists('EDARPAN_WPL_DTS'))
{
	function EDARPAN_WPL_DTS()
	{
		global $EDSITE;
		?>
		<script type="text/javascript">
		function disableSelection(target)
		{
			if (typeof target.onselectstart != "undefined")
			{
				target.onselectstart = function()
				{
					return false;
				}
			}
			else if (typeof target.style.MozUserSelect != "undefined")
			{
				target.style.MozUserSelect = "none";
			}
			else
			{
				target.onmousedown=function()
				{
					return false;
				}
			}
			target.style.cursor = "default";
		}
		</script>
		<?php
	}
}

if(!function_exists('EDARPAN_WPL_FOOT_LOAD'))
{
	function EDARPAN_WPL_FOOT_LOAD($text='')
	{
		global $EDSITE;
		EDARPAN_WPL_FETCH_CONFIGURATION();
	
		if($EDSITE['VALUES']['DTS'] == true)
		{
			EDARPAN_WPL_FOOT();
		}
		if($EDSITE['VALUES']['ATTR'] == true)
		{
			EDARPAN_WPL_ATTR();
		}
	}
}

if(!function_exists('EDARPAN_WPL_ADMIN_OPTIONS_PAGE'))
{
	function EDARPAN_WPL_ADMIN_OPTIONS_PAGE()
	{
		global $EDSITE;
		if($_POST)
		{
			$saved_configuration = EDARPAN_WPL_SAVE_CONFIGURATION($_POST);
		}
		EDARPAN_WPL_FETCH_CONFIGURATION();
		?>
		<div class="wrap">
            <h1><?php echo WPL_BASIC_FULL_NAME_HEADING; ?></h1> 
            Plugin Version: <b><font style="color:#008000"><?php echo WPL_BASIC_DB_VERSION; ?></font> <font style="color:#800000">[Lite Version]</font> &nbsp; | &nbsp;<a style="" href="<?php echo WPL_BASIC_FULL_PAGE_LINK; ?>" target="_blank" title="Buy the <?php echo WPL_BASIC_FULL_NAME_PRO; ?>">Buy <?php echo WPL_BASIC_FULL_NAME_PRO; ?></a></b>
            <?php
			
			if(isset($saved_configuration) && !empty($saved_configuration))
			{
				echo '<br /><br /><div class="updated"><p>Your Options are Saved.</p></div>';
			}
			else
			{
				echo '<br />';
			}
            
            ?>
            <br />
            <form method="post" id="WordPressProtection_options">
                <fieldset class="options" style="float:left;">
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><label for="WordPressProtection_DTS">Disable Text-Selection ? </label></th> 
                        <td>
                        <input type="checkbox" id="WordPressProtection_DTS" name="WordPressProtection_DTS" value="1" <?php echo ( (isset($EDSITE['VALUES']['DTS']) && ($EDSITE['VALUES']['DTS'] == true)) ? 'checked="checked"' : '' ); ?> />
                        <label for="WordPressProtection_DTS">Activate</label>
                        </td> 
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="WordPressProtection_DKS">Disable Keyboard Shortcuts (e.g. Cut, Copy and Paste) ? </label></th> 
                        <td>
                        <input type="checkbox" id="WordPressProtection_DKS" name="WordPressProtection_DKS" value="1" <?php echo ( (isset($EDSITE['VALUES']['DKS']) && ($EDSITE['VALUES']['DKS'] == true)) ? 'checked="checked"' : '' ); ?> />
                        <label for="WordPressProtection_DKS">Activate</label>
                        </td> 
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="WordPressProtection_DRC_1">Disable Mouse - Right Click ? </label></th> 
                        <td>
                        <input type="radio" id="WordPressProtection_DRC_1" name="WordPressProtection_DRC" value="1" <?php 
						echo ( (isset($EDSITE['VALUES']['DRC']) && ($EDSITE['VALUES']['DRC'] == 1)) ? 'checked="checked"' : '' );
						?> />
                        <label for="WordPressProtection_DRC_1">Yes</label><br />
                        <input type="radio" id="WordPressProtection_DRC_0" name="WordPressProtection_DRC" value="0" <?php 
						echo ( (isset($EDSITE['VALUES']['DRC']) && ($EDSITE['VALUES']['DRC'] == 0)) ? 'checked="checked"' : '' );
						?> />
                        <label for="WordPressProtection_DRC_0">No, Don't Disable</label><br />
                        </td> 
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="WordPressProtection_ATTR">Proudly tell that you are using <?php echo WPL_BASIC_FULL_NAME; ?> Plugin ? </label></th> 
                        <td>
                        <input type="checkbox" id="WordPressProtection_ATTR" name="WordPressProtection_ATTR" value="WordPressProtection_ATTR" <?php echo ( (isset($EDSITE['VALUES']['ATTR']) && ($EDSITE['VALUES']['ATTR'] == true)) ? 'checked="checked"' : '' ); ?> />
                        <label for="WordPressProtection_ATTR">Yes, Please Activate</label>
                        </td> 
                    </tr>				
                    <tr>
                    <tr>
                        <th scope="row">Buy Professional ?</th> 
                        <td title="Click here to buy the Professional WordPress Protection to apply complete security on your wordpress website."><a href="<?php echo WPL_BASIC_FULL_PAGE_LINK; ?>" style="text-decoration:none;"><b>Click here</b> to buy the <b><?php echo WPL_BASIC_FULL_NAME_PRO; ?></b></a>
                        </td>
                    </tr>
                    <th scope="row">&nbsp;</th> 
                        <td>
                        <input type="submit" class="button-primary" name="WordPressProtection_save" value="Save all Settings" />
                        </td>
                    </tr>
                    </table>
                
                <br /><br /><br />
                <a href="<?php echo WPL_BASIC_FULL_PAGE_LINK; ?>" style="text-decoration:none;"><b>Compare</b> <b>Basic</b> and <b>Professional</b> versions of <b><?php echo WPL_BASIC_FULL_NAME; ?></b>.</a><br /><br />
                
                <small>For all kind of Inquiries and Support, please email us at <a href="mailto:<?php echo WPL_BASIC_SUPPORT_EMAIL; ?>" target="_blank"><?php echo WPL_BASIC_SUPPORT_EMAIL; ?></a>.<br /><br />
                </small>
                        
                    <div style="float:left;">
                        <a style="" href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo WPL_BASIC_FULL_PAGE_LINK; ?>" data-text="Checkout WordPress Protection Plugin : An Ultimate Security For WordPress Websites by eDarpan.com" data-size="small" data-count="none" data-dnt="true">Tweet</a>
                        <script>
                        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
                        </script>
                            &nbsp;
                    </div>
                    <div>
                        <div id="fb-root"></div>
                        <script>
                        (function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) return;
                            js = d.createElement(s); js.id = id;
                            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=201818839843135";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));
                        </script>
                        <div class="fb-like" data-href="<?php echo WPL_BASIC_FACEBOOK_LINK; ?>" data-send="true" data-width="50" data-show-faces="false">
                        </div>
                    </div>

                </fieldset>
                
                <div id="wordpress_protection_pro" style="float:left;margin-left:8%;">
                    <a href="<?php echo WPL_BASIC_FULL_PAGE_LINK; ?>" target="_blank"><img src="<?php echo $EDSITE['WWW_PLUGIN_BASE_URL']['WPL'] . "images/" . WPL_BASIC_URL_NAME . "-pro.png"; ?>" border="0" /></a>
                </div>

            </form>
        </div>
		<?php
	}
}

if(!function_exists('EDARPAN_WPL_ADD_ADMIN_MENU_LINK'))
{
	function EDARPAN_WPL_ADD_ADMIN_MENU_LINK()
	{
		global $EDSITE;
		if (function_exists('add_options_page'))
		{
			add_options_page('WordPress Protection', 'WordPress Protection', 'level_8', basename(__FILE__), 'EDARPAN_WPL_ADMIN_OPTIONS_PAGE');
		}
	}
}

if(!function_exists('EDARPAN_WPL_ADMIN_SETTINGS_LINK'))
{
	function EDARPAN_WPL_ADMIN_SETTINGS_LINK($links)
	{
		global $EDSITE;
		$settings_link = '<a href="'. WPL_ADMIN_URL . '">Settings</a>';
		array_unshift($links, $settings_link);
		return $links;
	}
}

if(!function_exists('EDARPAN_WPL_FOOT'))
{
	function EDARPAN_WPL_FOOT()
	{
		global $EDSITE;
		?>
		<script type="text/javascript">
			var ed_bl_index;
			jQuery(document).ready(function(e){
				disableSelection(document.body);
			});
        </script>
        <!-- Wordpress Protection Plugin by eDarpan.com - http://www.edarpan.com/pages/wordpress-protection -->
        <?php
	}
}

if(!function_exists('EDARPAN_WPL_INSTALL'))
{
	function EDARPAN_WPL_INSTALL()
	{
		global $EDSITE;
		add_option("wordpress_protection_db_version", WPL_BASIC_DB_VERSION);
		register_setting('wpl_activate_redirect', 'wpl_activate_redirect');
		add_option("wpl_activate_redirect", true);
	}
}

if(!function_exists('EDARPAN_WPL_REDIRECT_TO_ADMIN_SETTINGS_PAGE'))
{
	function EDARPAN_WPL_REDIRECT_TO_ADMIN_SETTINGS_PAGE()
	{
		global $EDSITE;
		if(get_option('wpl_activate_redirect', false))
		{
			delete_option('wpl_activate_redirect');
			wp_redirect(WPL_ADMIN_URL);
		}
	}
}

if(!function_exists('EDARPAN_WPL_ATTR'))
{
	function EDARPAN_WPL_ATTR()
	{
		global $EDSITE;
		echo WPL_BASIC_ATTRIB;
	}
}

add_action('wp_enqueue_scripts', 'EDARPAN_ENQUEUE_SCRIPTS');
add_action('wp_head', 'EDARPAN_WPL_HEAD');
add_action('wp_footer', 'EDARPAN_WPL_FOOT_LOAD');
add_action('admin_menu', 'EDARPAN_WPL_ADD_ADMIN_MENU_LINK', 1);
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'EDARPAN_WPL_ADMIN_SETTINGS_LINK'); 
register_activation_hook(__FILE__, 'EDARPAN_WPL_INSTALL');
add_action('admin_init', 'EDARPAN_WPL_REDIRECT_TO_ADMIN_SETTINGS_PAGE');

?>