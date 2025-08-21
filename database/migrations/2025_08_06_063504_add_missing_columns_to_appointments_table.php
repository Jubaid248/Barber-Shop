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
        Schema::table('appointments', function (Blueprint $table) {
            // Add the missing columns if they don't exist
            if (!Schema::hasColumn('appointments', 'service')) {
                $table->string('service')->nullable();
            }

            if (!Schema::hasColumn('appointments', 'price')) {
                $table->decimal('price', 8, 2)->default(0);
            }

            if (!Schema::hasColumn('appointments', 'payment_status')) {
                $table->string('payment_status')->default('unpaid');
            }

            if (!Schema::hasColumn('appointments', 'status')) {
                $table->string('status')->default('pending');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Drop the columns if they exist
            if (Schema::hasColumn('appointments', 'service')) {
                $table->dropColumn('service');
            }

            if (Schema::hasColumn('appointments', 'price')) {
                $table->dropColumn('price');
            }

            if (Schema::hasColumn('appointments', 'payment_status')) {
                $table->dropColumn('payment_status');
            }

            if (Schema::hasColumn('appointments', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
