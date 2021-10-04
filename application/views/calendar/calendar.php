<div class="content-wrapper" style="min-height: 1000px;">
    <section class="content-header">
        <h1>
            Hindi Calendar Function
            <a id="loadbasic" href="javascript:void(0);" data-toggle="modal" data-target="#addPersonal_expenses" class="btn btn-primary pull-right">
                <i class="fa fa-plus"></i>
            </a>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="user_list table-responsive">

                                    <?php
                                    $this_year_start_date = date('Y-m-d', strtotime ('first day of january this year'));

                                    $this_year_end_date = date('Y-m-d', strtotime ('last day of december this year'));
                                    $this_year_end_date = date('Y-m-d' ,strtotime('+1 days' , strtotime($this_year_end_date)));

                                    ?> 

                                    <input type="hidden" id="current_date" value="<?php echo $this_year_start_date; ?>">

                                    <a href="javascript:void(0)" onclick="openAndUpdateDataWithDateModal()">Stat Function</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </section>
</div>


<div class="modal fade" id="myModal" role="toggle">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>Hindi-Tithi </h3>
                    <div class="modal-content">
                        <form method="post" action="javascript:void(0);" name="hindiCalenderForm" id="hindiCalenderForm"> 
                            <div class="modal-body">  
                                <div class="row">
                                    
                                    <!-- <h5 id="model_title" class="modal-title">Modal title</h5> -->
                                    
                                     <div class="form-group col-sm-3 col-md-4">
                                        <label class="control-label asterisk">Date</label>
                                        <input class="form-control" type="text" name="date" id="date" value="">
                                    </div>
                                    <div class="form-group col-sm-3 col-md-4">
                                        <label class="control-label asterisk">Hindi-Tithi</label>
                                        <input class="form-control" type="text" name="tithi_name" id="tithi_name"  placeholder="Enter Tithi-Name">
                                    </div>
                                    <div class="form-group col-sm-3 col-md-4">
                                        <label class="control-label ">Count-Tithi</label>
                                        <input class="form-control " type="text" name="count" id="tithi_name" value="1">
                                    </div>
                            
                                </div>
                            </div>        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="updateDataWithDateModal();">Save changes</button>
                            </div>   
                        </form> 
                    </div>
            </div>
        </div>    
    </div>
</div>





<script type="text/javascript">
    var d = new Date(2018, 7, 3);


    function openAndUpdateDataWithDateModal()
    {
        d.setDate(d.getDate() + 1);
       
        $('#date').val(new Date(d));
        $('#myModal').modal("toggle");
    }


    function updateDataWithDateModal()
    {
        $.ajax({
            url: '<?php echo site_url(); ?>'+"/hindi_calendar/updateDataWithDate",
            type: "POST",
            data: $('#hindiCalenderForm').serialize(),
            dataType: "json",
            success: function(response) 
            {
                toastr.success("save succesfully");

                $('#myModal').modal("toggle");

                setTimeout(function(){ 
                    openAndUpdateDataWithDateModal();
                }, 1000);
                
            }   
        });
    }
</script>






<script type="text/javascript">
    function openModelWithDate() 
    {
        var now = new Date();

        for (var d = new Date(2019, 0, 1); d <= new Date(2019, 0, 5); d.setDate(d.getDate() + 1)) 
        {
            var date = new Date(d);

            // alert(date.toString('YYYY-m-d'));

         
        }


        // $('#model_title').html(date);
        // $('#myModal').modal("toggle");
    }
</script>