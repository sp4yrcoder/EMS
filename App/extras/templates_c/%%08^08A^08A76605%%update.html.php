<?php /* Smarty version 2.6.31, created on 2022-07-04 18:10:29
         compiled from update.html */ ?>
         <!-- Horizontal Form -->
         <div class="card-header col-sm-4 offset-sm-4 mt-3 rounded" style="background-color:#343a40;">
            <h3 class="card-titleS" style="color: white;">Edit Holiday</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="post" id="editHoliday">
          <div class="modal-body text-left">
            <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['dataRow']['id']; ?>
">
            <div class="row">
            <label class="col-md-1 offset-md-4"><b>Name</b></label>
            <input type="text" name="name" value="<?php echo $this->_tpl_vars['dataRow']['name']; ?>
" class="form-control form-control-sm col-md-3">
          </div>

          <div class="row mt-4">
            <label class="col-md-1 offset-md-4"><b>Date</b></label>
            <input type="date" name="date" value="<?php echo $this->_tpl_vars['dataRow']['date']; ?>
" class="form-control form-control-sm col-md-3">
          </div>

          <div class="row mt-4">
            <label class="col-md-1 offset-md-4"><b>Description</b></label>
            <textarea type="text" name="description" class="form-control form-control-sm col-md-3"><?php echo $this->_tpl_vars['dataRow']['description']; ?>
</textarea>
          </div>
          </div>
          <div class="card-footer col-sm-4 offset-sm-4">
            <button type="button" class="btn btn-dark submit">Edit Holiday</button>
          </div>
        </div>
            <!-- /.card-body -->
            <!-- /.card-footer -->
          </form>
<?php echo '
<script>
    $(document).ready(function()
    {
        $(".submit").click(function()
        {
            var holidayData = $("form#editHoliday").serializeArray();
            $.ajax({
                url: "/admin/holidays/update/",
                type: "POST",
                dataType: "json",
                data: holidayData, 
                success: function (result) {
                  if(result.status == 1)
                  {
                    window.location.href = "/admin/holidays";
                  }
                  else
                  {
                    console.log(result.errors);
                  }
                }
            });
        });
    });
</script>
'; ?>