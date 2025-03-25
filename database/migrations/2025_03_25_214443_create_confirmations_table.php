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
        Schema::create('confirmations', function (Blueprint $table) {
            $table->id();
            $table->string('record_version', 8);
            $table->string('crce_operation', 32);
            $table->string('active_feature', 64);
            $table->integer('sequence_total');
            $table->string('bundle_code', 32);
            $table->bigInteger('opp_id');
            $table->string('service_type', 64);
            $table->string('customer_care_user', 32);
            $table->string('subscriber_language', 64);
            $table->string('imsi', 32);
            $table->string('account_status', 32);
            $table->bigInteger('tariff');
            $table->bigInteger('new_tariff');
            $table->bigInteger('pool_id');
            $table->bigInteger('transaction_fee');
            $table->bigInteger('old_value');
            $table->bigInteger('new_value');
            $table->string('currency', 64);
            $table->bigInteger('add_amount');
            $table->bigInteger('set_balance');
            $table->bigInteger('closing_balance');
            $table->bigInteger('account_id');
            $table->bigInteger('account_descriptor_id');
            $table->string('account_reference_id', 32);
            $table->string('account_type', 32);
            $table->bigInteger('account_limit');
            $table->string('fnf_action', 32);
            $table->string('fnf_number', 32);
            $table->dateTimeTz('billing_period_start_date', 0);
            $table->dateTimeTz('billing_period_end_date', 0);
            $table->dateTimeTz('subscriber_activation_date', 0);
            $table->dateTimeTz('subscriber_expiry_date', 0);
            $table->string('cost_control_limit_name', 32);
            $table->string('revenue_code', 32);
            $table->string('crce_result_code', 128);
            $table->string('transparent_data', 1024);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirmations');
    }
};
