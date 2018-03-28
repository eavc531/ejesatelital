<?php $__env->startSection('htmlheader_title'); ?>
	Inicio
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Inicio
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>