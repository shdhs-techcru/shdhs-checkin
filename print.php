<p>

<?php
session_start();

$output = $_SESSION['output'];
echo $output;
echo $timeStamp;

session_destroy();
?>
</div>
</p>

<script>

  window.print();
  
</script>