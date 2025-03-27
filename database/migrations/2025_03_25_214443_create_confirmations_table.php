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
            $table->string('record_version', 8)->nullable();
            $table->string('crce_operation', 32)->nullable();
            $table->string('active_feature', 64)->nullable();
            $table->integer('sequence_total')->nullable();
            $table->string('bundle_code', 32)->nullable();
            $table->bigInteger('opp_id')->nullable();
            $table->string('service_type', 64)->nullable();
            $table->string('customer_care_user', 32)->nullable();
            $table->string('subscriber_language', 64)->nullable();
            $table->string('imsi', 32)->nullable();
            $table->string('account_status', 32)->nullable();
            $table->bigInteger('tariff')->nullable();
            $table->bigInteger('new_tariff')->nullable();
            $table->bigInteger('pool_id')->nullable();
            $table->bigInteger('transaction_fee')->nullable();
            $table->bigInteger('old_value')->nullable();
            $table->bigInteger('new_value')->nullable();
            $table->string('currency', 64)->nullable();
            $table->bigInteger('add_amount')->nullable();
            $table->bigInteger('set_balance')->nullable();
            $table->bigInteger('closing_balance')->nullable();
            $table->bigInteger('account_id')->nullable();
            $table->bigInteger('account_descriptor_id')->nullable();
            $table->string('account_reference_id', 32)->nullable();
            $table->string('account_type', 32)->nullable();
            $table->bigInteger('account_limit')->nullable();
            $table->string('fnf_action', 32)->nullable();
            $table->string('fnf_number', 32)->nullable();
            $table->dateTimeTz('billing_period_start_date', 0)->nullable();
            $table->dateTimeTz('billing_period_end_date', 0)->nullable();
            $table->dateTimeTz('subscriber_activation_date', 0)->nullable();
            $table->dateTimeTz('subscriber_expiry_date', 0)->nullable();
            $table->string('cost_control_limit_name', 32)->nullable();
            $table->string('revenue_code', 32)->nullable();
            $table->string('crce_result_code', 128)->nullable();
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
