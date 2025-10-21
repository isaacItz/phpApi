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
        Schema::create('pawn_reactivation_rules', function (Blueprint $table) {
            $table->id(); // bigint autoincrementable
            $table->integer('store_id')->nullable(false);
            $table->string('merchandise_type')->nullable(false);
            $table->decimal('loan_amount_min', 10, 2)->nullable(false);
            $table->decimal('loan_amount_max', 10, 2)->nullable(); // puede ser null
            $table->integer('auction_date_expired_min')->nullable();
            $table->integer('auction_date_expired_max')->nullable();
            $table->integer('user_request_auth')->nullable(false);
            $table->integer('user_response_auth')->nullable(false);
            $table->dateTime('created_at', 4)->nullable();
            $table->dateTime('updated_at', 4)->nullable();
            $table->softDeletes(); // si usas soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pawn_reactivation_rules');
    }
};
