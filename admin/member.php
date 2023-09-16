<?php

$g_title = '네카라쿠배';
$js_array = ['js/home.js'];

$menu_code = 'member';

    include '../inc/dbconfig.php';
    include '../inc/lib.php';
    include '../inc/member.php'; //회원 관리 class
    include 'inc_common.php';
    include 'inc_header.php';

    $mem = new Member($db);

    $total = $mem->total();
    $limit = 2;
    $page_limit = 5;
    $page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1; //is_numeric()는 주어진값이 숫자일때 참, 아니면 거짓
    $param = '';

    // print_r($_GET['page']);

    $memArr = $mem->list($page, $limit);

?>
<main class="w-75 mx-auto border rounded-5 p-5" style="height:calc(100vh - 257px);overflow:scroll">
    <div class="container">
        <h3>회원관리</h3>
    </div>

    <table class="table table-border" style="">
        <tr>
            <th>번호</th>
            <th>아이디</th>
            <th>이름</th>
            <th>이메일</th>
            <th>등록일시</th>
            <th>관리</th>
        </tr>
        <?php 
            foreach($memArr as $item){
        ?>
            <tr>
                <td><?= $item["idx"]?></td>
                <td><?= $item["id"]?></td>
                <td><?= $item["name"]?></td>
                <td><?= $item["email"]?></td>
                <td><?= $item["create_at"]?></td>
                <td><button class="btn btn-primary btn-sm">수정</button></td>
                <td><button class="btn btn-danger btn-sm">삭제</button></td>
            </tr>
        <?php
            }
        ?>
    </table>


</main>
    <?php 
    echo my_pagination($total, $limit, $page_limit, $page, $param);
    ?>

<?php 
include 'inc_footer.php';
?>