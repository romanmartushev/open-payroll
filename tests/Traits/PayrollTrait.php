<?php

namespace CleaniqueCoders\OpenPayroll\Tests\Traits;

use CleaniqueCoders\OpenPayroll\Models\Payroll\Payroll;

trait PayrollTrait
{
    public $payroll;

    public function seedPayrollSeeder()
    {
        $this->artisan('db:seed', ['--class' => 'PayrollSeeder']);
    }

    public function seedOnePayrollData()
    {
        $this->user = $user = \DB::table('users')->first();
        $datum      = [
            'user_id' => $user->id,
            'month'   => 1,
            'year'    => 2018,
            'date'    => '2018-08-1',
        ];
        $this->payroll = $this->seedDatum($datum, Payroll::class);
    }

    public function assertHasOnePayrollData()
    {
        $user = $this->user;
        $this->assertDatabaseHas($this->payroll->getTable(), [
            'user_id' => $user->id,
            'month'   => 1,
            'year'    => 2018,
            'date'    => '2018-08-1',
        ]);
    }

    public function getAPayroll()
    {
        return Payroll::first();
    }
}
