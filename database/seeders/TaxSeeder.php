<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tax;
use Illuminate\Support\Facades\DB;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    DB::table('tax')->truncate();

    Tax::create(['PayType'=>'DAILY','StartRange'=>0,'EndRange'=>685,'OverMinimum'=>0,'AddPercent'=>0,'AdditionalPay'=>0,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'DAILY','StartRange'=>685,'EndRange'=>1095,'OverMinimum'=>685,'AddPercent'=>0.15,'AdditionalPay'=>0,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'DAILY','StartRange'=>1096,'EndRange'=>2191,'OverMinimum'=>1096,'AddPercent'=>0.20,'AdditionalPay'=>82.19,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'DAILY','StartRange'=>2192,'EndRange'=>5478,'OverMinimum'=>2192,'AddPercent'=>0.25,'AdditionalPay'=>356.16,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'DAILY','StartRange'=>5479,'EndRange'=>21917,'OverMinimum'=>5479,'AddPercent'=>0.30,'AdditionalPay'=>1342.37,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'DAILY','StartRange'=>21918,'EndRange'=>99999999,'OverMinimum'=>21918,'AddPercent'=>0.35,'AdditionalPay'=>6602.74,'UploadedBy'=>-1,]);

    Tax::create(['PayType'=>'WEEKLY','StartRange'=>0,'EndRange'=>4808,'OverMinimum'=>0,'AddPercent'=>0,'AdditionalPay'=>0,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'WEEKLY','StartRange'=>4808,'EndRange'=>7691,'OverMinimum'=>4808,'AddPercent'=>0.15,'AdditionalPay'=>0,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'WEEKLY','StartRange'=>7692,'EndRange'=>15384,'OverMinimum'=>7692,'AddPercent'=>0.20,'AdditionalPay'=>576.92,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'WEEKLY','StartRange'=>15385,'EndRange'=>38461,'OverMinimum'=>15385,'AddPercent'=>0.25,'AdditionalPay'=>2500,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'WEEKLY','StartRange'=>38462,'EndRange'=>153845,'OverMinimum'=>38462,'AddPercent'=>0.30,'AdditionalPay'=>9423.08,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'WEEKLY','StartRange'=>153846,'EndRange'=>99999999,'OverMinimum'=>153846,'AddPercent'=>0.35,'AdditionalPay'=>46346.15,'UploadedBy'=>-1,]);

    Tax::create(['PayType'=>'SEMI=MO','StartRange'=>0,'EndRange'=>10417,'OverMinimum'=>0,'AddPercent'=>0,'AdditionalPay'=>0,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'SEMI=MO','StartRange'=>10417,'EndRange'=>16666,'OverMinimum'=>10417,'AddPercent'=>0.15,'AdditionalPay'=>0,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'SEMI=MO','StartRange'=>16667,'EndRange'=>33332,'OverMinimum'=>16667,'AddPercent'=>0.20,'AdditionalPay'=>1250,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'SEMI=MO','StartRange'=>33333,'EndRange'=>83332,'OverMinimum'=>33333,'AddPercent'=>0.25,'AdditionalPay'=>5416.67,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'SEMI=MO','StartRange'=>83333,'EndRange'=>333332,'OverMinimum'=>83333,'AddPercent'=>0.30,'AdditionalPay'=>20416.67,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'SEMI=MO','StartRange'=>333333,'EndRange'=>99999999,'OverMinimum'=>333333,'AddPercent'=>0.35,'AdditionalPay'=>199416.67,'UploadedBy'=>-1,]);

    Tax::create(['PayType'=>'MONTHLY','StartRange'=>0,'EndRange'=>20833,'OverMinimum'=>0,'AddPercent'=>0,'AdditionalPay'=>0,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'MONTHLY','StartRange'=>20833,'EndRange'=>33332,'OverMinimum'=>20833,'AddPercent'=>0.15,'AdditionalPay'=>0,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'MONTHLY','StartRange'=>33333,'EndRange'=>66666,'OverMinimum'=>33333,'AddPercent'=>0.20,'AdditionalPay'=>2500,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'MONTHLY','StartRange'=>66667,'EndRange'=>166666,'OverMinimum'=>66667,'AddPercent'=>0.25,'AdditionalPay'=>10833.33,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'MONTHLY','StartRange'=>166667,'EndRange'=>666666,'OverMinimum'=>166667,'AddPercent'=>0.30,'AdditionalPay'=>40833.33,'UploadedBy'=>-1,]);
    Tax::create(['PayType'=>'MONTHLY','StartRange'=>666667,'EndRange'=>99999999,'OverMinimum'=>666667,'AddPercent'=>0.35,'AdditionalPay'=>200833.33,'UploadedBy'=>-1,]);

}
}
