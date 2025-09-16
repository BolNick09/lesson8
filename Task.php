<?php

class Task
{
    public function __construct
    (
        public ?int $id = null,
        public ?string $name = null,
        public ?string $due = null,
        public ?int $priority = null,
        public ?string $description  = null         
    )
    {}
}