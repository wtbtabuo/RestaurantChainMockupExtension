<?php

namespace Interfaces;

interface FileConvertible {
    public static function RandomGenerator($employeeCount, $minSalary, $maxSalary, $locationNumberRange, $zipCodeRange, $employees, $restaurantLocations): self;
    public function toHTML(): string;
    public function toMarkdown(): string;
    public function toArray(): array;
}