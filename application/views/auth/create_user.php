<?php $this->load->view('section/header') ?>

<div class="mt-5">

<div class="ml-3">
<h5 class='m-3'>New Employee</h5>


<div id="infoMessage"><?php echo $message;?></div>
<p class="pull-right mt-3">

<?php echo form_open("auth/create_user");?>
<div class="col-lg-4 col-md-6 pull-left">
      <p>
            <?php echo lang('create_user_fname_label', 'first_name');?> 
            <?php echo form_input($first_name);?>
      </p>

      <p>
            <?php echo lang('create_user_lname_label', 'last_name');?> 
            <?php echo form_input($last_name);?>
      </p>
      
      <?php
      if($identity_column!=='email') {
            echo '<p>';
            echo lang('create_user_identity_label', 'identity');
            echo '';
            echo form_error('identity');
            echo form_input($identity);
            echo '</p>';
      }
      ?>

     
      <p>
            <?php echo lang('create_user_company_label', 'company');?> 
            <?php echo form_input($company);?>
      </p>

      <p>
            <?php echo lang('create_user_email_label', 'email');?> 
            <?php echo form_input($email);?>
      </p>
 </div>
      <div class="col-lg-4 col-md-6 pull-left">
      <p>
            <?php echo lang('create_user_phone_label', 'phone');?> 
            <?php echo form_input($phone);?>
      </p>

      <p>
            <?php echo lang('create_user_password_label', 'password');?> 
            <?php echo form_input($password);?>
      </p>

      <p>
            <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> 
            <?php echo form_input($password_confirm);?>
      </p>


      <p><?php echo form_submit('submit', "Register");?></p>
      </div>

<?php echo form_close();?>



<script>

$(document).ready(function(){
      $("input:text").addClass("form-control");
      $("input:password").addClass("form-control");
      $("form>p").addClass("text-secondary");
      $("input:submit").addClass("btn btn-primary pull-right");
      $("#first_name").attr("autofocus",true);
});

</script>


<style>
</style>