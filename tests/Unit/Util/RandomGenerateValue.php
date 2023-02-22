<?php

declare(strict_types=1);

namespace App\Tests\Unit\Util;

final class RandomGenerateValue
{
    public static function getInt(): int
    {
        return rand(1, 99999);
    }

    public static function getFloat(): float
    {
        return rand(1000, 9999) / 10;
    }

    public static function getSmallFloat(): float
    {
        return rand(1, 9) / 10;
    }

    public static function getSmallInt(): int
    {
        return rand(1, 9);
    }

    public static function getPhone(): string
    {
        return '+380' . rand(111111111, 999999999);
    }

    public static function getString(): string
    {
        return str_replace('.', '', uniqid('str', true));
    }

    public static function getName(): string
    {
        $firstname = [
            'Johnathon',
            'Anthony',
            'Erasmo',
            'Raleigh',
            'Nancie',
            'Tama',
            'Camellia',
            'Augustine',
            'Christeen',
            'Luz',
            'Diego',
            'Lyndia',
            'Thomas',
            'Georgianna',
            'Leigha',
            'Alejandro',
            'Marquis',
            'Joan',
            'Stephania',
            'Elroy',
            'Zonia',
            'Buffy',
            'Sharie',
            'Blythe',
            'Gaylene',
            'Elida',
            'Randy',
            'Margarete',
            'Margarett',
            'Dion',
            'Tomi',
            'Arden',
            'Clora',
            'Laine',
            'Becki',
            'Margherita',
            'Bong',
            'Jeanice',
            'Qiana',
            'Lawanda',
            'Rebecka',
            'Maribel',
            'Tami',
            'Yuri',
            'Michele',
            'Rubi',
            'Larisa',
            'Lloyd',
            'Tyisha',
            'Samatha',
        ];
        $lastname = [
            'Mischke',
            'Serna',
            'Pingree',
            'Mcnaught',
            'Pepper',
            'Schildgen',
            'Mongold',
            'Wrona',
            'Geddes',
            'Lanz',
            'Fetzer',
            'Schroeder',
            'Block',
            'Mayoral',
            'Fleishman',
            'Roberie',
            'Latson',
            'Lupo',
            'Motsinger',
            'Drews',
            'Coby',
            'Redner',
            'Culton',
            'Howe',
            'Stoval',
            'Michaud',
            'Mote',
            'Menjivar',
            'Wiers',
            'Paris',
            'Grisby',
            'Noren',
            'Damron',
            'Kazmierczak',
            'Haslett',
            'Guillemette',
            'Buresh',
            'Center',
            'Kucera',
            'Catt',
            'Badon',
            'Grumbles',
            'Antes',
            'Byron',
            'Volkman',
            'Klemp',
            'Pekar',
            'Pecora',
            'Schewe',
            'Ramage',
        ];
        return sprintf('%s %s', $firstname[rand(0, count($firstname) - 1)], $lastname[rand(0, count($firstname) - 1)]);
    }

    public static function getCardNumber(): string
    {
        $rand = '';
        for ($index = 1; $index < 16; $index++) {
            $rand .= rand(0, 9);
        }

        $multiplyNumber = function ($number): int {
            $result = $number * 2;

            return ($result >= 10) ? $result - 9 : $result;
        };

        $sum = function ($number) use ($multiplyNumber): int {
            $numberArray = array_reverse(str_split($number));

            $sum = 0;
            for ($index = 0; $index < count($numberArray); $index++) {
                $digit = (int) $numberArray[$index];
                $sum += ($index % 2 == 0) ? $multiplyNumber($digit) : $digit;
            }

            return $sum;
        };

        $lunh = 10 - ($sum($rand) % 10 ?: 10);
        return $rand . $lunh;
    }

    public static function getSmallString(): string
    {
        return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 5);
    }

    public static function getBool(): bool
    {
        return 1 === rand(0, 1);
    }

    public static function getUuid(): string
    {
        //return Uuid::uuid4()->toString();

        return 'uuid';
    }

    public static function getArray(): array
    {
        return range(0, 1);
    }

    public static function getJson(): string
    {
        return json_encode(self::getArray());
    }

    public static function getIp(): string
    {
        return long2ip(mt_rand());
    }

    public static function getUrl(): string
    {
        return sprintf(
            '%s://%s.%s',
            array_rand(array_flip(['http', 'https'])),
            self::getSmallString(),
            array_rand(array_flip(['com', 'org', 'biz', 'net']))
        );
    }

    public static function getEmail(): string
    {
        return sprintf('%s@%s.%s',
            self::getSmallString(),
            self::getSmallString(),
            array_rand(array_flip(['com', 'org', 'biz', 'net'])
        ));
    }
}