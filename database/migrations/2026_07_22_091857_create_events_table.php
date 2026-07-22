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
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->foreignId('admin_id')->constrained('users')->onDelete('cascade'); // l'admin qui a créé l'événement
        $table->string('titre');
        $table->text('description');
        $table->date('date');
        $table->time('heure');
        $table->string('lieu');
        $table->float('prix')->default(0); // 0 = événement gratuit
        $table->unsignedInteger('places'); // jauge maximale de places
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
