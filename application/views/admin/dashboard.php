
<div class="content-wrapper" style="min-height: 1000px;">
    <section class="content">
        <input type="hidden" name="admin_id" id="admin_id" value="<?php echo $data['id'];?>">
<?php 
    if(isset($data['loans']) && !empty($data['loans'])) 
    { 
        $num_of_loan = count($data['loans']);
        $loan_amount = 0;
        $loan_amount_with_intrest = 0;
        foreach ($data['loans'] as $loan) {
            if(isset($loan->gold_current_rate) && !empty($loan->gold_current_rate))
            {
                $gold_price = $loan->gold_current_rate;
            }
            else
            {
                $gold_price = 0;
            }
            if(isset($loan->silver_current_rate) && !empty($loan->silver_current_rate))
            {
                $silver_price = $loan->silver_current_rate;
            }
            else
            {
                $silver_price = 0;
            }




            $loan_intrest_per_month =  $loan->amount / $loan->percentage;
            $loan_intrest_per_day =  ($loan_intrest_per_month / 30);
            // $customer_intrest_day = $this->loanmodel->customer_intrest_day($loan->created_date);
            if($loan->completed_date == '0000-00-00')
            {
                $last_date = date('Y-m-d');
            }
            else
            {
                $last_date = $loan->completed_date;
            }

            $customer_intrest_day = $this->loanmodel->customer_dashboard_intrest_day($loan->created_date, $last_date);

            if ($customer_intrest_day >= 365) 
            {
                $loan_intrest = 365 * $loan_intrest_per_day;
                $amount_with_interst = $loan_intrest + $loan->amount;

                $loan_intrest_per_month =  $amount_with_interst / $loan->percentage;
                $loan_intrest_per_day =  ($loan_intrest_per_month / 30);
                $customer_intrest_day = $customer_intrest_day - 365;
                $loan_intrest = $customer_intrest_day * $loan_intrest_per_day;
                $loan_amount_with_interst = $loan_intrest + $amount_with_interst;
            }
            else
            {
                $loan_intrest_per_month =  $loan->amount / $loan->percentage;
                $loan_intrest_per_day =  ($loan_intrest_per_month / 30);
                $loan_intrest = $customer_intrest_day * $loan_intrest_per_day;
                $loan_amount_with_interst = $loan_intrest;

            }


            $loan_amount_with_intrest = $loan_amount_with_intrest + $loan_amount_with_interst;
            $loan_amount = $loan_amount + $gold_price + $silver_price;
        }
    } 
    else 
    { 
        $num_of_loan = 0;
        $loan_amount = 0;   
        $loan_amount_with_intrest = 0;
    }
    if(isset($data['transactions']) && !empty($data['transactions']))
    {
        $initial_investments = 0;
        $recived_amount = 0;
        $total_loan_amount = 0;
        foreach ($data['transactions'] as $transaction) 
        {
            if($transaction->transaction_keyword == "add_initial_amount_by_bank" || $transaction->transaction_keyword == "add_initial_amount_by_cash" || $transaction->transaction_keyword == "user_initial_investment")
            {
                $initial_investments = $initial_investments + $transaction->transaction_amount;
            }
            if($transaction->transaction_keyword == "loan_by_cash" || $transaction->transaction_keyword == "loan_by_bank")
            {
                $total_loan_amount = $total_loan_amount + $transaction->transaction_amount;
            }
            if($transaction->transaction_keyword == "loan_completed_by_cash" || $transaction->transaction_keyword == "loan_completed_by_bank")
            {
                $recived_amount = $recived_amount + $transaction->transaction_amount;
            }
        }
    }
    else
    {
        $initial_investments = 0;
        $recived_amount = 0;
        $total_loan_amount = 0;
    }
?>

            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 id="complete">
                            <?php echo($initial_investments); ?>
                        </h3>
                        <p>Initial Investment</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph" style="margin-top:20px;font-size:55px;"></i>
                    </div>
                </div>
            </div>




            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3 id="approval_pending">
                        	<?php echo($num_of_loan); ?>
                        </h3>
                        <p>Number Of Loans</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph" style="margin-top:20px;font-size:55px;"></i>
                    </div>
                </div>
            </div>




            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3 id="walk_cancelled">
                        	₹ 
                            <?php echo $total_loan_amount; ?>
                        </h3>
                        <p>Loan Amount</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph" style="margin-top:20px;font-size:55px;"></i>
                    </div>
                </div>
            </div>


            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3 id="late_cancelled">₹ 
                            <?php
                                $new_amount = $total_loan_amount+$loan_amount_with_intrest;
                                echo round($new_amount); 
                            ?>
                        </h3>
                        <p>Amount With Intrest</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph" style="margin-top:20px;font-size:55px;"></i>
                    </div>
                </div>
            </div>


            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 id="late_cancelled">₹ 
                            <?php echo($recived_amount); ?>
                        </h3>
                        <p>Recived Amount</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph" style="margin-top:20px;font-size:55px;"></i>
                    </div>
                </div>
            </div>



            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3 id="late_cancelled">₹ 
                            <?php
                                $new_amount = round($total_loan_amount+$loan_amount_with_intrest);
                                if($recived_amount >= $new_amount)
                                    echo("0");
                                else
                                    echo $new_amount - $recived_amount; 
                            ?>
                        </h3>
                        <p>Left Amount</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph" style="margin-top:20px;font-size:55px;"></i>
                    </div>
                </div>
            </div>



            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 id="walk_cancelled">
                            ₹ 
                            <?php
                                if(isset($data['adminBasicInfo']->profit_amount) && !empty($data['adminBasicInfo']->profit_amount))
                                {
                                    echo $data['adminBasicInfo']->profit_amount;
                                }
                                else
                                {
                                    echo("0");
                                }
                            ?>
                        </h3>
                        <p>Profit</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph" style="margin-top:20px;font-size:55px;"></i>
                    </div>
                </div>
            </div>

            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3 id="walk_cancelled">
                            ₹ 
                            <?php
                                $new_amount = round($total_loan_amount+$loan_amount_with_intrest);
                                if($total_loan_amount > $new_amount)
                                {
                                    echo $new_amount - $total_loan_amount;  ;
                                }
                                else
                                {
                                    echo "0";  
                                }
                            ?>
                        </h3>
                        <p>Loss</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph" style="margin-top:20px;font-size:55px;"></i>
                    </div>
                </div>
            </div>



    <div class="row">                   
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="box-title">Loan Counting  Daliy Status</h3>
                        </div>
                    </div>
                    <div class="box-body">

                        <div id="chartdiv" style="width: 100%; height: 700px;"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">                   
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="box-title">Amount Daliy Status</h3>
                        </div>
                    </div>
                    <div class="box-body">

                        <div id="chartdiv1" style="width: 100%; height: 700px;"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>


        </div>
    </section>
</div>

<script src="<?php echo base_url(); ?>plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>

<script type="text/javascript">



function getLoanChartInfo() 
{
    method = '<?php echo base_url(); ?>' + 'index.php/admin/getLoanChartInfo/';
    $.ajax({
        url: method,
        type: 'POST',
        dataType: "json",
        success: function(responsedata)
        {
            var loan_daily_status = [];
            for ( var j = 0; j < responsedata.length; j++ ) 
            {
                loan_daily_status.push( 
                {
                    "created_date": responsedata[j].created_date,
                    "total_loan_on_date": responsedata[j].total_loan_on_date,
                    "total_completed_loan_on_date": responsedata[j].total_completed_loan_on_date,
                    "total_loan_amount": responsedata[j].created_amount,
                    "total_completed_loan_amount": responsedata[j].completed_amount,
                });
            }

            AmCharts.makeChart("chartdiv", {
                "type": "serial",
              "theme": "none",
                "legend": {
                    "horizontalGap": 10,
                    "maxColumns": 1,
                    "position": "right",
                    "useGraphSettings": true,
                    "markerSize": 10
                },

                "dataProvider": loan_daily_status,
                "categoryField": 'created_date',
                "valueAxes": [{
                    title: "Loan Number",
                    dashLength: 5,
                    stackType: "regular",
                    gridAlpha: 0.1,
                    axisAlpha: 3,
                }],
                "graphs": [
                    {
                        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                        "fillAlphas": 0.8,
                        "labelText": "[[value]]",
                        "lineAlpha": 0.3,
                        "title": "Created Loan",
                        "type": "column",
                        "color": "#000000",
                        "fillColors": "red",
                        "valueField": "total_loan_on_date"
                    }, {
                        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                        "fillAlphas": 0.8,
                        "labelText": "[[value]]",
                        "lineAlpha": 0.3,
                        "title": "Completed Loan",
                        "type": "column",
                        "color": "#000000",
                        "fillColors": "#008800",
                        "valueField": "total_completed_loan_on_date"
                    }, 
                ],
                "categoryField": "created_date",
                "categoryAxis": {
                        gridAlpha: 0,
                        axisAlpha: 0,
                        gridPosition: "start",
                        position: "left",
                        title: "Loan Date",

                },
                "export": {
                    "enabled": true
                 }

            });


            AmCharts.makeChart("chartdiv1", {
                "type": "serial",
              "theme": "none",
                "legend": {
                    "horizontalGap": 10,
                    "maxColumns": 1,
                    "position": "right",
                    "useGraphSettings": true,
                    "markerSize": 10
                },

                "dataProvider": loan_daily_status,
                "categoryField": 'created_date',
                "valueAxes": [{
                    title: "Loan Amount",
                    dashLength: 5,
                    stackType: "regular",
                    gridAlpha: 0.1,
                    axisAlpha: 3,
                }],
                "graphs": [
                    {
                        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                        "fillAlphas": 0.8,
                        "labelText": "[[value]]",
                        "lineAlpha": 0.3,
                        "title": "Created Loan Amount",
                        "type": "column",
                        "color": "#000000",
                        "fillColors": "red",
                        "valueField": "total_loan_amount"
                    }, {
                        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                        "fillAlphas": 0.8,
                        "labelText": "[[value]]",
                        "lineAlpha": 0.3,
                        "title": "Completed Loan Amount",
                        "type": "column",
                        "color": "#000000",
                        "fillColors": "#008800",
                        "valueField": "total_completed_loan_amount"
                    }, 
                ],
                "categoryField": "created_date",
                "categoryAxis": {
                        gridAlpha: 0,
                        axisAlpha: 0,
                        gridPosition: "start",
                        position: "left",
                        title: "Loan Date",

                },
                "export": {
                    "enabled": true
                 }

            });
        }
    });
}
getLoanChartInfo();
</script>