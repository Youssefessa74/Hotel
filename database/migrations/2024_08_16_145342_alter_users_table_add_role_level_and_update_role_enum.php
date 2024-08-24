<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableAddRoleLevelAndUpdateRoleEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Modify the 'role' column to include 'super_admin'
            $table->enum('role', ['user', 'admin', 'super_admin'])->default('user')->change();

            // Add the 'role_level' column with a default value of 1
            $table->unsignedTinyInteger('role_level')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert the 'role' column back to the original state
            $table->enum('role', ['user', 'admin'])->default('user')->change();

            // Drop the 'role_level' column
            $table->dropColumn('role_level');
        });
    }
}
