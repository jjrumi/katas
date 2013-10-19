<?php

class ExpenseReporter
{
	public function __construct( ExpenseReport $report, ReportPrinter $printer )
	{
		$this->report = $report;
		$this->printer = $printer;
	}

	public function printReport()
	{
		$this->report->totalUpExpenses();
		$this->printExpensesAndTotals();
	}

	private function printExpensesAndTotals()
	{
		$this->printHeader();
		$this->printExpenses();
		$this->printFooter();
	}

	private function printHeader()
	{
		$this->printer->printOut( "Expenses " . $this->getDate() . PHP_EOL );
	}

	private function printExpenses()
	{
		foreach( $this->report->getExpenses()->getIterator() as $expense )
		{
			$this->printExpense( $expense );
		}
	}

	/**
	 * @param Expense $expense
	 */
	private function printExpense( Expense $expense )
	{
		$this->printer->printOut(
			sprintf( "%s\t%s\t$%.02f\n",
				$expense->isOverage() ? 'X' : ' ',
				$expense->getName(),
				$this->centsToUnits( $expense->amount )
			)
		);
	}

	private function printFooter()
	{
		$this->printer->printOut(
			sprintf( "\nMeal expenses $%.02f", $this->centsToUnits( $this->report->getMealsSubtotal() ) )
		);
		$this->printer->printOut(
			sprintf( "\nTotal $%.02f", $this->centsToUnits( $this->report->getTotal() ) )
		);
	}

	/**
	 * @param float $expenses
	 * @return float
	 */
	private function centsToUnits( $expenses )
	{
		return $expenses / 100.0;
	}

	/**
	 * @return string
	 */
	public function getDate()
	{
		return date( 'Y-m-d' );
	}

}