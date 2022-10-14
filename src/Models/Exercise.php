<?php

namespace App\Models;

/**
 * Exercise
 */
class Exercise
{
    protected int    $id;
    protected string $title;
    protected string $state = 'Building';

    public function __construct(array $params = [])
    {
        if (array_key_exists('title', $params)) {
            $this->title = $params['title'];
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }
}