<?php
//require_once APPPATH."/helpers/excel_import/excel_import.php";

funtion import_excel($Filepath){

	/**
 * XLS parsing uses php-excel-reader from http://code.google.com/p/php-excel-reader/
 */
	header('Content-Type: text/plain');
	// Excel reader from http://code.google.com/p/php-excel-reader/
	require('excel_import/php-excel-reader/excel_reader2.php');
	require('excel_import/SpreadsheetReader.php');

	date_default_timezone_set('UTC');
	//$Filepath = $_GET['File'];
	try
	{
		$Spreadsheet = new SpreadsheetReader($Filepath);

		$Sheets = $Spreadsheet -> Sheets();
		foreach ($Sheets as $Index => $Name)
		{
			echo '---------------------------------'.PHP_EOL;
			echo '*** Sheet '.$Name.' ***'.PHP_EOL;
			echo '---------------------------------'.PHP_EOL;

			$Time = microtime(true);

			$Spreadsheet -> ChangeSheet($Index);

			foreach ($Spreadsheet as $Key => $Row)
			{
				echo $Key.': ';
				if ($Row)
				{
					print_r($Row);
				}
				else
				{
					var_dump($Row);
				}
			}
		
		}
		
	}
	catch (Exception $E)
	{
		echo $E -> getMessage();
	}
}
?>