<?php

namespace app\cores;

class Schema
{
    public static function createTableIfNotExist(string $tableName, callable $callback): array
    {
        $blueprint = new Blueprint($tableName);
        $callback($blueprint);
        $query = $blueprint->getColumnsAndConstraints();
        $column = $query["columns"];
        $constraint = $query["constraints"];

        $tsql = "IF NOT EXISTS (
                SELECT *
                FROM sysobjects
                WHERE name = '$tableName' AND xtype = 'U'
            )
            BEGIN
                CREATE TABLE [$tableName] ($column
           ";

        if (!empty($constraint)) {
            $tsql .= ", $constraint";
        }

        $tsql .= ") END;";

        return $blueprint->execute($tsql);
    }

    public static function insertInto(string $tableName, callable $callback): array
    {
        $blueprint = new Blueprint($tableName);
        $callback($blueprint);
        $tsql = $blueprint->getInsertions();

        foreach ($tsql as $query) {
            return $blueprint->execute($query);
        }

        return [];
    }

    public static function dropTableIfExist(string $tableName): array
    {
        $blueprint = new Blueprint($tableName);
        $tsql = "DROP TABLE IF EXISTS [$tableName];";
        return $blueprint->execute($tsql);
    }

    public static function alterTable(string $tableName, callable $callback): array
    {
        $blueprint = new Blueprint($tableName);
        $callback($blueprint);
        $tsql = $blueprint->getAlterations();

        foreach ($tsql as $query) {
            return $blueprint->execute($query);
        }

        return [];
    }

    public static function deleteFrom(string $tableName): array
    {
        $blueprint = new Blueprint($tableName);
        $tsql = "DELETE FROM [$tableName];";
        return $blueprint->execute($tsql);
    }
}