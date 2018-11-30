
<div class="">
<div class="">
 <div class="rounded flex alert alert-success">
  <button type='button' class="btn btn-success fa fa-plus pull-right" data-toggle='modal' data-target='#newProd'></button>
  <h5 class=''>Recent Products</h5>
 </div>
  
  <table class="table table-striped w-100">
    <thead>
      <tr>
        <th>Sno</th>
        <th>Product</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
    <?php $x = 1; foreach($product_list as $product=>$list): ?>
      <tr>
        <td><?=$x?></td>
        <td><?=$list->product_name?></td>
        <td><?=$list->price?></td>
        <td><button type='button' class="btn btn-default fa fa-edit pull-right" data-toggle='modal' data-id='<?=$list->id?>' data-price='<?=$list->price?>' data-name='<?=$list->product_name?>' data-target='#editProd'></button></td>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php echo form_open('home/add/products'); ?>
      <div class="form-group">
        <label for="">Product Name</label>
        <input required type="text" class="form-control" name="product_name">
      </div>
      <div class="form-group">
        <label for="">Price / Cost</label>
        <input required type="text" class="form-control" name="price">
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php echo form_open('home/update/products'); ?>
      <div class="form-group">
        <label for="">Product Name</label>
        <input required type="text" class="form-control" name="product_name">
      </div>
      <div class="form-group">
        <label for="">Price / Cost</label>
        <input type="text" class="form-control" name="price">
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
  var name = button.data('name') 
  var price = button.data('price') 
  var modal = $(this)
  modal.find('[name="product_name"]').val(name)
  modal.find('[name="price"]').val(price)
  modal.find('#index').val(id)
});


function del(id){
  $.post('<?=base_url('home/delete/products/')?>' + id, function(res){
    window.location.reload();
    console.log("deleted");
  })
}
</script>