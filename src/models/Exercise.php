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
    public static function withTitle(string $title): Exercise
    {
        $exercise = new self();
        $exercise->setTitle($title);
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

    /**
     * @param string $title
     *
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}