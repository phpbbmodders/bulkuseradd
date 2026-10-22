<?php
/**
*
* @package Bulk User Add Extension
* @copyright (c) 2019 david63
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace david63\bulkuseradd;

use phpbb\extension\base;

class ext extends base
{
	/** @var Extension name */
	protected $ext_name = 'bulkuseradd';

	/** @var max phpBB version */
	protected $max_version = '4.0.0@dev';

	/** @var min phpBB version */
	protected $min_version = '3.3.19';

	/** @var PHP version */
	protected $php_version = '8.3.36';

	/** @var phpBB check version */
	protected $phpbb_version = '3.3.0';

	/**
	 * Check whether the extension can be enabled.
	 * The current phpBB and PHP version should meet or
	 * exceed the minimum version required by this extension:
	 *
	 * @return bool|array
	 * @access public
	 */
	public function is_enableable()
	{
		$enableable = $this->check_phpbb_version() && $this->check_php_version();

		if (!$enableable)
		{
			$language = $this->container->get('language');
			$language->add_lang('bulkuseradd_install', 'david63/bulkuseradd');

			return $language->lang('BULKUSERADD_NOT_ENABLEABLE');
		}

		return $enableable;
	}

	/**
	 * Require phpBB 3.3.19 due to several security fixes in the phpBB software.
	 * Retain the existing upper limit excluding phpBB 4.0.
	 *
	 * @return bool
	 */
	protected function check_phpbb_version()
	{
		return phpbb_version_compare(PHPBB_VERSION, '3.3.19', '>=')
			&& phpbb_version_compare(PHPBB_VERSION, '4.0.0-dev', '<');
	}

	/**
	 * Requires PHP 8.3.36 due to security fixes.
	 *
	 * @return bool
	 */
	protected function check_php_version()
	{
		return PHP_VERSION_ID >= 80336;
	}
}
