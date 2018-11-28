<div class="m-5">
<a href="<?=base_url('charges')?>" class="btn btn-sm btn-danger pull-right">SALES <i class="fa fa-arrow-right"></i></a>
<h4 class="text-primary">Recent Customers</h4>
</div>

<div class="col-md-12">
<div class="col-md-3 pull-left" >
  <img class="card-img-top" src="<?=base_url('assets/images/salon1.jfif')?>" alt="Card image cap">
  <div class="card-body">
    <p class="card-text">For the latest styles and fashion in hairdo available in the industry.</p>
  </div>
</div>
<div class="col-md-9 pull-right">
<div class="">
 <div class="rounded flex alert alert-success">
  <button type='button' class="btn btn-success fa fa-plus pull-right" data-toggle='modal' data-target='#newProd'></button>
  <h5 class=''>Recent Clients</h5>
 </div>
  
  <table class="table table-striped w-100">
    <thead>
      <tr>
        <th>Sno</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Address</th>
      </tr>
    </thead>
    <tbody>
    <?php $x = 1; foreach($customers as $product=>$list): ?>
      <tr>
        <td><?=$x?></td>
        <td><?=$list->first_name?></td>
        <td><?=$list->last_name?></td>
        <td><?=$list->address?></td>
        <td><button type='button' class="btn btn-default fa fa-edit pull-right" data-toggle='modal' data-id='<?=$list->id?>' data-first_name='<?=$list->first_name?>' data-last_name='<?=$list->last_name?>' data-address='<?=$list->address?>' data-target='#editProd'></button></td>
        <td><span type='' class="text-danger fa fa-times"  onclick="del('<?=$list->id?>')"></button></td>
      </tr>
    <?php $x++;  endforeach; ?>
    </tbody>
  </table>
  

</div>
</div>
</div>



<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Add Product Modal -->
<div class="modal fade" id="newProd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php echo form_open('home/add/customers'); ?>
      <div class="form-group">
        <label for="">First Name</label>
        <input required type="text" class="form-control" name="first_name">
      </div>
      <div class="form-group">
        <label for="">Last Name</label>
        <input required type="text" class="form-control" name="last_name">
      </div>
      <div class="form-group">
        <label for="">Address</label>
        <textarea type="text" class="form-control" name="address"></textarea>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Client Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php echo form_open('home/update/customers'); ?>
      <div class="form-group">
        <label for="">First Name</label>
        <input required type="text" class="form-control" name="first_name">
      </div>
      <div class="form-group">
        <label for="">Last Name</label>
        <input required type="text" class="form-control" name="last_name">
      </div>
      <div class="form-group">
        <label for="">Address</label>
        <textarea type="text" class="form-control" name="address"></textarea>
      </div>
      <input type="hidden" id='index' name="id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Save changes</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>



<script>

$('#editProd').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') 
  var fname = button.data('first_name') 
  var lname = button.data('last_name') 
  var address = button.data('address') 
  var modal = $(this)
  modal.find('[name="first_name"]').val(fname)
  modal.find('[name="last_name"]').val(lname)
  modal.find('[name="address"]').val(address)
  modal.find('#index').val(id)
});


function del(id){
  $.post('<?=base_url('home/delete/customers/')?>' + id, function(res){
    window.location.reload();
    console.log("deleted");
  })
}
</script>