<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/CodeController.php';

$code_controller = new CodeController();
$codes = $code_controller->codeList();

if ($codes != null) {
    foreach ($codes as $code) {
        $codeList[] += $code['code'];
    }
}


if (isset($_POST['submit'])) {
    if (strlen($_POST['code']) < 6)
        $codeError = 'Code must be greater than 6 words';

    if (empty($_POST['code']))
        $codeError = 'Please Enter Code';

    if (in_array($_POST['code'], $codeList))
        $codeError = 'This code is already added';

    if (!isset($codeError)) {
        $code = $_POST['code'];

        $code_controller = new CodeController();
        $status = $code_controller->addCode($code);

        if ($status) {
            echo '<script>location.href="code.php?status=' . $status . '"</script>';
        }
    };
}

?>
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Add New Code</strong></h1>

        <div class='row'>
            <div class='col-md-12'>
                <form action='' method='POST'>
                    <div>
                        <label class='form-label'>Code</label>
                        <input type='text' name='code' value="<?php if (isset($_POST['code'])) echo $_POST['code']; ?>" class='form-control'>
                        <?php if (isset($codeError)) echo '<span class="text-danger">' . $codeError . '</span>' ?>
                    </div>
                    <div class='mt-3'>
                        <button class='btn btn-dark' name='submit'>Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php

include_once __DIR__ . '/../../layouts/admin_footer.php';

?>