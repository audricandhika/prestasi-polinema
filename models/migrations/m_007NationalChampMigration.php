<?php

use app\cores\Blueprint;
use app\cores\dbal\Column;
use app\cores\Schema;
use app\models\BaseMigration;
use app\models\Migration;

class m_007NationalChampMigration extends BaseMigration implements Migration
{
    public function up(): bool
    {
        return $this->construct->createTable("national_champ", function (Column $table) {
            $table->string("id")->primary();
            $table->string("nim");
        })->execute();
    }

    public function down(): bool
    {
        return $this->construct->dropTable("national_champ")->execute();
    }
}
