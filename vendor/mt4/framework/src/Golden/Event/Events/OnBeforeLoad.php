<?php

namespace Golden\Event\Events;

use Golden\Event\Event;
use Golden\Event\EventInterface;

class OnBeforeLoad extends Event implements EventInterface
{

	/**
	 * @var \Closure
	 */
	protected $event;


	/**
	 * OnBeforeLoad constructor.
	 *
	 * @param \Closure $runnable
	 */
	public function __construct( \Closure $runnable ) {
		$this->event  = $runnable;
	}

	/**
	 * Run
	 *
	 * @return void
	 */
	public function run()
	{
		if($this->event)
		{
			call_user_func( $this->event );
		}
	}
}