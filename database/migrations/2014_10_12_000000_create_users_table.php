<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('business_name')->nullable();
            $table->string('country_code')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->unique();
            $table->unsignedTinyInteger('fail_attempt')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('addr_1')->nullable();
            $table->string('addr_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('zip')->nullable();
            $table->string('api_token')->nullable();
            $table->boolean('periodic_billing')->default(0);
            $table->string('communication_preference')->nullable();
            $table->string('notification_preference')->nullable();
            $table->string('timezone')->nullable();
            $table->unsignedTinyInteger('status');
            $table->text('admin_note')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
