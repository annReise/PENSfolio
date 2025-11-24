<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');                // Nama posisi/jabatan
            $table->string('company_name');         // Nama perusahaan
            $table->string('company_logo')->nullable(); // path logo (opsional)
            $table->text('description')->nullable();    // deskripsi singkat
            $table->text('requirements')->nullable();   // requirement/skill
            $table->string('location')->nullable();     // lokasi kerja
            $table->string('employment_type')->nullable(); // fulltime / parttime / intern
            $table->string('apply_link')->nullable();  // link pendaftaran
            $table->date('deadline')->nullable();      // batas lamaran
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
