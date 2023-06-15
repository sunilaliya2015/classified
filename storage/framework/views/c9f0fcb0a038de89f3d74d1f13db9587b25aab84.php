<aside>
	<div class="inner-box">
		<div class="user-panel-sidebar">
			
			<?php if(isset($userMenu) && !empty($userMenu)): ?>
				<?php
					$userMenu = $userMenu->groupBy('group');
				?>
				<?php $__currentLoopData = $userMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
						$boxId = str($group)->slug();
					?>
					<div class="collapse-box">
						<h5 class="collapse-title no-border">
							<?php echo e($group); ?>&nbsp;
							<a href="#<?php echo e($boxId); ?>" data-bs-toggle="collapse" class="float-end"><i class="fa fa-angle-down"></i></a>
						</h5>
						<?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="panel-collapse collapse show" id="<?php echo e($boxId); ?>">
								<ul class="acc-list">
									<li>
										<a <?php echo (isset($value['isActive']) && $value['isActive']) ? 'class="active"' : ''; ?> href="<?php echo e($value['url']); ?>">
											<i class="<?php echo e($value['icon']); ?>"></i> <?php echo e($value['name']); ?>

											<?php if(isset($value['countVar']) && !empty($value['countVar'])): ?>
												<span class="badge badge-pill<?php echo e(!empty($value['countCustomClass']) ? $value['countCustomClass'] . ' hide' : ''); ?>">
													<?php echo e(\App\Helpers\Number::short(data_get($stats, $value['countVar']) ?? 0)); ?>

												</span>
											<?php endif; ?>
										</a>
									</li>
								</ul>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>
			
		</div>
	</div>
</aside><?php /**PATH G:\xampp\htdocs\classified\resources\views/account/inc/sidebar.blade.php ENDPATH**/ ?>