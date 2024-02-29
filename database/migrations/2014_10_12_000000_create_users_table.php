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
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('manager_id')->default(0);
            $table->integer('lawyer_id')->default(0);
            $table->enum('type', ['Минимизация', 'Банкротство', 'Нет'])->default('Минимизация');
            $table->string('price')->nullable();
            $table->string('payment_per_month')->nullable();
            $table->string('plan')->nullable();
            $table->string('first_date')->nullable();
            $table->string('second_date')->nullable();
            $table->string('password');
            $table->timestamp('transfer_stop')->nullable();
            $table->timestamp('date_registration')->nullable();
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
