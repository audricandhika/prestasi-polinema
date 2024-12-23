<?php

namespace app\models\database\championLevel;

use app\models\BaseModel;

class NationalChamp extends BaseModel
{
    public const string TABLE = "national_champ";
    public const string ID = "id";
    public const string NIM = "nim";

    public static function insert(array $data): bool
    {
        return self::construct()
            ->insert(self::TABLE)
            ->values(
                [
                    self::ID => "?",
                    self::NIM => "?"
                ]
            )
            ->bindParams(1, $data[self::ID])
            ->bindParams(2, $data[self::NIM])
            ->execute();
    }

    public static function deleteAll(): bool
    {
        return self::construct()->delete(self::TABLE)->execute();
    }
}