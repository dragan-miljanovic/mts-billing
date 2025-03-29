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
        Schema::create('call_charges', function (Blueprint $table) {
            $table->id();
            $table->string('record_version', 8);
            $table->string('crce_operation', 32);
            $table->string('charge_mode', 32);
            $table->integer('sequence_total')->nullable();
            $table->string('imsi', 32);
            $table->string('calling_msisdn', 32);
            $table->string('clip_suppress_number', 32);
            $table->string('called_msisdn', 32)->nullable();
            $table->string('destination_network', 128)->nullable();
            $table->string('destination_zone', 128)->nullable();
            $table->string('traffic_type', 32);
            $table->string('apn', 64)->nullable();
            $table->integer('rating_group')->nullable();
            $table->string('message_type_indicator', 32)->nullable();
            $table->string('bearer_type', 32)->nullable();
            $table->boolean('roaming')->nullable();
            $table->string('subscriber_location', 32)->nullable();
            $table->string('location_network', 128)->nullable();
            $table->string('location_zone', 128)->nullable();
            $table->dateTimeTz('answer_time', 0)->nullable();
            $table->bigInteger('max_call_cost')->nullable();
            $table->bigInteger('call_duration')->nullable();
            $table->bigInteger('ticket_call_duration')->nullable();
            $table->bigInteger('charged_duration')->nullable();
            $table->bigInteger('ticket_charged_duration')->nullable();
            $table->bigInteger('nr_of_segments')->nullable();
            $table->bigInteger('transferred_units')->nullable();
            $table->bigInteger('transferred_bytes')->nullable();
            $table->bigInteger('ticket_transferred_bytes')->nullable();
            $table->bigInteger('charged_bytes')->nullable();
            $table->bigInteger('ticket_charged_bytes')->nullable();
            $table->bigInteger('number_of_sms')->nullable();
            $table->bigInteger('ticket_number_of_sms')->nullable();
            $table->string('reference_number', 128);
            $table->boolean('charge_free_action');
            $table->integer('tariff')->nullable();
            $table->bigInteger('pool_id')->nullable();
            $table->bigInteger('account_descriptor_id');
            $table->string('account_reference_id', 32)->nullable();
            $table->bigInteger('account_difference');
            $table->bigInteger('charge_amount');
            $table->bigInteger('account_id')->nullable();
            $table->string('currency', 64);
            $table->bigInteger('closing_balance');
            $table->string('account_type', 32)->nullable();
            $table->string('crce_result_code', 32);
            $table->bigInteger('rating_filter_id')->nullable();
            $table->string('revenue_code', 128)->nullable();
            $table->string('transparent_data', 2024)->nullable();
            $table->string('additional_rating_info', 1024)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_charges');
    }
};
