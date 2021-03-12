<?php if (isset($component)) { $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\GuestLayout::class, []); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
         <?php $__env->slot('logo'); ?> 
            <a href="/">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.application-logo','data' => ['class' => 'w-20 h-20 fill-current text-gray-500']]); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'w-20 h-20 fill-current text-gray-500']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            </a>
         <?php $__env->endSlot(); ?>

        <!-- Validation Errors -->
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.auth-validation-errors','data' => ['class' => 'mb-4','errors' => $errors]]); ?>
<?php $component->withName('auth-validation-errors'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'mb-4','errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors)]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

        <form method="post" action="<?php echo e(route('u_register')); ?>" class="auth_form">
		<?php echo csrf_field(); ?>

		<br/>
		<label for="name" class="tet">Name</label><br/>
		<input type="text" id="name" name="name" class="champ"><br/>

		<br/>
		<label for="firstname" class="tet">Firstname</label><br/>
		<input type="text" id="firstname" name="firstname" class="champ"><br/>

		<br/>
		<label for="password" class="tet">Password</label><br/>                  							<!-- LE FORMULAIRE POUR UN NOUVEAU PRODUIT-->
		<input type="text" id="password" name="password" class="champ"><br/>

		<br/>
		<label for="age" class="tet">Age</label><br/>
		<input type="number" id="age" name="age" class="champ"><br/>

		<br/>
		<label for="login" class="tet">Login</label><br/>
		<input type="text" id="login" name="login" class="champ"><br/>

        <br/>
		<label for="email" class="tet">E-mail</label><br/>
		<input type="text" id="email" name="email" class="champ"><br/>

		<br/>
		<input type="submit" value="Ajouter" class="butt">

		<br/>
	</form>

 <?php if (isset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015)): ?>
<?php $component = $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015; ?>
<?php unset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH /home/benoit/Restaurant_Advisor/resources/views/auth/register.blade.php ENDPATH**/ ?>