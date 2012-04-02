<?php
/**
 * Base Database Config.
 *
 * See the individual environment DB configs for specific config information.
 */

return array(
	'active' => 'development',

	// Development
	'development' => array(
	    'type'           => 'mysqli',
	    'connection'     => array(
	        'hostname'       => 'localhost',
	        'port'           => '3306',
	        'database'       => 'queuela',
	        'username'       => 'queuela',
	        'password'       => 'quepass',
	        'persistent'     => false,
	    ),
	    'table_prefix'   => '',
	    'charset'        => 'utf8',
	    'caching'        => false,
	    'profiling'      => false,
	),
	
	// Production
	'production' => array(
	    'type'           => 'pdo',
	    'connection'     => array(
	        'dsn'            => 'mysql:host=localhost;dbname=fuel_db',
	        'username'       => 'your_username',
	        'password'       => 'y0uR_p@ssW0rd',
	        'persistent'     => false,
	    ),
	    'table_prefix'   => '',
	    'charset'        => 'utf8',
	    'caching'        => false,
	    'profiling'      => false,
	),
);
