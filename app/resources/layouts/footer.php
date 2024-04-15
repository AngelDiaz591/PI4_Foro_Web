<?php
function get_footer($data, ...$scripts){
?>

    </main>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <?php foreach($scripts as $script): ?>
    <script src="/assets/js/<?= $script ?>"></script>
  <?php endforeach; ?>

<?php } ?>

<?php function end_footer(){ ?>
</body>
</html>
<?php } ?>
