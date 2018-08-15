<?php

namespace CleaniqueCoders\OpenPayroll\Tests\Traits;

use CleaniqueCoders\OpenPayroll\Models\Payslip\Payslip;

trait PayslipTrait
{
    public $payslip;

    public function seedOnePayslipData()
    {
        $this->user = $user = \DB::table('users')->first();
        $datum      = [
            'user_id'         => $this->user->id,
            'payroll_id'      => $this->payroll->id,
            'total_earning'   => 900000,
            'total_deduction' => 0,
            'basic_salary'    => 900000,
            'gross_salary'    => 900000,
            'net_salary'      => 900000,
        ];
        $this->payslip = $this->seedDatum($datum, Payslip::class);
    }

    public function assertHasOnePayslipData()
    {
        $this->assertDatabaseHas($this->payslip->getTable(), [
            'user_id'         => $this->user->id,
            'payroll_id'      => $this->payroll->id,
            'total_earning'   => 900000,
            'total_deduction' => 0,
            'basic_salary'    => 900000,
            'gross_salary'    => 900000,
            'net_salary'      => 900000,
        ]);
    }

    /** @test */
    public function it_can_insert_payslip_data()
    {
        $this->seedOnePayslipData();
        $this->assertHasOnePayslipData();
    }
}
