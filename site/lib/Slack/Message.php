<?php

namespace Slack;
use Data\DataManager;
use \Datetime;

class Message extends Entity {

	private int $channelId;
	private int $fromId;
    private string $content;
    private string $createdAt;
    private bool $isEdited;
    private bool $deleted;

	public function __construct(int $id, int $channelId, int $fromId, string $content, string $createdAt, bool $isEdited, bool $deleted) {
		parent::__construct($id);
		$this->channelId = intval($channelId);
		$this->fromId = intval($fromId);
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->isEdited = $isEdited;
        $this->deleted = $deleted;
	}

	public function getMessageContent(): string {
		return $this->content;
	}

	public function getCreatedAt(): string {
		return $this->createdAt;
	}

    public function getCreatedBy() : int {
		return $this->fromId;
	}

    public function isEdited(): bool {
        return $this->isEdited;
    }
}