<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'localaudit',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
$db['db_server'] = array(
  'dsn'  => '',
  'hostname' => 'akmadnudin.com', //link server
  'username' => 'root', //username server
  'password' => '{Xksb-8@dK-y',
  'database' => 'tes', //db server
  'dbdriver' => 'mysqli',
  'dbprefix' => '',
  'pconnect' => FALSE,
  'db_debug' => (ENVIRONMENT !== 'production'),
  'cache_on' => FALSE,
  'cachedir' => '',
  'char_set' => 'utf8',
  'dbcollat' => 'utf8_general_ci',
  'swap_pre' => '',
  'encrypt' => FALSE,
  'compress' => FALSE,
  'stricton' => FALSE,
  'failover' => array(),
  'save_queries' => TRUE
);
