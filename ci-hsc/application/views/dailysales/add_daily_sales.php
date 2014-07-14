<h4 class="page-header">Add Sales </h4>
<div class="row">
    <!-- INSERT TOTAL SALE REPORT -------------------------------------------------------------------------->
    <div class='col-lg-4 straighten-up'>
        <div class="panel panel-default">
            <div class="panel-heading">Add Daily Sale</div>
            <div class="panel-body">
                <form role="form" action="<?php echo base_url('admin/daily_sales_add')?>" method="post">

                    <div class="form-group col-lg-6">
                        <label>Select Date</label>
                        <input class="form-control" id="datepicker2" type="text" name="date" value="<?php echo date('Y-m-d'); ?>" />
                    </div>

                    <div class="form-group col-lg-6">
                        <label>Total Sale</label>
                        <input class="form-control" name="total_sale" type="number" placeholder="<?php echo $today_sales;?>" />
                    </div>

                    <div class="form-group">
                        <button class="form-control btn btn-primary">Add Daily Sale</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>