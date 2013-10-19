<?php

class ExpenseReport
{
	/**
	 * List of Expense objects.
	 *
	 * @var ArrayObject
	 */
	private $expenses;

	public function __construct()
	{
		$this->expenses = new ArrayObject();
	}

	public function printReport( ReportPrinter $printer )
	{
		$total = $meal_expenses = 0;

		$printer->printOut( "Expenses " . $this->getDate() . PHP_EOL );

		foreach ( $this->expenses->getIterator() as $expense )
		{
			if ( $expense->type == Expense::BREAKFAST || $expense->type == Expense::DINNER )
			{
				$meal_expenses += $expense->amount;
			}

			$name = 'TILT';
			switch ( $expense->type )
			{
				case Expense::BREAKFAST:
					$name = 'Breakfast';
					break;

				case Expense::DINNER:
					$name = 'Dinner';
					break;

				case Expense::CAR_RENTAL:
					$name = 'Car Rental';
					break;
			}

			$printer->printOut(
				sprintf( "%s\t%s\t$%.02f\n",
					($expense->type == Expense::DINNER && $expense->amount > 5000)
					||
					($expense->type == Expense::BREAKFAST && $expense->amount > 1000) ? 'X' : ' ',
					$name,
					$expense->amount / 100.0
				)
			);

			$total += $expense->amount;
		}

		$printer->printOut(
			sprintf( "\nMeal expenses $%.02f", $meal_expenses / 100.0 )
		);
		$printer->printOut(
			sprintf( "\nTotal $%.02f", $total / 100.0 )
		);
	}

	public function addExpense( Expense $expense )
	{
		$this->expenses->append( $expense );
	}

	public function getDate()
	{
		return date( 'Y-m-d' );
	}
}