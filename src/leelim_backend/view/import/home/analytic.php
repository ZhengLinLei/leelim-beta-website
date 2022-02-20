<script>
    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>
<div class="container-fluid">
    <?php
    $mvc = new MVCcontroller();
    //NOT ALLOWED
    if(!$_SESSION['employer_account']['role']['analytic']){
        $mvc->include_modules('error/403');
    }else{
        if (!isset($_GET['type'])) {
            $mvc->include_modules('home/analytic/empty');
        } else {
            $key = ['order', 'earning', 'user', 'view'];
            if(!in_array($_GET['type'], $key)){
                $mvc->include_modules('error/404');
            }else{
                $mvc->include_modules('home/analytic/' . $_GET['type']);
            }
        }
    }
    ?>
</div>