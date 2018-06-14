<?php

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/Poll.php');

try {
  $poll = new \MyApp\Poll();
} catch (Exception $e) {
  echo $e->getMessage();
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $poll->post();
}

$err = $poll->getError();
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>Poll</title>
    <link rel="stylesheet" href="/css/style.css">
  </head>
  <body>
    <?php if (isset($err)) : ?>
    <div class="error"><?= h($err); ?></div>
    <?php endif; ?>
    <h1>Which do you like best?</h1>
    <form class="" action="" method="post">
      <div class="row">
        <div class="box" id="box_0" data-id="0"></div>
        <div class="box" id="box_1" data-id="1"></div>
        <div class="box" id="box_2" data-id="2"></div>
        <input type="hidden" id="answer" name="answer" value="">
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      </div>
      <div class="" id="btn">Vote</div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    $(function() {
      'use strict';

      $('.box').on('click', function() {
        $('.box').removeClass('selected');
        $(this).addClass('selected');
        $('#answer').val($(this).data('id'));
      });

      $('#btn').on('click', function() {
        if ($('#answer').val() === '') {
          alert('選んでね');
        } else {
          $('form').submit();
        }
      });

      $('.error').fadeOut(3000);
    });
    </script>
  </body>
</html>
