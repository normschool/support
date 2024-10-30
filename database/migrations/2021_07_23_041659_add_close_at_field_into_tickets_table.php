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
        Schema::table('tickets', function (Blueprint $table) {
            $table->timestamp('close_at')->nullable();
        });

        $closedTickets = \App\Models\Ticket::whereStatus(\App\Models\Ticket::STATUS_CLOSED)->where('close_at', '=', null)->get();

        foreach ($closedTickets as $closedTicket) {
            $closedTicket->update(['close_at' => $closedTicket->updated_at]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('close_at');
        });
    }
};
