<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTagTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'news_tag';

    /**
     * Run the migrations.
     * @table news_tag
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('fk_news');
            $table->integer('fk_tag');

            $table->index(["fk_news"], 'fk_news_tag_news1_idx');

            $table->index(["fk_tag"], 'fk_news_tag_tag1_idx');


            $table->foreign('fk_tag', 'fk_news_tag_tag1_idx')
                ->references('id_tag')->on('tag')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('fk_news', 'fk_news_tag_news1_idx')
                ->references('id_news')->on('news')
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
