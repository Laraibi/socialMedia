<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageCollumnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Users', function (Blueprint $table) {
            //
            $table->string('image_path')->nullable()->after('email_verified_at');
            $table->boolean('isMale')->after('image_path')->default(true);
            $table->date('DateOfBirth')->after('isMale')->default('1990-01-01');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Users', function (Blueprint $table) {
            //
            $table->dropColumn(['image_path','isMale','DateOfBirth']);
            // $table->dropC
        });
    }
}
