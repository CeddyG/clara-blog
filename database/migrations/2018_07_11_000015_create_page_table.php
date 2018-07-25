<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'page';

    /**
     * Run the migrations.
     * @table page
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id_page', true);
            $table->integer('fk_page_category');
            $table->unsignedInteger('fk_users');
            $table->string('title_page', 45)->nullable()->default(null);
            $table->string('url_page')->nullable()->default(null);

            $table->index(["fk_users"], 'fk_page_users1_idx');
            $table->index(["fk_page_category"], 'fk_page_page_categorie1_idx');
            
            $table->nullableTimestamps();

            $table->foreign('fk_page_category', 'fk_page_page_categorie1_idx')
                ->references('id_page_category')->on('page_category')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->foreign('fk_users', 'fk_page_users1_idx')
                ->references('id')->on('users')
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
