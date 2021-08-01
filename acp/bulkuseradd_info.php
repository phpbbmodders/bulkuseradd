<?php
/**
 *
 * @package Bulk User Add Extension
 * @copyright (c) 2019 david63
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace david63\bulkuseradd\acp;

class bulkuseradd_info
{
	public function module()
	{
		return [
			'filename' => '\david63\bulkuseradd\acp\bulkuseradd_module',
			'title' => 'BULK_USER_ADD_MANAGE',
			'modes' => [
				'manage' => ['title' => 'BULK_USER_ADD_MANAGE', 'auth' => 'ext_david63/bulkuseradd && acl_a_board', 'cat' => ['BULK_USER_ADD']],
				'upload' => ['title' => 'BULK_USER_ADD_UPLOAD', 'auth' => 'ext_david63/bulkuseradd && acl_a_board', 'cat' => ['BULK_USER_ADD']],
			],
		];
	}
}
