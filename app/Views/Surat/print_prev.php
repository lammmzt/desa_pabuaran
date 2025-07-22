<?= $template; ?>
<script>
window.print();

// when print is done, close the window
window.onafterprint = function() {
    window.close();
}
</script>