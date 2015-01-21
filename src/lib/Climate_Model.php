<?php
include "Scenario.php";
include "Group.php";

/**
 * Climate Model
 *
 * Contains the different scenarios and groups.
 * Responsible for performing interactions with
 * the groups and scenarios.
 * Creates a disaster scenario based on the group
 * inputs and how it affects the scenarios 
 * Displays all the information from the different
 * scenarios and groups in tables.
 * 
 * @author Guilherme Bentim (gizmo.bentim@gmail.com)
 * @author Fillipo Maddella (fillipo.madella@gmail.com)
 * @version 1.0
 * @copyright none
 * @link
 */
class Climate_Model
{
	/**
	 * Scenarios have a spam of 15 years so all 
	 * loops have iterations of 15 years.
	 */
	const INCREMENT = 15;

	/**
	 * The first and last year of the iterations is defined.
	 */
	const FIRST_YEAR = 2010;
	const LAST_YEAR = 2100;

	/**
	 * The initial rate of emissions in the first scenario is defined.
	 */
	const INITIAL_EMISSIONS = 0.13;

	/**
	 * These are used to define the range of the disaster risk.
	 */
	const MIN = 1;
	const MAX = 99;

	/**
	 * A hash table with all scenarios and their respective years.
	 */
	 private $scenarios;

	/**
	 * A hash table with all groups and their respective names.
	 */
	private $groups;

	/**
	 * The random number used to calculate the disaster scenario
	 */
	private $disaster;

	/**
	 * A hash table with boolean variables for each scenario, determining
	 * whether the scenario should be cloned or not, in order to update
	 * the subsequent scenarios whenever previous scenarios are updated.
	 */
	private $should_clone;


	/**
	 * Default Constructor
	 *
	 * Initializes all hash tables.
	 * Scenarios are spanned from 2010 to 2100.
	 * Groups are spanned from A to P, totalling 16 groups.
	 * The disaster variable is not initialized until it is called. 
	 *
	 *
	 */
	function __construct()
	{
		/**
		 * The first scenario is initialized to 2010, the initial year.
		 */
		$initial_scenario = new Scenario(2010);

		/**
		 * All scenarios, except for the first, are initiliazed to empty.
		 * They will eventually be cloned to the initial scenario.
		 */
		$this->scenarios = array(
			2010 => $initial_scenario,
			2025 => "",
			2040 => "",
			2055 => "",
			2070 => "",
			2085 => "",
			2100 => ""
		);

		/**
		 * The first scenario is already initialized so it won't be coned.
		 * All other scenarios remain awaiting for clonation, depending on
		 * runtime circumstances.
		 */
		$this->should_clone = array(
			2010 => false,
			2025 => true,
			2040 => true,
			2055 => true,
			2070 => true,
			2085 => true,
			2100 => true
		);

		/**
		 * All groups are initialized with default names and an index number.
		 * 
		 * @todo Allow for the end-user to estabilish and modify group names.
		 */
		$this->groups = array(
			"A" => new Group("A", 1),
			"B" => new Group("B", 2),
			"C" => new Group("C", 3),
			"D" => new Group("D", 4),
			"E" => new Group("E", 5),
			"F" => new Group("F", 6),
			"G" => new Group("G", 7),
			"H" => new Group("H", 8),
			"I" => new Group("I", 9),
			"J" => new Group("J", 10),
			"K" => new Group("K", 11),
			"L" => new Group("L", 12),
			"M" => new Group("M", 13),
			"N" => new Group("N", 14),
			"O" => new Group("O", 15),
			"P" => new Group("P", 16)
		);
	}

	/**
	 * Display Scenario
	 *
	 * Displays one of the senarios using an html table.
	 * A header is displayed with links to other scenarios.
	 * A button with the disaster scenario is displayed on the bottom.
	 * Display the groups in another table.
	 *
	 * @param int $year - The current year of the scenario to be displayed.
	 * @return several strings with htmls tags and the content.
	 */
	function displayScenario($year)
	{
		// check whether the scenario needs to be cloned
		if ($this->should_clone[$year])
			$this->cloneScenario($year);

		// display header with links to other scenarios
		echo "<table class='table' id='main-table'>" . 
			 "<tr>" .
			 "<th class='main-header'> Year </th>" .
			 "<th class='main-header text-center'><a href='' class='years' id='year2010'>2010</a></th>" .
			 "<th class='main-header text-center'><a href='' class='years' id='year2025'>2025</a></th>" .
			 "<th class='main-header text-center'><a href='' class='years' id='year2040'>2040</a></th>" .
			 "<th class='main-header text-center'><a href='' class='years' id='year2055'>2055</a></th>" .
			 "<th class='main-header text-center'><a href='' class='years' id='year2070'>2070</a></th>" .
			 "<th class='main-header text-center'><a href='' class='years' id='year2085'>2085</a></th>" .
			 "<th class='main-header text-center'><a href='' class='years' id='year2100'>2100</a></th></tr>";

		// display the scenario for the given year
		$this->scenarios[$year]->displayTable();

		// close the table containing the scenarios
		echo "</table>";

		// display the button that will generate the disaster scenario
		echo " <div class='container' id='getDisaster'>" .
		   	 "  <button type='button' class='btn btn-danger' id='danger'><i class='fa fa-bolt'></i>Check Disaster</button>" .
	    	 " </div>";

	   	// open the table that will contain the groups
		echo "<table class='table'>";
		echo "<hr>";

		//display groups and close the table
		$this->displayGroups($year);
		echo "</table>";
	}

	/**
	 * Display Groups
	 *
	 * Display all groups in the list of groups.
	 * Display a header with titles defining the different categories
	 * of information that will be displayed for each group.
	 *
	 * @param int $year - The current year of the scenario to be displayed.
	 * @return several strings with htmls tags and the content.
	 */
	function displayGroups($year)
	{
		// a header with the categories of info that will be displayed
		$header = "<tr>" .
          "<th class='main-header'> Group </th>" .
          "<th class='main-header text-center'> Total $ </th>" .
          "<th class='main-header text-center'> Develop </th>" .
          "<th class='main-header text-center'> Decision </th>" .
          "<th class='main-header text-center'> Income </th>" .
          "<th class='main-header text-center'> Disaster </th>" .
          "<th class='main-header text-center'> Cost </th>" .
          "<th class='main-header text-center'> Net </th>" .
        "</tr>";

        echo $header;
        
        // display each group on the list
		foreach ($this->groups as $key => $value)
			$value->displayGroup($year);

	}

	/**
	 * Clone Scenario
	 *
	 * Copies the previous scenario into the given scenario.
	 *
	 * @param int $year - The year of the scenario that will be cloned.
	 */
	function cloneScenario($year)
	{
		// check if it is not the first year in the iteration and if the scenario
		// is currently empty
		if ($year != self::FIRST_YEAR && $this->scenarios[$year-self::INCREMENT] == "")
			$this->scenarios[$year] = clone $this->scenarios[self::FIRST_YEAR];
		else
		{
			$this->scenarios[$year] = clone $this->scenarios[$year - self::INCREMENT];
			$this->should_clone[$year] = false;
		}
		$this->scenarios[$year]->setCurrentYear($year);
	}

	/**
	 * Page-level DocBlock
	 */
	function updateEmissions($year, $value)
	{
		if ($this->should_clone[$year])
			$this->cloneScenario($year);

		if ($year == self::FIRST_YEAR)
			$previous = self::INITIAL_EMISSIONS;
		else
		{
			$previous = $this->scenarios[$year]->climate_variables["Emissions_Growth"]->predictions[$year - self::INCREMENT];
			$previous = $previous*(($previous/4)+1);
		}

		$new_emissions = $previous - (0.01 * (5 - $value));
		$this->scenarios[$year]->setEmissionsGrowth($new_emissions);
		$this->should_clone[$year + self::INCREMENT] = true;
	}

	/**
	 * Page-level DocBlock
	 */
	function calculateAverage($year)
	{
		$total = 0;
		$num_groups = 0;
		foreach ($this->groups as $key => $value)
		{
			if ($value->data[$year]["decision"] != null)
			{
				$total = $total + $value->data[$year]["decision"];
				$num_groups++;
			}
		}

		return $total / $num_groups;
	}

	/**
	 * Page-level DocBlock
	 */
	function changeGroupDecision($name, $year, $value)
	{		
		$this->groups[$name]->changeDecision($year, $value);

		$average = $this->calculateAverage($year);

		$this->updateEmissions($year, $average);
	}

	/**
	 * Page-level DocBlock
	 */
	function createDisasterScenario($year)
	{
		foreach ($this->groups as $key => $value)
			if ($value->data[$year]["decision"] != null)
				$this->generateDisaster($value->group_name, $year);
	}

	/**
	 * Page-level DocBlock
	 */
	function generateDisaster($group, $year)
	{
		$disaster = rand (self::MIN, self::MAX);
		$risk = round($this->scenarios[$year]->climate_variables["Disaster_Risk"]->predictions[$year]);

		if ($disaster > $risk)
		{
			$this->groups[$group]->data[$year]["disaster"] = false;
			$this->groups[$group]->data[$year]["cost"] = 0;
			$this->groups[$group]->calculateNet($year);
		}
		else
		{
			$this->groups[$group]->data[$year]["disaster"] = true;
			$this->groups[$group]->calculateCost($year, $disaster, $risk);
		}
	}
}

?>