<?php

namespace App\Enums;

enum PostCommentParamEnum
{
    public const ALL = 0;
    public const WITH_COMMENTS = 1;
    public const WITHOUT_COMMENTS = 2;

    public const PARAMS = [
        self::ALL => 'Все',
        self::WITH_COMMENTS => 'С комментариями',
        self::WITHOUT_COMMENTS => 'Без комментариев'
    ];
}