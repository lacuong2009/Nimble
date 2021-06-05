<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToQueueKeywordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('queue_keyword', function (Blueprint $table) {
            $table->foreign('keyword_id', 'fk_b811ea05115d4552')->references('id')->on('keyword')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('queue_keyword', function (Blueprint $table) {
            $table->dropForeign('fk_b811ea05115d4552');
        });
    }
}
