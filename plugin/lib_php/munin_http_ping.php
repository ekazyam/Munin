<?php
/*##############################
* Author: Rum Coke
* Data  : 2015/06/15
* Ver   : 0.9.5
*##############################*/
/* Use For Ping Command. */
Class HttpPing
{
	/* Define String. */
	const PING_ERR = 'No valid IPv4 or IPv6 address found for';

	/* For Http Ping Retry Count. */
	private $try_count = 3;

	/* Parameters for Http Ping. (No Default) */
	private $url = array();
	private $result_ping = array();
	private $avg_ping = array();

	/* Set Count of Ping Command. */
	public function setTry($work)
	{
		$this->try_count = $work;
	}

	/* Set Array for Url. */
	public function setUrl($work)
	{
		$this->url = $work;
	}

	/* Check HttpPing Response. */
	private function CheckHttpResponse()
	{
		for ( $Z = 0; $Z < count($this->url); $Z++ )
		{
			if ( isset($this->result_ping[$Z]))
			{
				preg_match('/\/[[:digit:]]+.[[:digit:]]?\//' ,  $this->result_ping[$Z] , $data);
				array_push( $this->avg_ping ,  str_replace('/' , '' , $data ) );
			}
		}
	}

	/* Send to HttpPing to URLs. */
	public function SendHttpPing()
	{
		for ( $Z = 0; $Z < count($this->url); $Z++ )
		{
			array_push( $this->result_ping , exec( 'httping -c ' . $this->try_count . ' ' . $this->url[$Z] ) );
			if ( self::PING_ERR == $this->result_ping[$Z] )
			{
				$this->result_ping[$Z]='';
			}
		}

		/* Data Setting */
		$this->CheckHttpResponse();	
	}

	/* Get Ping Avg Data. */
	public function getPingResult()
	{
		return $this->avg_ping;
	}
}
?>
