<?php
	session_start();
	
//	include 'config.php';
//	include 'plugins/controller.php';
//	include 'core/session.php';
//	include 'core/link-operator.php';
//	include 'core/functions.php';
//	include 'core/parser.php';
	require 'config.php';
	require_once 'bootstrap/bootstrap.php';
	require 'core/parser.php';
	FlushSessionStorage();
	session_destroy();
	
	session_abort();