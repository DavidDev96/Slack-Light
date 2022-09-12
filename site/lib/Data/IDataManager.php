<?php

namespace Data;

interface IDataManager {
	// public static function getCategories() : array;
	// public static function getBooksByCategory(int $categoryId) : array;
	public static function getUserById(int $userId);
	public static function getUserByUserName(string $userName);
	public static function getChannelsOfUserById(int $userId);
	public static function setCurrentChannelId(int $channelId);
	public static function getCurrentChannelId();
}