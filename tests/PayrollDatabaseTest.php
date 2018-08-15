<?php

namespace CleaniqueCoders\OpenPayroll\Tests;

use CleaniqueCoders\OpenPayroll\Tests\Traits\PayrollTrait;
use CleaniqueCoders\OpenPayroll\Tests\Traits\UserTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class PayrollDatabaseTest extends TestCase
{
    use PayrollTrait, RefreshDatabase, UserTrait;

    public function setUp()
    {
        parent::setUp();
        $this->seedPayrollSeeder();
        $this->reseedUsers();
    }

    /** @test */
    public function it_has_seeders()
    {
        $this->assertHasClass('PayrollSeeder');
        $this->assertHasClass('PayrollTestSeeder');
    }

    /** @test */
    public function it_has_references_data()
    {
        $tables = config('open-payroll.tables.names');

        foreach ($tables as $table) {
            $this->assertHasTable($table);
        }

        $seeds = config('open-payroll.seeds');

        foreach ($seeds as $table => $data) {
            foreach ($data as $datum) {
                $this->assertDatabaseHas($table, [
                    'name' => $datum,
                    'code' => Str::kebab($datum),
                ]);
            }
        }
    }

    /** @test */
    public function it_can_insert_payroll_data()
    {
        $this->seedOnePayrollData();
        $this->assertHasOnePayrollData();
        $this->truncateTable($this->payroll->getTable());
    }
}
