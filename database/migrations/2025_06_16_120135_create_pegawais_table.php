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
 Schema::create('pegawais', function (Blueprint $table) {
 $table->id(); // id auto_increment primary key
 $table->string('NIK_NIP', 20)->nullable(); 
 $table->string('NIDN', 13)->nullable(); 
 $table->string('NUPTK', 40)->nullable(); 
 $table->string('nama', 100)->nullable(); 
 $table->string('status_pegawai', 30)->nullable(); 
 $table->string('status_nikah', 20)->nullable(); 
 $table->date('tanggal_lahir')->nullable(); 
 $table->string('sex', 20)->nullable(); 
 $table->string('telp', 15)->nullable(); 
 $table->string('email', 30)->nullable(); 
 $table->text('alamat')->nullable(); 
 $table->string('unit_kerja', 50);
 $table->string('NPWP', 30)->nullable(); 
 $table->timestamps();
 });
 }
 /**
 * Reverse the migrations.
 */
 public function down(): void
 {
 Schema::dropIfExists('pegawais');
 }
};
