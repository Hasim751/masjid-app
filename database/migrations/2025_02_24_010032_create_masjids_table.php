<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('masjids', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('city');
            $table->string('country');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('timezone');
            $table->string('calculation_method')->default('ISNA');
            $table->enum('status', ['active', 'pending', 'blocked'])->default('pending');
            $table->unsignedBigInteger('created_by'); // The user who created this Masjid
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('masjids');
    }
};
