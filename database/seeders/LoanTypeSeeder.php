<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LoanType;
use Illuminate\Support\Facades\DB;

class LoanTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('loantype')->truncate();

        //
        LoanType::create([
            'LoanKey' => 'SSS_SALARY LOAN',
            'LoanType'=> 'SSS',
            'Description' => 'SALARY LOAN',
        ],);
        LoanType::create([
            'LoanKey' => 'SSS_CALAMITY LOAN',
            'LoanType'=> 'SSS',
            'Description' => 'CALAMITY LOAN',
        ],);
        LoanType::create([
            'LoanKey' => 'SSS_PAST DUE CALAMITY',
            'LoanType'=> 'SSS',
            'Description' => 'PAST DUE CALAMITY',
        ],);
        LoanType::create([
            'LoanKey' => 'SSS_SL PAST DUE',
            'LoanType'=> 'SSS',
            'Description' => 'SL PAST DUE',
        ],);
        LoanType::create([
            'LoanKey' => 'HDMF_SALARY LOAN',
            'LoanType'=> 'HDMF',
            'Description' => 'SALARY LOAN',
        ],);
        LoanType::create([
            'LoanKey' => 'HDMF_CALAMITY LOAN',
            'LoanType'=> 'HDMF',
            'Description' => 'CALAMITY LOAN',
        ],);
        LoanType::create([
            'LoanKey' => 'HDMF_PAGIBIG MP2',
            'LoanType'=> 'HDMF',
            'Description' => 'PAGIBIG_MP2',
        ],);
        LoanType::create([
            'LoanKey' => 'HDMF_STL AMORT BALANCE',
            'LoanType'=> 'HDMF',
            'Description' => 'STL AMORT BALANCE',
        ],);
        LoanType::create([
            'LoanKey' => 'HDMF_MPL PASTDUE AMORT',
            'LoanType'=> 'HDMF',
            'Description' => 'MPL PASTDUE AMORT',
        ],);
        LoanType::create([
            'LoanKey' => 'COMPANY_CASH ADVANCES',
            'LoanType'=> 'COMPANY',
            'Description' => 'CASH ADVANCES',
        ],);
        LoanType::create([
            'LoanKey' => 'COMPANY_MERALCO',
            'LoanType'=> 'COMPANY',
            'Description' => 'MERALCO',
        ],);
        LoanType::create([
            'LoanKey' => 'COMPANY_EMPLOYEE LOAN',
            'LoanType'=> 'COMPANY',
            'Description' => 'EMPLOYEE LOAN',
        ],);
        LoanType::create([
            'LoanKey' => 'COMPANY_MEAL CHARGES',
            'LoanType'=> 'COMPANY',
            'Description' => 'MEAL CHARGES',
        ],);
        LoanType::create([
            'LoanKey' => 'COMPANY_OTHERS',
            'LoanType'=> 'COMPANY',
            'Description' => 'OTHERS',
        ],);
        LoanType::create([
            'LoanKey' => 'COMPANY_NEW BILLS',
            'LoanType'=> 'COMPANY',
            'Description' => 'NEW BILLS',
        ],);
        LoanType::create([
            'LoanKey' => 'COMPANY_WITHHOLDING TAX',
            'LoanType'=> 'COMPANY',
            'Description' => 'WITHHOLDING TAX',
        ],);
        LoanType::create([
            'LoanKey' => 'COMPANY_STAFFHOUSE DUES',
            'LoanType'=> 'COMPANY',
            'Description' => 'STAFFHOUSE DUES',
        ],);
    }
}
