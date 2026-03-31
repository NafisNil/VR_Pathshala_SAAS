<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Spatie\LaravelPdf\Facades\Pdf;
use App\Mail\PaymentMail;
use Illuminate\Support\Facades\Mail;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        $plan = session('plan');
        $billing_address = session('billing_address');
        $user = auth()->user();
        return view('exampleHosted', compact('plan','user', 'billing_address'));
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = $request->total_amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->customer_name;
        $post_data['cus_email'] = $request->customer_email;
        $post_data['cus_add1'] = $request->customer_address;
        $post_data['cus_add2'] = $request->customer_address2;
        $post_data['cus_city'] = $request->customer_city;
        $post_data['cus_state'] = $request->customer_state;
        $post_data['cus_postcode'] = $request->customer_zip;
        $post_data['cus_country'] = $request->customer_country;
        $post_data['cus_phone'] = $request->customer_mobile;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";
        $plan_duration = Plan::where('id', $request->plan_id)->value('duration');

       // dd($post_data['total_amount']);

        #Before  going to initiate the payment order status need to insert or update as Pending.
        DB::transaction(function () use ($post_data, $request, $plan_duration) {
            $update_product = DB::table('orders')
                ->where('transaction_id', $post_data['tran_id'])
                ->updateOrInsert([
                    'name' => $post_data['cus_name'],
                    'email' => $post_data['cus_email'],
                    'phone' => $post_data['cus_phone'],
                    'amount' => $post_data['total_amount'],
                    'status' => 'Pending',
                    'address' => $post_data['cus_add1'],
                    'transaction_id' => $post_data['tran_id'],
                    'currency' => $post_data['currency']
                ]);
            
            // Create a new subscription
            $subscription = Subscription::create([
                'user_id' => $request->user_id,
                'plan_id' => $request->plan_id,
                'started_at' => Carbon::now(),
                'expires_at' => Carbon::now()->addDays($plan_duration), 
                'status' => 'inactive',
            ]);

            // Create a payment record
            Payment::create([
                'user_id' => $request->user_id,
                'plan_id' => $request->plan_id,
                'amount' => $request->total_amount,
                'payment_method' => 'sslcommerze', // Assuming a default payment method
                'transaction_id' =>  $post_data['tran_id'], // Generate a unique transaction ID
                'status' => 'pending',
            ]);
        });

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                DB::transaction(function () use ($tran_id, $amount, $currency) {
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Complete']);
                    $payment = Payment::where('transaction_id', $tran_id)->first();
                    $user_id = $payment->user_id;
                    
                    if ($payment) {
                        $payment->status = 'completed';
                        $payment->save();
                    }

                    $subscription = Subscription::where('user_id', $user_id)->first();
                    if ($subscription) {
                        $subscription->status = 'active';
                        $subscription->save();
                    }
                    
                    $paymentDetails = [
                        'transaction_id' => $tran_id,
                        'amount' => $amount,
                        'currency' => $currency,
                        'date' => Carbon::now()->format('F d, Y h:i A'),
                        'plan_name' => $payment->plan->name ?? 'Subscription Plan',
                    ];

                    Mail::to($payment->user->email)->send(new PaymentMail($paymentDetails));
                });


                return view('frontend.payment.success', compact('tran_id'))->with('message', 'Transaction is successfully Completed.');
            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            return view('frontend.payment.success', compact('tran_id'))->with('message', 'Transaction is successfully Completed.');
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            return view('frontend.payment.failed', compact('tran_id'))->with('message', 'Invalid Transaction.');
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            return view('frontend.payment.failed', compact('tran_id'))->with('message', 'Transaction is Failed.');
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            return view('frontend.payment.success', compact('tran_id'))->with('message', 'Transaction is already Successful.');
        } else {
            return view('frontend.payment.failed', compact('tran_id'))->with('message', 'Transaction is Invalid.');
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            return view('frontend.payment.cancel', compact('tran_id'))->with('message', 'Transaction is Cancelled.');
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            return view('frontend.payment.success', compact('tran_id'))->with('message', 'Transaction is already Successful.');
        } else {
            return view('frontend.payment.cancel', compact('tran_id'))->with('message', 'Transaction is Invalid.');
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

    //get transaction details
    public function getTransactionHistory($payment_id)
    {
        $tran_id = Payment::where('id', $payment_id)->value('transaction_id');
        $store_id = env('SSLCZ_STORE_ID');
        $store_passwd = env('SSLCZ_STORE_PASSWORD');
        
        // Check if you are in sandbox or live mode
        $url = "https://sandbox.sslcommerz.com/validator/api/merchantTransIDvalidationAPI.php";
        
        $response = Http::get($url, [
            'tran_id' => $tran_id,
            'store_id' => $store_id,
            'store_passwd' => $store_passwd,
            'format' => 'json'
        ]);

        if ($response->successful()) {
            $data = $response->json();
            
            //return $data; 
            return view('frontend.payment.show_receipt', compact('data', 'payment_id'));
        }

        return response()->json(['error' => 'Unable to fetch data'], 500);
    }


    //download transaction receipt
    public function downloadTransactionReceipt($payment_id){
        $tran_id = Payment::where('id', $payment_id)->value('transaction_id');
        $store_id = env('SSLCZ_STORE_ID');
        $store_passwd = env('SSLCZ_STORE_PASSWORD');
        
        // Check if you are in sandbox or live mode
        $url = "https://sandbox.sslcommerz.com/validator/api/merchantTransIDvalidationAPI.php";
        
        $response = Http::get($url, [
            'tran_id' => $tran_id,
            'store_id' => $store_id,
            'store_passwd' => $store_passwd,
            'format' => 'json'
        ]);

        if ($response->successful()) {
            $data = $response->json();
           
            // Generate PDF receipt using the data
            // You can use a package like Dompdf or Snappy to create the PDF
            // For simplicity, let's assume you have a view called 'receipt' that formats the data
            
            return Pdf::view('frontend.payment.download_receipt', compact('data'))
            ->format('a4')
            ->name("invoice-{$tran_id}.pdf");
        }

        return response()->json(['error' => 'Unable to fetch data'], 500);
    }

}
