<!DOCTYPE html>
<html>
    <head>
        <title>PHP Calculator</title>
        <meta charset="utf-8">
    </head>
    <body>
        <main>
            <h1>PHP Calculator</h1>
            <section id="input">
                <h2>Input</h2>
                <form action="." method="GET">
                    <input type="number" id="num1" name="num1" placeholder="Number 1" required>
                    <select name="operator" required onchange="setNum2();">
                        <option value="Add">+</option>
                        <option value="Sub">-</option>
                        <option value="Mul">*</option>
                        <option value="Div">/</option>
                        <option value="Sqrt">√</option>
                        <option value="Pow2">^2</option>
                        <option value="Pow">^</option>
                        <option value="Log10">log()</option>
                        <option value="Log2">ln()</option>
                        <option value="TenPow">10^</option>
                        <option value="EPow">e^</option>
                        <option value="Sin">sin()</option>
                        <option value="Cos">cos()</option>
                        <option value="Tan">tan()</option>
                    </select>
                    <script>
                        function setNum2() {
                            var operator = document.getElementsByName("operator")[0].value;
                            if (operator == "Sqrt" || operator == "Pow2" || operator == "Log10" || operator == "Log2" || operator == "TenPow" || operator == "EPow" || operator == "Sin" || operator == "Cos" || operator == "Tan") {
                                document.querySelector("input#num2").disabled = true;
                                document.querySelector("input#num2").required = false;
                            } else {
                                document.querySelector("input#num2").disabled = false;
                                document.querySelector("input#num2").required = true;
                            }
                        }
                    </script>
                    <input type="number" id="num2" name="num2" placeholder="Number 2" required>
                    <input type="submit" value="Calculate">
                </form>
            </section>
            <section id="output">
                <h2>Output</h2>
                <?php 
                    ini_set('display_errors', '1');
                    ini_set('display_startup_errors', '1');
                    error_reporting(E_ALL);
                    interface Operation {
                        function calculate($num1, $num2);
                    }
                    class Add implements Operation {
                        function calculate($num1, $num2) {
                            return $num1 + $num2;
                        }
                    }
                    class Sub implements Operation {
                        function calculate($num1, $num2) {
                            return $num1 - $num2;
                        }
                    }
                    class Mul implements Operation {
                        function calculate($num1, $num2) {
                            return $num1 * $num2;
                        }
                    }
                    class Div implements Operation {
                        function calculate($num1, $num2) {
                            return $num1 / $num2;
                        }
                    }
                    class Sqrt implements Operation {
                        function calculate($num1, $num2) {
                            return sqrt($num1);
                        }
                    }
                    class Pow2 implements Operation {
                        function calculate($num1, $num2) {
                            return pow($num1, 2);
                        }
                    }
                    class Pow implements Operation {
                        function calculate($num1, $num2) {
                            return pow($num1, $num2);
                        }
                    }
                    class Log10 implements Operation {
                        function calculate($num1, $num2) {
                            return log10($num1);
                        }
                    }
                    class Log2 implements Operation {
                        function calculate($num1, $num2) {
                            return log($num1);
                        }
                    }
                    class TenPow implements Operation {
                        function calculate($num1, $num2) {
                            return pow(10, $num1);
                        }
                    }
                    class EPow implements Operation {
                        function calculate($num1, $num2) {
                            return pow(exp(1), $num1);
                        }
                    }
                    class Sin implements Operation {
                        function calculate($num1, $num2) {
                            return sin($num1);
                        }
                    }
                    class Cos implements Operation {
                        function calculate($num1, $num2) {
                            return cos($num1);
                        }
                    }
                    class Tan implements Operation {
                        function calculate($num1, $num2) {
                            return tan($num1);
                        }
                    }
                    if (isset($_GET["operator"])) {
                        $result;
                        switch ($_GET["operator"]) {
                            case "Add":
                                $result = (new Add())->calculate($_GET["num1"], $_GET["num2"]);
                                break;
                            case "Sub":
                                $result = (new Sub())->calculate($_GET["num1"], $_GET["num2"]);
                                break;
                            case "Mul":
                                $result = (new Mul())->calculate($_GET["num1"], $_GET["num2"]);
                                break;
                            case "Div":
                                $result = (new Div())->calculate($_GET["num1"], $_GET["num2"]);
                                break;
                            case "Sqrt":
                                $result = (new Sqrt())->calculate($_GET["num1"], 0);
                                break;
                            case "Pow2":
                                $result = (new Pow2())->calculate($_GET["num1"], 0);
                                break;
                            case "Pow":
                                $result = (new Pow())->calculate($_GET["num1"], $_GET["num2"]);
                                break;
                            case "Log10":
                                $result = (new Log10())->calculate($_GET["num1"], 0);
                                break;
                            case "Log2":
                                $result = (new Log2())->calculate($_GET["num1"], 0);
                                break;
                            case "TenPow":
                                $result = (new TenPow())->calculate($_GET["num1"], 0);
                                break;
                            case "EPow":
                                $result = (new EPow())->calculate($_GET["num1"], 0);
                                break;
                            case "Sin":
                                $result = (new Sin())->calculate($_GET["num1"], 0);
                                break;
                            case "Cos":
                                $result = (new Cos())->calculate($_GET["num1"], 0);
                                break;
                        }
                        echo "<p>Result: $result</p>";
                    } else {
                        echo "<p>Submit something please</p>";
                    }
                ?>
            </section>
        </main>
    </body>
</html>