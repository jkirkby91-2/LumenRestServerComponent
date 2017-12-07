<?php
	declare(strict_types=1);

	$this->app->get('ping', 'Jkirkby91\LumenRestServerComponent\Http\Controllers\PingController@ping');