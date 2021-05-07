<?php 
namespace App\Validations;

use Config\Database;

class CustomRules {
	/**
	 * Checks the database to see if the given value is unique. Can
	 * ignore a single record by field/value to make it useful during
	 * record updates.
	 *
	 * Example:
	 *    is_unique[table.field,ignore_field,ignore_value]
	 *    is_unique[users.email,id,5]
	 *
	 * @param string $str
	 * @param string $field
	 * @param array  $data
	 *
	 * @return boolean
	 */
	public function is_unique_without_deleted(string $str = null, string $field, array $data): bool
	{
		// Grab any data for exclusion of a single row.
		list($field, $ignoreField, $ignoreValue) = array_pad(explode(',', $field), 3, null);

		// Break the table and field apart
		sscanf($field, '%[^.].%[^.]', $table, $field);

		$db = Database::connect($data['DBGroup'] ?? null);

		$row = $db->table($table)
				  ->select('1')
				  ->where($field, $str)
				  ->where('deleted_at IS NULL')
				  ->limit(1);

		if (! empty($ignoreField) && ! empty($ignoreValue))
		{
			if (! preg_match('/^\{(\w+)\}$/', $ignoreValue))
			{
				$row = $row->where("{$ignoreField} !=", $ignoreValue);
			}
		}

		return (bool) ($row->get()->getRow() === null);
	}
}
?>