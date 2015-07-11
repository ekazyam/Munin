<?php
/*##############################
* Author: Rum Coke
* Data  : 2015/06/14
* Ver   : 0.9.0
*##############################*/
/* Use For Graph. */
Class CreateGraph
{
	/* Parameters for Graph. */
	private $warn_res = '1000.0';
	private $critical_res = '5000.0';
	private $title = 'No Title';
	private $vlabel = 'No Vlabel';
	private $category = 'No Category';
	private $scale = 'yes';
	private $format = '%6.2lf';
	private $draw = 'LINE1';

	/* Parameters for Graph . (No Default) */
	private $label = array();
	private $value = array();

	/* Define Msg */
	const MSG_DRAW_WARN = 'Only LINE1/LINE2/LINE3 or AREA are Avalilable at Graph Format.';

	/* Set Warn */
	public function setWarn($work)
	{
		$this->warn_res = $work;
	}

	/* Set Critical */
	public function setCritical($work)
	{
		$this->critical_res = $work;
	}
	
	/* Set Title */
	public function setTitle($work)
	{
		$this->title = $work;
	}

	/* Set vlabel */
	public function setVlabel($work)
	{
		$this->vlabel = $work;
	}

	/* Set Category */
	public function setCategory($work)
	{
		$this->category = $work;
	}

	/* Set Scale */
	public function setScale($work)
	{
		if ( $work == 'yes' or $work == 'no' )
		{
			$this->scale = $work;
		}
	}

	/* Set Format */
	public function setFormat($work)
	{
		$this->format = $work;
	}

	/* SetDraw */
	public function setDraw($work)
	{
		switch($work)
		{
			case 'LINE1':
			case 'LINE2':
			case 'LINE3':
			case 'AREA':
				$this->draw = $work;
				break;	
			default:
				self::PrintData( self::MSG_DRAW_WARN );
				exit;
		}
	}

	/* SetInfo */
	public function setInfo($work)
	{
		$this->info = $work;
	}

	/* Setlabel */
	public function setLabel($work)
	{
		$this->label = $work;
	}

	/* SetValue */
	public function setValue($work)
	{
		$this->value = $work;
	}

	/* ShowParameters */
	public function showParameters()
	{
		/* Glaph Common */
		self::PrintData( 'graph_title ' . $this->title );
		self::PrintData( 'graph_args --base 1000 -l 0' );
		self::PrintData( 'graph_vlabel ' . $this->vlabel );
		self::PrintData( 'graph_category ' . $this->category );
		self::PrintData( 'graph_scale ' . $this->scale );
		self::PrintData( 'graph_printf ' . $this->format );

		/* Show Info. */
		for ( $Z = 0; $Z < count($this->label); ++$Z )
		{
			$target_label = $this->label[$Z];
			self::PrintData( $target_label . ".label " . $target_label );
			self::PrintData( $target_label . ".draw " . $this->draw );
			self::PrintData( $target_label . ".warning " . $this->warn_res );
			self::PrintData( $target_label . ".critical " . $this->critical_res );
			self::PrintData( $target_label . ".info " . $this->info );
		}
	}

	/* ShowValues */
	public function showValue()
	{
		/* Show Info. */
		for ( $Z = 0; $Z < count($this->label); ++$Z )
		{
			$target_label = $this->label[$Z];
			$target_value = $this->value[$Z][0];
			self::PrintData( $target_label . ".value " . $target_value );
		}
	}

	/* Print Data */
	public function PrintData($Data)
	{
		print( $Data . PHP_EOL );
	}
}
?>
