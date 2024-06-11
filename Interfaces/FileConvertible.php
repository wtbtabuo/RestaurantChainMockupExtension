<?php

namespace Interfaces;

interface FileConvertible {
    public static function RandomGenerator(): self;
    public function toHTML(): string;
    public function toMarkdown(): string;
    public function toArray(): array;
}