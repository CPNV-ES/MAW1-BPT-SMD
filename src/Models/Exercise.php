<?php

namespace App\Models;

/**
 * Exercise
 */
class Exercise
{
    protected int    $id;
    protected string $title;

    public function __construct() {}

    /**
     * @param string $title
     *
     * @return Exercise
     */
    public static function withData(string $title, string $state): Exercise
    {
        $exercise = new self();
        $exercise->title = $title;
        $exercise->state = $state;
        return $exercise;
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

    public function setTitle($title)
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
}