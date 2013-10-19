<?php

include_once __DIR__ . '/../src/ExpenseReport.php';
include_once __DIR__ . '/../src/Expense.php';
include_once __DIR__ . '/../src/ReportPrinter.php';

class ExpenseReportTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var ExpenseReport
	 */
	private $report;

	/**
	 * @var ReportPrinter
	 */
	private $printer;

	public function setUp()
	{
		$this->report = new ExpenseReport();
		$this->printer = new ReportPrinter();
	}

	/**
	 * @test
	 */
	public function printEmpty()
	{
		$this->report->printReport( $this->printer );

		$this->assertEquals(
			"Expenses {$this->report->getDate()}\n" .
				"\n" .
				"Meal expenses $0.00\n" .
				"Total $0.00",
			$this->printer->getText()
		);
	}

	/**
	 * @test
	 */
	public function printOneDinner()
	{
		$this->report->addExpense( new Expense( Expense::DINNER, 1678 ) );
		$this->report->printReport( $this->printer );

		$this->assertEquals(
			"Expenses {$this->report->getDate()}\n" .
				" \tDinner\t$16.78\n" .
				"\n" .
				"Meal expenses $16.78\n" .
				"Total $16.78",
			$this->printer->getText()
		);
	}

	/**
	 * @test
	 */
	public function twoMeals()
	{
		$this->report->addExpense( new Expense( Expense::DINNER, 1000 ) );
		$this->report->addExpense( new Expense( Expense::BREAKFAST, 500 ) );
		$this->report->printReport( $this->printer );

		$this->assertEquals(
			"Expenses {$this->report->getDate()}\n" .
				" \tDinner\t$10.00\n" .
				" \tBreakfast\t$5.00\n" .
				"\n" .
				"Meal expenses $15.00\n" .
				"Total $15.00",
			$this->printer->getText()
		);
	}

	/**
	 * @test
	 */
	public function twoMealsAndCarRental()
	{
		$this->report->addExpense( new Expense( Expense::DINNER, 1000 ) );
		$this->report->addExpense( new Expense( Expense::BREAKFAST, 500 ) );
		$this->report->addExpense( new Expense( Expense::CAR_RENTAL, 50000 ) );
		$this->report->printReport( $this->printer );

		$this->assertEquals(
			"Expenses {$this->report->getDate()}\n" .
				" \tDinner\t$10.00\n" .
				" \tBreakfast\t$5.00\n" .
				" \tCar Rental\t$500.00\n" .
				"\n" .
				"Meal expenses $15.00\n" .
				"Total $515.00",
			$this->printer->getText()
		);
	}

	/**
	 * @test
	 */
	public function overages()
	{
		$this->report->addExpense( new Expense( Expense::BREAKFAST, 1000 ) );
		$this->report->addExpense( new Expense( Expense::BREAKFAST, 1001 ) );
		$this->report->addExpense( new Expense( Expense::DINNER, 5000 ) );
		$this->report->addExpense( new Expense( Expense::DINNER, 5001 ) );
		$this->report->printReport( $this->printer );

		$this->assertEquals(
			"Expenses {$this->report->getDate()}\n" .
				" \tBreakfast\t$10.00\n" .
				"X\tBreakfast\t$10.01\n" .
				" \tDinner\t$50.00\n" .
				"X\tDinner\t$50.01\n" .
				"\n" .
				"Meal expenses $120.02\n" .
				"Total $120.02",
			$this->printer->getText()
		);
	}
}