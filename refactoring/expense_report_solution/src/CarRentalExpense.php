<?php
/**
 * TODO: Document DinnerExpense.php.
 * @author jjrumi
 */

include_once 'Expense.php';

class CarRentalExpense extends Expense
{
	protected $name = 'Car Rental';

	/**
	 * @return bool
	 */
	public function isOverage()
	{
		return false;
	}
}