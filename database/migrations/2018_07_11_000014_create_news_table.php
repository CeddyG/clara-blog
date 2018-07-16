<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'news';

    /**
     * Run the migrations.
     * @table news
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id_news', true);
            $table->integer('fk_news_category');
            $table->unsignedInteger('fk_users');
            $table->string('title_news', 90)->nullable();
            $table->string('url_news')->nullable();
            $table->text('text_news')->nullable()->default(null);
            $table->string('url_image_news')->nullable()->default(null);

            $table->index(["fk_news_category"], 'fk_news_news_categorie1_idx');
            $table->index(["fk_users"], 'fk_news_users1_idx');
            
            $table->nullableTimestamps();

            $table->foreign('fk_news_category', 'fk_news_news_categorie1_idx')
                ->references('id_news_category')->on('news_category')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('fk_users', 'fk_news_users1_idx')
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
