<?php

  /*
   * ProjectsPage.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class ProjectsPage extends Page
{

	const DEBUT_DEFAUT = 0;
	const DEFAULT_NO_LINES = 5;
	const MODE_DEFAUT = SUMMARY_MODE;

	public function display()
	{
		if (!isset($_GET["type"])) // EVERY project
		{
			$bloc = new SimpleBlock(ARTICLE_ELEMENT,"projects",DISPLAY_MODE);
			$bloc->display();
			$bloc = new CompositeBlock(
				PROJECT_ELEMENT,
				$begin,
				$noLines,
				SUMMARY_MODE, // useless?
				NULL, // every project
				"date");
			$bloc->display();
			return;
		}

		// else -> projects of one given type

		$type = $_GET["type"];

		$bloc = new SimpleBlock(PROJECT_TYPE_ELEMENT,"$type",DISPLAY_MODE);
		$bloc->display();

		$begin = $_GET["begin"]?$_GET["begin"]:self::DEBUT_DEFAUT;
		$noLines = $_GET["nb-lines"]?$_GET["nb-lines"]:self::DEFAULT_NO_LINES;	
		$mode = $_GET["mode"]?$_GET["mode"]:self::MODE_DEFAUT;	
		$sort = $_GET["sort"]?$_GET["sort"]:"date";
		$order = $_GET["order"]?$_GET["order"]:"descending";
		/*switch ($orderGet)
		{
			case "ascending": $sort|=CompositeBlock::SORT_ASCENDING; break;
			case "descending": $sort|=CompositeBlock::SORT_DESCENDING; break;
        }*/
		
		$bloc = new CompositeBlock(
			PROJECT_ELEMENT,
			$begin,
			$noLines,
			SUMMARY_MODE,
			$type,
			$sort,
			$order);
		$bloc->display();
	}
	
}

?>
