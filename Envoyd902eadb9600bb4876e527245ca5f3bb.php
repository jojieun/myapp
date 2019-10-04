<?php $HOSTNAME = isset($HOSTNAME) ? $HOSTNAME : null; ?>
<?php $local = isset($local) ? $local : null; ?>
<?php $global = isset($global) ? $global : null; ?>
<?php $dir = isset($dir) ? $dir : null; ?>
<?php $shared_item = isset($shared_item) ? $shared_item : null; ?>
<?php $required_dirs = isset($required_dirs) ? $required_dirs : null; ?>
<?php $distname = isset($distname) ? $distname : null; ?>
<?php $release_dir = isset($release_dir) ? $release_dir : null; ?>
<?php $shared_dir = isset($shared_dir) ? $shared_dir : null; ?>
<?php $project_root = isset($project_root) ? $project_root : null; ?>
<?php $base_dir = isset($base_dir) ? $base_dir : null; ?>
<?php $remote = isset($remote) ? $remote : null; ?>
<?php $username = isset($username) ? $username : null; ?>
<?php $__container->servers(['web' => 'myapp_deployer']); ?>


<?php
  $username = 'deployer';                     // 서버의 사용자 계정
  $remote = 'https://github.com/jojieun/myapp.git';  // 깃허브 저장소 주소
  $base_dir = "/home/{$username}/www";        // 웹서비스를 담을 기본 디렉터리
  $project_root = "{$base_dir}/myapp";        // 프로젝트 루트 디렉터리
  $shared_dir = "{$base_dir}/shared";         // 새 코드를 배포해도 이전 코드와 연속성을 유지하는 하는 파일/디렉터리 모음
  $release_dir = "{$base_dir}/releases";      // 깃허브에서 받은 코드(릴리스)를 담을 디렉터리
  $distname = 'release_' . date('YmdHis');    // 릴리스 이름(디렉터리 이름)

  $required_dirs = [
    $shared_dir,
    $release_dir,
  ];

  $shared_item = [
    "{$shared_dir}/.env" => "{$release_dir}/{$distname}/.env",
    "{$shared_dir}/storage" => "{$release_dir}/{$distname}/storage",
    "{$shared_dir}/cache" => "{$release_dir}/{$distname}/bootstrap/cache",
<!--    "{$shared_dir}/files" => "{$release_dir}/{$distname}/public/files",-->
  ];
?>


<?php $__container->startTask('deploy', ['on' => ['web']]); ?>
  <?php foreach ($required_dirs as $dir): ?>
    [ ! -d <?php echo $dir; ?> ] && mkdir -p <?php echo $dir; ?>;
  <?php endforeach; ?>

  cd <?php echo $release_dir; ?> && git clone -b master <?php echo $remote; ?> <?php echo $distname; ?>;

  [ ! -f <?php echo $shared_dir; ?>/.env ] && cp <?php echo $release_dir; ?>/<?php echo $distname; ?>/.env.example <?php echo $shared_dir; ?>/.env;
  [ ! -d <?php echo $shared_dir; ?>/storage ] && cp -R <?php echo $release_dir; ?>/<?php echo $distname; ?>/storage <?php echo $shared_dir; ?>;
  [ ! -d <?php echo $shared_dir; ?>/cache ] && cp -R <?php echo $release_dir; ?>/<?php echo $distname; ?>/bootstrap/cache <?php echo $shared_dir; ?>;
  [ ! -d <?php echo $shared_dir; ?>/files ] && cp -R <?php echo $release_dir; ?>/<?php echo $distname; ?>/public/files <?php echo $shared_dir; ?>;

  <?php foreach($shared_item as $global => $local): ?>
    [ -f <?php echo $local; ?> ] && rm <?php echo $local; ?>;
    [ -d <?php echo $local; ?> ] && rm -rf <?php echo $local; ?>;
    ln -nfs <?php echo $global; ?> <?php echo $local; ?>;
  <?php endforeach; ?>

  cd <?php echo $release_dir; ?>/<?php echo $distname; ?> && composer install --prefer-dist --no-scripts --no-dev;

  ln -nfs <?php echo $release_dir; ?>/<?php echo $distname; ?> <?php echo $project_root; ?>;

  chmod -R 775 <?php echo $shared_dir; ?>/storage;
  chmod -R 775 <?php echo $shared_dir; ?>/cache;
  chmod -R 775 <?php echo $shared_dir; ?>/files;
  chgrp -h -R www-data <?php echo $release_dir; ?>/<?php echo $distname; ?>;

  sudo service nginx restart;
  sudo service php7.0-fpm restart;
<?php $__container->endTask(); ?>


<?php $__container->startTask('hello', ['on' => ['web']]); ?>
  HOSTNAME=$(hostname);
  echo "Hello Envoy! Responding from $HOSTNAME";
<?php $__container->endTask(); ?>
