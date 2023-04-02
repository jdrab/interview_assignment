<?php

declare(strict_types=1);

namespace App\Mapper;

use \ReflectionClass;
use \ReflectionProperty;
use App\DataType\Comment;

class  CommentMapper
{

    private static $mapped = Comment::class;

    public static function create(array $data): Comment
    {

        $reflect = new ReflectionClass(self::$mapped);
        # privatne properties nebudem chytat
        $props   = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);

        $available = array_keys($data);
        $obj = new self::$mapped;

        foreach ($props as $prop) {

            if (in_array($prop->name, $available)) {
                if (str_ends_with($prop->name, '_id') || $prop->name === 'id') {
                    $obj->{$prop->name} = (int) $data[$prop->name];
                } else {
                    $obj->{$prop->name} = $data[$prop->name];
                }
            }
        }
        return $obj;
    }
}
