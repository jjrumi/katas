<?php
/**
 * TODO: Document DinnerExpense.php.
 * @author jjrumi
 */

include_once 'Expense.php';

class DinnerExpense extends Expense
{
	protected $name = 'Dinner';

	/**
	 * @return bool
	 */
	public function isOverage()
	{
		return ( $this->amount > 5000 );
	}
}