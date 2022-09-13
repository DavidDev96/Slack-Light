<?php

namespace Slack;

use Data\DataManager;

class AuthenticationManager extends BaseObject {

	public static function authenticate(string $userName, string $password) : bool {

		$user = DataManager::getUserByUserName($userName);

		if (
			$user != null
			&& $user->getPasswordHash() === hash('sha1', $userName . '|' . $password)
		) {
			$_SESSION['User'] = $user->getId();
			return true;
		}
		self::signOut();
		return false;
	}

	public static function isAuthenticated() : bool {
		return isset($_SESSION['User']);
	}

	public static function signOut() : void {
		unset($_SESSION['User']);
	}

	public static function getAuthenticatedUser() : ?User {
		return self::isAuthenticated() ? DataManager::getUserById($_SESSION['User']) : null;
	}

	public static function register(string $userName, string $password) : bool {
		if ($userName == null) {
			return false;
		}
		if ($password == null) {
			return false;
		}
		$password = hash('sha1', $userName . '|' . $password);
		if (DataManager::createUser($userName, $password) == null) {
			return false;
		}
		return true;
	}
}
