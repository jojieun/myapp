<script>
function money(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}
function notmoney(str) {
    str = String(str);
    return Number(str.replace(/[^\d]+/g, ''));
}
</script>