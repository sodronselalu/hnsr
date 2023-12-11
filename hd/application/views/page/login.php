<?php $this->load->view($header); ?>
<!--<style type="text/css">
body {
 background-image: url("<?php echo asset_url('asset/img/bg.jpg') ?>");
 background-size: 100%;
background-repeat:no-repeat;
}
</style>-->
<body class="login"><!--  class="login"-->
    <br>
    <br>
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form id="form_login" method="post" action="index.php/auth/login">
              <h1>Login Hemodialisa</h1>
              <div>
                <input type="text" class="form-control" placeholder="USERNAME" name="USERNAME" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="PASSWORD" name="PASSWORD" required="" />
              </div>
              <div align="left">
                <button type="submit" class="btn btn-success">Masuk</button>
                <button type="button" class="btn btn-default" onclick="reset()">Batal</button>
              </div>



              <div class="separator">

              <br />

                <div>
                  <h1><img src="<?php echo asset_url('asset/img/logo.png') ?>" width="40px" height="40px"> <?php echo FOOTER_TITLE; ?></h1>
                  <h2><?php echo '©'.CP.' '.FOOTER_DESCRIPTION; ?></h2>
                </div>
              </div>
            </form>
          </section>
          <?php 
            if(!is_null($this->session->flashdata('msg')))
            {
          		echo $this->session->flashdata('msg');
            } 
          ?>
        </div>
      </div>
    </div>

  </body>
  <?php $this->load->view($js); ?>
  <script type="text/javascript">
   function reset () {
   	$('#form_login').reset();
   }

  </script>