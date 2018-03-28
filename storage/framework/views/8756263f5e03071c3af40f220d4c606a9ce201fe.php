<?php $__env->startSection('htmlheader_title'); ?>
    Inicio de Sessión
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <body class="hold-transition login-page">
    <div id="app" v-cloak>
        <div class="login-box">
            <div class="login-logo">
               <img src="<?php echo e(asset('img/eje.png')); ?>" alt="" style="border-radius:15px;">
            </div><!-- /.login-logo -->

            <?php if(count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> <?php echo e(trans('adminlte_lang::message.someproblems')); ?><br><br>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="login-box-body" style="border-radius:20px">
                <p class="login-box-msg" style="color:rgb(9, 121, 213)"> Inicio de Sessión</p>
                <form action="<?php echo e(url('/login')); ?>" method="post">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <login-input-field
                            name="Iniciar Sessión"
                            domain="<?php echo e(config('auth.defaults.domain','')); ?>"
                    ></login-input-field>
                    <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Correo:" name="email"/>

                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Clave:" name="password"/>

                    </div>

                    <div class="row">
                        <div class="col-xs-8">
                           <div class="checkbox icheck">
                                <label>
                                    <input style="display:none;" type="checkbox" name="remember"> Recuerdame.
                                </label>
                           </div>
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button style="margin-left:-20px;width:105px;border-radius:3px" type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sessión</button>
                        </div><!-- /.col -->
                    </div>
                </form>



                <br>


            </div><!-- /.login-box-body -->

        </div><!-- /.login-box -->
    </div>
    <?php echo $__env->make('adminlte::layouts.partials.scripts_auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
    </body>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>