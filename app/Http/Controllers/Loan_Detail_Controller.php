<?php

namespace App\Http\Controllers;

use App\Models\LoanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Loan_Detail_Controller extends Controller
{
    public function showLoanDetails()
    {
        $loans = LoanDetail::all();
        return view('loan_details', compact('loans'));
    }

    public function processEmiDetails()
    {
        Schema::dropIfExists('emi_details');

        DB::statement('
            CREATE TABLE emi_details (
                clientid BIGINT,
                PRIMARY KEY (clientid)
            )
        ');

        $loans = LoanDetail::all();

        $minDate = LoanDetail::min('first_payment_date');
        $maxDate = LoanDetail::max('last_payment_date');
        $start = new \DateTime($minDate);
        $end = new \DateTime($maxDate);
        $end->modify('first day of next month');

        // Create columns for each month
        $interval = new \DateInterval('P1M');
        $period = new \DatePeriod($start, $interval, $end);
        foreach ($period as $dt) {
            $column = $dt->format("Y_M");
            DB::statement("ALTER TABLE emi_details ADD COLUMN $column DECIMAL(10, 2) DEFAULT 0");
        }

        // Populate the emi_details table
        foreach ($loans as $loan) {
            $emiAmount = $loan->loan_amount / $loan->num_of_payment;
            $clientid = $loan->clientid;
            DB::table('emi_details')->insert(['clientid' => $clientid]);

            $paymentDate = new \DateTime($loan->first_payment_date);
            for ($i = 0; $i < $loan->num_of_payment; $i++) {
                $column = $paymentDate->format("Y_M");
                DB::table('emi_details')
                    ->where('clientid', $clientid)
                    ->update([$column => DB::raw("$column + $emiAmount")]);
                $paymentDate->add($interval);
            }
        }

        $emiDetails = DB::table('emi_details')->get();
        return view('emi_details', compact('emiDetails'));
    }
}

