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
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();  // Primary key
        $table->string('name');
        $table->text('description');
        
        // Project ID: Foreign key referencing projects table
        $table->unsignedBigInteger('project_id');
        
        // User ID: Foreign key referencing users table
        $table->unsignedBigInteger('user_id');  // Assigned to a user
    
        // Status and privacy enums
        $table->enum('status', ['pending', 'in progress', 'completed'])->default('pending');
        $table->enum('privacy', ['public', 'private'])->default('public');
    
        // Due date for the task (changed to `date` type)
        $table->date('due_date');
        
        // Foreign keys
        $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        
        // Track created and updated timestamps
        $table->timestamps();  // Includes created_at and updated_at
    });
    
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
