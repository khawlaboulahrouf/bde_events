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
    Schema::create('reservations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained('users')->onDelete('cascade'); // l'étudiant qui réserve
        $table->foreignId('event_id')->constrained('events')->onDelete('cascade'); // l'événement réservé
        $table->timestamp('reserved_at')->useCurrent(); // date/heure de la réservation
        $table->timestamps();

        $table->unique(['student_id', 'event_id']); // empêche un étudiant de réserver 2 fois le même événement
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
