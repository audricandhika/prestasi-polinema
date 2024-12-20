<?php

use app\cores\Blueprint;
use app\cores\dbal\Column;
use app\cores\Schema;
use app\models\BaseMigration;
use app\models\Migration;


class m_017AdminRelation extends BaseMigration implements Migration
{
    public function up(): bool
    {
        return $this->construct->alterTable("admin", function (Column $table) {
            $table
                ->addForeignKey("nip", "fk_nip_admin")
                ->reference("user","no_induk")
                ->cascade();
        })->execute();
    }

    public function down(): bool
    {
        return true;
    }
}
