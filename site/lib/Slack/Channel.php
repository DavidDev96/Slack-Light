<?php

namespace Slack;

class Channel extends Entity {

	private string $channelName;
	private string $description;
    private string $createdBy;
    private bool $deleted;
	private int $currentChannelId;

	public static function add(int $bookId) : void {
		$cart = self::getCart();
		$cart[$bookId] = $bookId;
		self::storeCart($cart);
	}

	public function __construct(int $id, string $channelName, string $description, int $createdBy, bool $deleted) {
		parent::__construct($id);
		$this->channelName = $channelName;
		$this->description = $description;
        $this->createdBy = $createdBy;
        $this->deleted = $deleted;
	}

    public static function createChannel(int $bookId) : void {
		$cart = self::getCart();
		$cart[$bookId] = $bookId;
		self::storeCart($cart);
	}

	public function getChannelName(): string {
		return $this->channelName;
	}

	public function getChannelId(): string {
		return $this->id;
	}

	public function getDescription() : string {
		return $this->description;
	}
}