<?php
/**
 * JUMenu for SEBLOD
 *
 * @package          Joomla.Site
 * @subpackage       plg_cck_field_live_jumenu
 *
 * @author           Denys Nosov, denys@joomla-ua.org
 * @copyright        2023 (C) Joomla! Ukraine, https://joomla-ua.org. All rights reserved.
 * @license          GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Factory;

defined('_JEXEC') or die;

/**
 * Typo for plg_cck_field_live_jumenu
 *
 * @since       1.0
 * @subpackage  plg_cck_field_live_jumenu
 * @package     Joomla.Site
 */
class plgCCK_Field_LiveJUMenu extends JCckPluginLive
{
	/**
	 * @since 1.0
	 * @var string
	 */
	protected static $type = 'jumenu';

	/**
	 * @param           $field
	 * @param   string  $value
	 * @param   array   $config
	 *
	 * @param   array   $inherit
	 *
	 * @return false|string
	 * @since 1.0
	 */
	public function onCCK_Field_LivePrepareForm(&$field, &$value = '', &$config = [], $inherit = [])
	{
		if(self::$type != $field->live)
		{
			return false;
		}

		$app         = Factory::getApplication();
		$menu_item   = $app->getMenu()->getActive();
		$menu_params = $menu_item->getParams();

		$options = parent::g_getLive($field->live_options);
		$search  = $options->get('live_parameter');
		$results = explode("||", $menu_params->get('live'));

		$founder = [];
		foreach($results as $r)
		{
			if(strpos($r, $search . '=') !== false)
			{
				$founder[] = str_replace($search . '=', '', $r);
			}
		}

		$value = implode($founder);

		return $value;
	}
}