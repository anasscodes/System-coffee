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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ربط الطلب بالمستخدم
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('cascade'); // ربط الطلب بالعميل
            
            $table->integer('table_number')->nullable();

            $table->decimal('total', 8, 2)->default(0);
            $table->string('status')->default('pending');
                    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.   
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
