<?php

namespace Slack;

use Data\DataManager;

class Controller extends BaseObject {

	const PAGE = 'page';
	const ACTION = 'action';
	const ACTION_LOGIN = 'login';
	const ACTION_LOGOUT = 'logout';
	const ACTION_CREATE_CHANEL = 'createChannel';
	const USER_NAME = 'userName';
	const USER_ID = 'userId';
	const USER_PASSWORD = 'password';

	private static $instance = false;
	public static function getInstance() : Controller {

		if (!self::$instance) {
			self::$instance = new Controller();
		}

		return self::$instance;
	}

	private function __construct() {

	}

	//public function invokePostAction() : never {
	public function invokePostAction() {

		// sicherstellen, dass POST verwendet wurde
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			throw new \Exception('Controller can only handle POST requests.');
		}
		// sicherstellen, dass ACTION existiert
		elseif (!isset($_REQUEST[self::ACTION])) {
			throw new \Exception(self::ACTION . ' is not defined.');
		}

		$action = $_REQUEST[self::ACTION];

		switch ($action) {
			
			case self::ACTION_LOGIN:
				if (!AuthenticationManager::authenticate($_REQUEST[self::USER_NAME], $_REQUEST[self::USER_PASSWORD])) {
					$this->forwardRequest(['Invalid user name or password']);
					Util::redirect("login");
				}
				Util::redirect();
				break;

			case self::ACTION_LOGOUT:
				AuthenticationManager::signOut();
				Util::redirect();
				break;

			// case self::ACTION_CREATE_CHANNEL:
			// 	Channel::add((int)$_REQUEST['bookId']);
			// 	Util::redirect();
			// 	break;

			default:
				throw new \Exception('Unknown controller action: ' . $action);
				break;
		}

	}

	private function forwardRequest(array $errors, string $page = null) {
		if ($page == null) {
			if (!isset($_REQUEST[self::PAGE])) {
				throw new \Exception('Missing page to forward to.');
			}
			$page = $_REQUEST[self::PAGE];
		}

		if (count($errors) > 0) {
			$page .= '&errors=' . urlencode(serialize($errors));
		}

		header('Location:' . $page);
	}

}