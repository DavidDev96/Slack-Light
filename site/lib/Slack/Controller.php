<?php

namespace Slack;

use Data\DataManager;
use Slack\Channel;
use \Datetime;

class Controller extends BaseObject {
	const PAGE = 'page';
	const ACTION = 'action';
	const MESSAGE_CONTENT = 'messageContent';
	const ACTION_MESSAGE_ADD = 'messageAdd';
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

			case self::ACTION_MESSAGE_ADD:
				$user = AuthenticationManager::getAuthenticatedUser();

				if ($user == null) {
					$this->forwardRequest(['Not logged in.']);
					break;
				}

				if (!$this->addMessage($_POST[self::MESSAGE_CONTENT])) {
					$this->forwardRequest(['Sending failed.']);
				} else {
					Util::redirect();
				}
				break;

			default:
				throw new \Exception('Unknown controller action: ' . $action);
				break;
		}

	}

	protected function addMessage(string $messageContent = null): bool {
		$errors = [];

		// $channelId = DataManager::getCurrentChannelId();
		$channelId = 2;
		$user = AuthenticationManager::getAuthenticatedUser();
		$userName = $user !== null ? $user->getUserName() : null;
		$createdAt = date_create()->format('Y-m-d H:i:s');

		if ($messageContent == null || strlen($messageContent) == 0) {
			$errors[] = 'Message content is empty.';
		}

		if ($channelId == null || $channelId == 0) {
			$errors[] = 'Invalid channelId.';
		}

		if ($userName == null) {
			$errors[] = 'Invalid user name.';
		}

		if (sizeof($errors) > 0) {
			$this->forwardRequest($errors);
			return false;
		}
		//try to add a new message
		$messageId = \Data\DataManager::createMessage($channelId, $userName, $messageContent, $createdAt, 0);
		if (!$messageId) {
			$this->forwardRequest(['Could not create message.']);
			return false;
		}

		return true;
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