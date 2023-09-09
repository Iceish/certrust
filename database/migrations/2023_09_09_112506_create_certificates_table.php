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
        Schema::create('certificates', function (Blueprint $table) {
            $table->uuid('id');
            $table->timestamps();
            $table->string('common_name');
            $table->string('organization');
            $table->string('organization_unit')->nullable();
            $table->string('country_name');
            $table->string('state_or_province_name')->nullable();
            $table->string('locality_name')->nullable();
            $table->string('public_key');
            $table->string('private_key');
            $table->dateTimeTz('expires_on');
            $table->dateTimeTz('issued_on');
            $table->string('sha256_fingerprint');
            $table->string('sha1_fingerprint');
            $table->primary('id');
            $table->foreignUuid('issuer')->references('id')->on('certificates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
