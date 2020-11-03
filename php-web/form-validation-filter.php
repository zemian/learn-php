<?php 
// https://www.php.net/manual/en/filter.filters.validate.php
//print_r($_POST);
//print_r($_SERVER);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = [];
    if (!filter_var($_POST['string'], FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/\w+/']])) {
        $error['string'] = 'Accept words only';
    }
    if (!filter_var($_POST['int'], FILTER_VALIDATE_INT)) {
        $error['int'] = 'Accept int only';
    }
    if (!filter_var($_POST['intrange'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 100]])) {
        $error['intrange'] = 'Accept intrange only: 1 to 100';
    }
    if (!filter_var($_POST['float'], FILTER_VALIDATE_FLOAT)) {
        $error['float'] = 'Accept float only';
    }
    if (filter_var($_POST['boolean'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === NULL) {
        $error['boolean'] = 'Accept boolean only: true/false, 1/0, on/off, yes/no';
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'Accept email only';
    }
    if (!filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
        $error['url'] = 'Accept url only';
    }
    if (!filter_var($_POST['ip'], FILTER_VALIDATE_IP)) {
        $error['ip'] = 'Accept ip only';
    }
    if (!filter_var($_POST['hostname'], FILTER_VALIDATE_DOMAIN)) {
        $error['hostname'] = 'Accept hostname only';
    }
}
?>
<h1>PHP built-in filter validation</h1>
<form method="POST">
    <div>
        <div>string</div>
        <div><input type="text" name="string" value="<?php echo $_POST['string'] ?? 'test'; ?>"></div>
        <div style="color: red;"><?php echo $error['string'] ?? ''; ?></div>
    </div>
    <div>
        <div>int</div>
        <div><input type="text" name="int" value="<?php echo $_POST['int'] ?? '123'; ?>"></div>
        <div style="color: red;"><?php echo $error['int'] ?? ''; ?></div>
    </div>
    <div>
        <div>intrange</div>
        <div><input type="text" name="intrange" value="<?php echo $_POST['intrange'] ?? '55'; ?>"></div>
        <div style="color: red;"><?php echo $error['intrange'] ?? ''; ?></div>
    </div>
    <div>
        <div>float</div>
        <div><input type="text" name="float" value="<?php echo $_POST['float'] ?? '3.14'; ?>"></div>
        <div style="color: red;"><?php echo $error['float'] ?? ''; ?></div>
    </div>
    <div>
        <div>boolean</div>
        <div><input type="text" name="boolean" value="<?php echo $_POST['boolean'] ?? 'true'; ?>"></div>
        <div style="color: red;"><?php echo $error['boolean'] ?? ''; ?></div>
    </div>
    <div>
        <div>email</div>
        <div><input type="text" name="email" value="<?php echo $_POST['email'] ?? 'test@test.com'; ?>"></div>
        <div style="color: red;"><?php echo $error['email'] ?? ''; ?></div>
    </div>
    <div>
        <div>url</div>
        <div><input type="text" name="url" value="<?php echo $_POST['url'] ?? 'http://localhost:3000'; ?>"></div>
        <div style="color: red;"><?php echo $error['url'] ?? ''; ?></div>
    </div>
    <div>
        <div>ip</div>
        <div><input type="text" name="ip" value="<?php echo $_POST['ip'] ?? '127.0.0.1'; ?>"></div>
        <div style="color: red;"><?php echo $error['ip'] ?? ''; ?></div>
    </div>
    <div>
        <div>hostname</div>
        <div><input type="text" name="hostname" value="<?php echo $_POST['hostname'] ?? 'localhost'; ?>"></div>
        <div style="color: red;"><?php echo $error['hostname'] ?? ''; ?></div>
    </div>
    <div>
        <div><input type="submit"></div>
    </div>
</form>