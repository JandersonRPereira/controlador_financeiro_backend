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
        Schema::table('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->enum('type', ['receita', 'despesa'])->change();
            $table->string('description');
            $table->decimal('amount', total: 10, places: 2);
            $table->dateTime('transaction_date', precision:0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumn('id');
        Schema::dropColumn('user_id');
        Schema::dropColumn('type');
        Schema::dropColumn('description');
        Schema::dropColumn('amount');
        Schema::dropColumn('transaction_date');
    }
};
