<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeywordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keyword', function (Blueprint $table) {
            $table->integer('id')->primary('keyword_pkey');
            $table->string('keyword')->nullable();
            $table->integer('total_ad_words')->nullable();
            $table->integer('total_links')->nullable();
            $table->integer('total_results')->nullable();
            $table->float('total_result_seconds')->nullable();
            $table->text('html')->nullable();
            $table->timestamp('created')->nullable();
            $table->timestamp('updated')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keyword');
    }
}
