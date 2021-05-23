<?php

use App\Mapper\CommentMapper;
use App\DataType\Comment;

require __DIR__ . '/../vendor/autoload.php';

$data = ['author' => 'janko', 'body' => 'toto je text'];

// $c = new Comment();
// var_dump($data);
// commentFactory
CommentMapper::create($data);
