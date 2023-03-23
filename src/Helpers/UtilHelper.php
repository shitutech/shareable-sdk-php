<?php

namespace Shitutech\Shareable\Helpers;

final class UtilHelper
{
    /**
     * 返回随机字符串
     *
     * @param int $len
     * @param bool $onlyNum
     * @return string
     */
    public static function randomStr(int $len, bool $onlyNum = false): string
    {
        $numbers = '0123456789';
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $arr = [];

        if ($onlyNum === true) {
            $initString = $numbers;
        } else {
            $initString = $numbers . $alphabet;
        }

        $initLen = strlen($initString) - 1;

        for ($i = 0; $i < $len; $i++) {
            $initStart = $onlyNum === true && $i == 0 ? 1 : 0;
            $arr[] = $initString[rand($initStart, $initLen)];
        }

        return implode('', $arr);
    }

    /**
     * 把用特定符号分隔的字符串解析为字符串数组，去两端空格，去tag，带滤重
     *
     * @param string $str
     * @param string $split
     * @param bool $noTag
     * @param bool $unique
     * @param int $limit
     * @return array
     */
    public static function extractStringToStringArray(
        string $str, string $split = ',', bool $noTag = true, bool $unique = true, int $limit = PHP_INT_MAX
    ): array
    {
        $str = trim($str);
        if (!$str) {
            return [];
        }

        $items = array_map('trim', explode($split, $str, $limit));

        if ($noTag && $items) {
            $items = array_map('strip_tags', $items);
        }

        if ($unique === true) {
            $items = array_unique($items);
        }

        return $items;
    }
}