<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('headers', function (Blueprint $table) {
            $table->id();
            $table->string('version', 8);
            $table->integer('ticket_type_id');
            $table->boolean('success');
            $table->integer('provider');
            $table->string('application', 32);
            $table->string('ticket_type', 32);
            $table->string('node_id', 64);
            $table->dateTimeTz('ticket_timestamp', 0);
            $table->dateTimeTz('session_creation_timestamp', 0);
            $table->string('session_id', 128);
            $table->string('transaction_id', 128)->nullable();
            $table->integer('sequence_id')->nullable();
            $table->bigInteger('subscriber_id')->nullable();
            $table->string('subscriber_address', 32)->nullable();
            $table->string('subscriber_type', 32)->nullable();
            $table->string('subscriber_state', 32)->nullable();
            $table->string('subscriber_state_info', 128)->nullable();
            $table->integer('language_id')->nullable();
            $table->string('charge_notification', 32)->nullable();
            $table->string('error_code', 32)->nullable();
            $table->bigInteger('group_id')->nullable();
            $table->bigInteger('billing_account_id')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->morphs('headerable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('headres');
    }
};
