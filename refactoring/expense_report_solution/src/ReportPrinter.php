<?php

class ReportPrinter
{
	/**
	 * @var string
	 */
	private $accumulated_text = '';

	/**
	 * @return string
	 */
	public function getText()
	{
		return $this->accumulated_text;
	}

	/**
	 * @param string $text
	 */
	public function printOut( $text )
	{
		$this->accumulated_text .= $text;
	}
}