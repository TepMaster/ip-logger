<html>
<head>
    <script src="js/ua-parser.js"></script>
    <script>

        var parser = new UAParser();
        console.log(parser.getResult());
        var result = parser.getResult();
        // You can also use UAParser constructor directly without having to create an instance:
        // var result = UAParser(uastring1);

        console.log(result.browser);        // {name: "Chromium", version: "15.0.874.106"}
        console.log(result.device);         // {model: undefined, type: undefined, vendor: undefined}
        console.log(result.os);             // {name: "Ubuntu", version: "11.10"}
        console.log(result.os.version);     // "11.10"
        console.log(result.engine.name);    // "WebKit"
        console.log(result.device.model);   // "amd64"

        /* Do some other tests
        var uastring2 = "Mozilla/5.0 (compatible; Konqueror/4.1; OpenBSD) KHTML/4.1.4 (like Gecko)";
        console.log(parser.setUA(uastring2).getBrowser().name); // "Konqueror"
        console.log(parser.getOS());
        console.log(parser.getEngine());

        var uastring3 = 'Mozilla/5.0 (PlayBook; U; RIM Tablet OS 1.0.0; en-US) AppleWebKit/534.11 (KHTML, like Gecko) Version/7.1.0.7 Safari/534.11';
        console.log(parser.setUA(uastring3).getDevice().model);
        console.log(parser.getOS())
        console.log(parser.getBrowser().name);
*/
    </script>
</head>
<body>
</body>
</html>

<form method="" action="dec.php">
    Name: <input type="text" name="name"><br><br/>
    Email: <input type="text" name="email"><br/>
    <br/>
    <input type="submit" value="submit" >
</form>
<?php

if(empty($_POST['name']) && empty($_POST['email'])){
    # If the fields are empty, display a message to the user
    echo " <br/> Please fill in the fields";
    # Process the form data if the input fields are not empty
}else{
    $name= $_POST['name'];
    $email= $_POST['email'];
    echo ('Your Name is:     '. $name. '<br/>');
    echo ('Your Email is:'   . $email. '<br/>');
}

?>