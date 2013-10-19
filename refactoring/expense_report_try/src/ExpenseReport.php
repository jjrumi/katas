<?php

class ExpenseReport
{
	/**
	 * List of Expense objects.
	 *
	 * @var ArrayObject
	 */
	private $expenses;

	/**
	 * @var float
	 */
	private $total = 0.0;

	/**
	 * @var float
	 */
	private $meal_expenses = 0.0;

	public function __construct()
	{
		$this->expenses = new ArrayObject();
	}

	/**
	 * @param Expense $expense
	 */
	public function addExpense( Expense $expense )
	{
		$this->expenses->append( $expense );
	}

	public function totalUpExpenses()
	{
		foreach ( $this->expenses->getIterator() as $expense )
		{
			$this->addMealsSubtotal( $expense );
			$this->addToTotals( $expense );
		}
	}

	/**
	 * @param Expense $expense
	 */
	private function addMealsSubtotal( Expense $expense )
	{
		if ( $expense instanceof DinnerExpense || $expense instanceof BreakfastExpense )
		{
			$this->meal_expenses += $expense->amount;
		}
	}

	/**
	 * @param Expense $expense
	 */
	private function addToTotals( Expense $expense )
	{
		$this->total += $expense->amount;
	}

	/**
	 * @return ArrayObject
	 */
	public function getExpenses()
	{
		return $this->expenses;
	}

	/**
	 * @return float
	 */
	public function getMealsSubtotal()
	{
		return $this->meal_expenses;
	}

	/**
	 * @return float
	 */
	public function getTotal()
	{
		return $this->total;
	}
}