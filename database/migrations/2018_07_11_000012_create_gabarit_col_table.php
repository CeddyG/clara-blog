<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGabaritColTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'gabarit_col';

    /**
     * Run the migrations.
     * @table gabarit_col
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id_gabarit_col', true);
            $table->integer('fk_col');
            $table->integer('fk_gabarit');
            $table->text('content_gabarit_col')->nullable()->default(null);

            $table->index(["fk_gabarit"], 'fk_gabarit_col_gabarit1_idx');
            $table->index(["fk_col"], 'fk_gabarit_col_col1_idx');
            
            $table->nullableTimestamps();

            $table->foreign('fk_col', 'fk_gabarit_col_col1_idx')
                ->references('id_col')->on('col')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->foreign('fk_gabarit', 'fk_gabarit_col_gabarit1_idx')
                ->references('id_gabarit')->on('gabarit')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
