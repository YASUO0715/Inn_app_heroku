<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusIdToArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->bigInteger('status_id')              // status_idを追加
                ->after('category_id')                     // statusカラムの後ろに追加
                ->unsigned()                            // 正負の符号無し属性を設定
                ->default(1);                           // 空で外部キーを設定できないのでデフォルトの制約を追加
            $table->foreign('status_id')              // status_idに外部キーを設定する
                ->references('id')->on('statuses')    // categoriesテーブルのidカラムを外部キーにする
                ->onDelete('restrict');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            //
        });
    }
}
