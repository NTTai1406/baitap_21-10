<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->Integer('user_id');
            $table->Integer('booking_id');
            $table->decimal('amount', 8, 2);
            $table->string('payment_method');
            $table->string('payment_status');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
