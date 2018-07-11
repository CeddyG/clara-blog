<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRowTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'row';

    /**
     * Run the migrations.
     * @table row
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id_row', true);
            $table->integer('fk_page')->nullable()->default(null);
            $table->integer('fk_col')->nullable()->default(null);
            $table->integer('pos_row')->nullable()->default(null);
            $table->string('class_row')->nullable()->default(null);
            $table->string('style_row')->nullable()->default(null);
            $table->string('attribute_row')->nullable()->default(null);

            $table->index(["fk_page"], 'fk_row_page1_idx');
            $table->index(["fk_col"], 'fk_row_col1_idx');
            
            $table->nullableTimestamps();
            
            $table->foreign('fk_page', 'fk_row_page1_idx')
                ->references('id_page')->on('page')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('fk_col', 'fk_row_col1_idx')
                ->references('id_col')->on('col')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
        
        Schema::table('col', function (Blueprint $table) {
            $table->foreign('fk_row', 'fk_col_row1_idx')
                ->references('id_row')->on('row')
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
