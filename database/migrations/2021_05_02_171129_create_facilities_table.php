<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitiesTable extends Migration
{
  public function up()
  {
    Schema::create('facilities', function (Blueprint $table) {
      $table->id();
      $table->string('district')->default('');
      $table->string('post_code')->default('');
      $table->string('street_address')->default('');
      $table->string('facility_name')->default('');
      $table->string('doctors')->default('');
      $table->string('expertise')->default('');
      $table->text('consultation_hours')->default('');
      $table->string('appointment_phone')->default('');
      $table->string('appointment_email')->default('');
      $table->string('appointment_web')->default('');
      $table->text('notes')->default('');
      $table->string('website')->default('');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down()
  {
    Schema::dropIfExists('facilities');
  }
}
