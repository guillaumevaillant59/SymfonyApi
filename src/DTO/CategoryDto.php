<?php

namespace App\DTO;



class CategoryDto
{
    public function __construct(
        public ?int $id,
        public ?string $name,
        public ?string $description,
        public ?array $products,
        public ?string $image
    ) {
    }
}