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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('notification_email')->nullable()->after('email')->comment('Email for receiving notifications');
            $table->text('notification_cc')->nullable()->after('notification_email')->comment('Emails for CC separated by commas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['notification_email', 'notification_cc']);
        });
    }
};
