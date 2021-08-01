<?php
/**
 *
 * @package Bulk User Add Extension
 * @copyright (c) 2019 david63
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace david63\bulkuseradd\migrations;

use phpbb\db\migration\migration;

class version_2_1_0 extends migration
{
	public function update_data()
	{
		return [
			// Add the config variables
			['config.add', ['bua_csv_delimiter', ',']],
			['config.add', ['bua_date_type', 1]],
			['config.add', ['bua_email_column', '']],
			['config.add', ['bua_first_data_row', 1]],
			['config.add', ['bua_real_file_name', '']],
			['config.add', ['bua_sheet_name', 'Sheet1']],
			['config.add', ['bua_start_date_column', '']],
			['config.add', ['bua_update_file_date', 0]],
			['config.add', ['bua_upload_file_date', 0]],
			['config.add', ['bua_upload_file_name', '']],
			['config.add', ['bua_username_column', '']],

			// Add the ACP module
			['module.add', ['acp', 'ACP_CAT_DOT_MODS', 'BULK_USER_ADD']],

			['module.add', [
				'acp', 'BULK_USER_ADD', [
					'module_basename' => '\david63\bulkuseradd\acp\bulkuseradd_module',
					'modes' => ['manage', 'upload'],
				],
			]],

			['custom', [[$this, 'allow_documents']]],
		];
	}

	public function update_schema()
	{
		return [
			'add_columns' => [
				$this->table_prefix . 'users' => [
					'user_bulk_add' => ['BOOL', 0],
				],
			],
		];
	}

	/**
	 * Drop the columns schema from the tables
	 *
	 * @return array Array of table schema
	 * @access public
	 */
	public function revert_schema()
	{
		return [
			'drop_columns' => [
				$this->table_prefix . 'users' => [
					'user_bulk_add',
				],
			],
		];

	}

	/**
	 * Enable the upload of Excel/CSV files
	 *
	 * return null
	 * @access public
	 */
	public function allow_documents()
	{
		$sql = 'UPDATE ' . EXTENSION_GROUPS_TABLE . "
            SET allow_group = 1
            WHERE group_name = 'DOCUMENTS'";

		$this->db->sql_query($sql);
	}
}
