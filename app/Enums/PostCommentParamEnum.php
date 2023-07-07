<?php

namespace App\Enums;

enum PostCommentParamEnum
{
    public const ALL = 0;
    public const WHIT_COMMENTS = 1;
    public const WHITHOUT_COMMENTS = 2;

    public const PARAMS = [
        self::ALL => 'Все',
        self::WHIT_COMMENTS => 'С комментариями',
        self::WHITHOUT_COMMENTS => 'Без комментариев'
    ];
}