<?php

namespace Slack;
use Data\DataManager;
use \Datetime;

class Message extends Entity {

	private int $channelId;
	private string $createdBy;
    private string $content;
    private string $createdAt;
    private bool $isEdited;
    private bool $deleted;

	public function __construct(int $id, int $channelId, string $createdBy, string $content, string $createdAt, bool $isEdited, bool $deleted) {
		parent::__construct($id);
		$this->channelId = intval($channelId);
		$this->createdBy = $createdBy;
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->isEdited = $isEdited;
        $this->deleted = $deleted;
	}

	public function getId(): int {
		return $this->id;
	}

	public function getMessageContent(): string {
		return $this->content;
	}

	public function getCreatedAt(): string {
		return $this->createdAt;
	}

    public function getCreatedBy() : string {
		return $this->createdBy;
	}

    public function isEdited(): bool {
        return $this->isEdited;
    }
}