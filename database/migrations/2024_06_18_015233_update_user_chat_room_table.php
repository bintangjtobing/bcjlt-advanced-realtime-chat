<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('user_chat_room', function (Blueprint $table) {
            $table->unsignedBigInteger('invited_by')->nullable()->after('joined_at');
            $table->foreign('invited_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('user_chat_room', function (Blueprint $table) {
            $table->dropForeign(['invited_by']);
            $table->dropColumn('invited_by');
        });
    }
};