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
            $table->integer('sequence_total');
            $table->string('imsi', 32);
            $table->string('calling_msisdn', 32);
            $table->string('clip_suppress_number', 32);
            $table->string('called_msisdn', 32);
            $table->string('destination_network', 128);
            $table->string('destination_zone', 128);
            $table->string('traffic_type', 32);
            $table->string('apn', 64);
            $table->integer('rating_group');
            $table->string('message_type_indicator', 32);
            $table->string('bearer_type', 32);
            $table->boolean('roaming');
            $table->string('subscriber_location', 32);
            $table->string('location_network', 128);
            $table->string('location_zone', 128);
            $table->dateTimeTz('answer_time', 0);
            $table->bigInteger('max_call_cost');
            $table->bigInteger('call_duration');
            $table->bigInteger('ticket_call_duration');
            $table->bigInteger('charged_duration');
            $table->bigInteger('ticket_charged_duration');
            $table->bigInteger('nr_of_segments');
            $table->bigInteger('transferred_units');
            $table->bigInteger('transferred_bytes');
            $table->bigInteger('ticket_transferred_bytes');
            $table->bigInteger('charged_bytes');
            $table->bigInteger('ticket_charged_bytes');
            $table->bigInteger('number_of_sms');
            $table->bigInteger('ticket_number_of_sms');
            $table->string('reference_number', 128);
            $table->boolean('charge_free_action');
            $table->integer('tariff');
            $table->bigInteger('pool_id');
            $table->bigInteger('account_descriptor_id');
            $table->string('account_reference_id', 32);
            $table->bigInteger('account_difference');
            $table->bigInteger('charge_amount');
            $table->bigInteger('account_id');
            $table->string('currency', 64);
            $table->bigInteger('closing_balance');
            $table->string('account_type', 32);
            $table->string('crce_result_code', 32);
            $table->bigInteger('rating_filter_id');
            $table->string('revenue_code', 128);
            $table->string('transparent_data', 2024);
            $table->string('additional_rating_info', 1024);
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
