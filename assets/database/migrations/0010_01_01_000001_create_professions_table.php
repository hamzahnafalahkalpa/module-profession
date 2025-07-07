<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Hanafalah\ModuleProfession\Models\Profession\Profession;
use Hanafalah\ModuleProfession\Enums\Profession\Flag;

return new class extends Migration
{
    use Hanafalah\LaravelSupport\Concerns\NowYouSeeMe;

    private $__table;

    public function __construct()
    {
        $this->__table = app(config('database.models.Profession', Profession::class));
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $table_name = $this->__table->getTable();
        if (!$this->isTableExists()) {
            Schema::create($table_name, function (Blueprint $table) {
                $table->id();
                $table->string('flag',100);
                $table->string('name', 200)->nullable(false);
            });

            Schema::table($table_name, function (Blueprint $table) {
                $table->foreignIdFor($this->__table::class, 'parent_id')
                    ->nullable()->after('id')
                    ->index()->constrained()
                    ->cascadeOnUpdate()->restrictOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->__table->getTable());
    }
};
