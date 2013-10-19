<?php
/**
 * TODO: Document DinnerExpense.php.
 * @author jjrumi
 */

include_once 'Expense.php';

class BreakfastExpense extends Expense
{
	protected $name = 'Breakfast';

	/**
	 * @return bool
	 */
	public function isOverage()
	{
		return ( $this->amount > 1000 );
	}
}