<?php

use App\Enums\BooleanEnum;
use App\Enums\CreditCard\CardType;
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
        Schema::create('credit_cards', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('title');
            $table->string('link');
            $table->string('logo');
            $table->unsignedBigInteger('bank_id');
            $table->text('extra_info')->nullable();
            $table->double('rating')->nullable();
            $table->double('TAE');
            $table->double('annual_charges');
            $table->double('annual_transaction_costs');
            // special offers
            $table->tinyInteger('has_bonus_program')->default(0);
            $table->tinyInteger('has_additional_insurance')->default(0);
            $table->tinyInteger('has_discount_on_partners')->default(0);
            $table->tinyInteger('has_additional_offers')->default(0);
            $table->text('special_offers')->nullable();
            // participation
            $table->double('participation_fee');
            $table->double('participation_cost');
            // fees
            $table->double('fee_first_year');
            $table->double('fee_second_year');
            $table->double('fee_atm_national');
            $table->double('fee_atm_international');
            // free atm withdrawals amount
            $table->double('free_atm_national_fee_amount');
            $table->double('free_atm_eu_fee_amount');
            $table->double('free_atm_international_fee_amount');
            // interest rates
            $table->double('saving_interest_rate');
            $table->double('debt_interest_rate');

            $table->tinyInteger('card_type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_cards');
    }
};
