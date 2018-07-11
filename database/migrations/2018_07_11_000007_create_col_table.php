<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'col';

    /**
     * Run the migrations.
     * @table col
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id_col', true);
            $table->integer('fk_row');
            $table->integer('pos_col')->nullable()->default(null);
            $table->string('class_col')->nullable()->default(null);
            $table->string('style_col')->nullable()->default(null);
            $table->string('attribute_col')->nullable()->default(null);
            $table->integer('size_xs')->nullable()->default(null);
            $table->integer('size_s')->nullable()->default(null);
            $table->integer('size_m')->nullable()->default(null);
            $table->integer('size_l')->nullable()->default(null);
            $table->integer('size_offset_xs')->nullable()->default(null);
            $table->integer('size_offset_s')->nullable()->default(null);
            $table->integer('size_offset_m')->nullable()->default(null);
            $table->integer('size_offset_l')->nullable()->default(null);
            $table->nullableTimestamps();
            
            $table->index(["fk_row"], 'fk_col_row1_idx');
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
