<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('prayer_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('masjid_id')->constrained('masjids')->onDelete('cascade');
            $table->date('date');
            $table->time('fajr');
            $table->time('fajr_jamath')->nullable();
            $table->time('zuhr');
            $table->time('zuhr_jamath')->nullable();
            $table->time('asr');
            $table->time('asr_jamath')->nullable();
            $table->time('maghrib');
            $table->time('maghrib_jamath')->nullable();
            $table->time('isha');
            $table->time('isha_jamath')->nullable();
            $table->time('sehri_end')->nullable();
            $table->time('zawal')->nullable();
            $table->time('jumah')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prayer_times');
    }
};
