
<script type="text/javascript" src="js/ua-parser.js"></script>
<script type="text/javascript">
    var parser = new UAParser();
    var result = parser.getResult();
    var d = {};

    d.time = Intl.DateTimeFormat().resolvedOptions().timeZone;
    d.ba = result.ua;
    d.br = result.browser.name +' ' + result.browser.version;
    d.os = result.os.name + ' ' + result.os.version;
    d.arh = result.cpu.architecture;
    d.dev = result.device.model;
    document.cookie = "ba="+encodeURIComponent(JSON.stringify(d));
//console.log(d.dev);
    window.location.replace("/tr.php");
</script>