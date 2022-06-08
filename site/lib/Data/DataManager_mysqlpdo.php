<?php

namespace Data;

use Slack\User;
use Slack\Channel;


class DataManager implements IDataManager {

	// ddev launch -p

	private static $__connection;

	private static function getConnection() {
		if (!isset(self::$__connection)) {
			// connection aufbauen

			$type = 'mysql';
			$host = 'db';
			$name = 'Slack';
			$user = 'root';
			$pass = 'root';

			self::$__connection = new \PDO($type . ':host=' . $host . ';dbname=' . $name . ';charset=utf8', $user, $pass);
		}
		return self::$__connection;
	}

	public static function exposeConnection() {
		return self::getConnection();
	}

	private static function closeConnection() {
		self::$__connection = null;
	}


	private static function query($connection, $query, $parameters = []) {
		$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		try {
			$statement = $connection->prepare($query);
			$i = 1;
			foreach ($parameters AS $param) {
				if (is_int($param)) {
					$statement->bindValue($i, $param, \PDO::PARAM_INT);
				}
				else if (is_string($param)) {
					$statement->bindValue($i, $param, \PDO::PARAM_STR);
				}
				$i++;
			}
			$statement->execute();
		}
		catch (\Exception $e) {
			die($e->getMessage());
		}

		return $statement;
	}

	private static function fetchObject($cursor) {
		return $cursor->fetchObject();
	}

	private static function close($cursor) {
		$cursor->closeCursor();
	}

	private static function lastInsertId($con) {
		return $con->lastInsertId();
	}


	/**
	 * get the categories
	 * @return array of Category-items
	 */
	public static function getConversations() : array {
		$return = [];

		$con = self::getConnection();
		$res = self::query(
			$con,
			'SELECT id, name
			FROM conversation;'
		);

		while ($category = self::fetchObject($res)) {
			$return[] = new Category($category->id, $category->name);
		}

		self::close($res);
		self::closeConnection();

		return $return;
	}	

	public static function getChannelsOfUserById(int $userId) : array {
		$channelIds = [];
		$return = [];

		$con = self::getConnection();
		$resChannelIds = self::query(
			$con,
			'SELECT channelId
				FROM ChannelUser
				WHERE userId = ?;',
			[$userId]
		);

		while ($channelId = self::fetchObject($resChannelIds)) {
			array_push($channelIds, $channelId);
		}

		$resChannels = self::query(
			$con,
			'SELECT id, channelName, description, createdBy, markedAsImportant, deleted
				FROM Channel
				WHERE id IN (1,2,3,4)'
		);

		while ($channel = self::fetchObject($resChannels)) {
			$return[] = new Channel($channel->id, $channel->channelName, $channel->description, $channel->createdBy, $channel->markedAsImportant, $channel->deleted);
		}

		self::close($resChannels);
		self::closeConnection();

		return $return;
	}



	// public static function getBooksByCategory(int $categoryId) : array {
	// 	$return = [];

	// 	$con = self::getConnection();
	// 	$res = self::query(
	// 		$con,
	// 		'SELECT id, categoryId, title, author, price
	// 		FROM books
	// 		WHERE categoryId = ?;',
	// 		[$categoryId]
	// 	);

	// 	while ($book = self::fetchObject($res)) {
	// 		$return[] = new Book($book->id, $book->categoryId, $book->title, $book->author, $book->price);
	// 	}

	// 	self::close($res);
	// 	self::closeConnection();

	// 	return $return;
	// }

	public static function getUserByUserName(string $userName) : ?User {
		$return = null;

		$con = self::getConnection();
		$res = self::query(
			$con,
			'SELECT id, userName, passwordHash, registered, deleted
			FROM User
			WHERE userName = ?
			LIMIT 1;',
			[$userName]
		);

		if ($user = self::fetchObject($res)) {
			$return = new User($user->id, $user->userName, $user->passwordHash);
		}

		self::close($res);
		self::closeConnection();

		return $return;
	}

	public static function getUserById(int $userId) : ?User {
		$return = null;

		$con = self::getConnection();
		$res = self::query(
			$con,
			'SELECT id, userName, passwordHash, registered, deleted
			FROM User
			WHERE id = ?
			LIMIT 1;',
			[$userId]
		);

		if ($user = self::fetchObject($res)) {
			$return = new User($user->id, $user->userName, $user->passwordHash);
		}

		self::close($res);
		self::closeConnection();

		return $return;
	}

	public static function createChannel(string $channelName, string $description) : int {
		$return = null;
		$user = AuthenticationManager::getAuthenticatedUser();
		$userId= $user !== null ? $user->getId() : 0;

		$date = new DateTime();

		$con = self::getConnection();

		$con->beginTransaction();

		try {

			self::query($con,
				'INSERT into Channel
					(channelName, description, createdBy, createdAt, markedAsImportant, deleted)
					VALUES (?, ?, ?, ?, ?);',
				[
					$channelName,
					$description,
					$userId,
					$date->getTimeStamp(),
					0,
					0
				]
			);
			$channelId = self::lastInsertId($con);
			$con->commit();
			$return = $channelId;
		}
		catch (\Exception $e) {
			$con->rollBack();
			$return = null;
		}

		self::closeConnection();

		return $return;
	}

}
