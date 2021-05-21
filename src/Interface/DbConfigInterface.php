<?php

declare(strict_types=1);

namespace Interface;

interface DbConfigInterface
{
    public function adapter();
    public function host();
    public function name();
    public function user();
    public function pass();
    public function port();
    public function charset();
}
