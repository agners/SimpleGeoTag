<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( JPATH_COMPONENT.DS.'controller.php' );

$controller = new SimpleGeoTagController();
$controller->execute( JRequest::getCmd( 'task' ) );
$controller->redirect();