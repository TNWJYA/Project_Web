<?php
    require_once '../layout/header.php';
    require_once '../layout/auth.php';
    require_once '../layout/navbar.php';

    $id = $_GET['id'];

    $sql = "SELECT * FROM diskusi WHERE diskusi.id_diskusi='$id'";
    $query = mysqli_query($conn,$sql) or trigger_error("query error: ".mysqli_error($conn));
    $judul = mysqli_fetch_assoc($query);

    $sql = "SELECT *,diskusi_chat.img as 'image'  FROM diskusi_chat JOIN user ON diskusi_chat.id_user = user.id_user
            WHERE diskusi_chat.id_diskusi='$id'";
    $query = mysqli_query($conn,$sql);

    $activePage = 1;
    $pageData = 10;
    
    if(isset($_GET['page'])){
        $activePage = $_GET['page'];
    }
    
    $sql = "SELECT * FROM diskusi_chat WHERE diskusi_chat.id_diskusi='$id'";
    $result = mysqli_query($conn, $sql);
    $totalData = mysqli_num_rows($result);
    $totalPage = ceil($totalData / $pageData);
    $firstData = ($pageData * $activePage) - $pageData;

    $sql = "SELECT *,diskusi_chat.img as 'image' FROM diskusi_chat JOIN user ON diskusi_chat.id_user = user.id_user
    WHERE diskusi_chat.id_diskusi='$id' LIMIT $firstData, $pageData";
    $query = mysqli_query($conn,$sql);

    $a = 1;

    $checkData = mysqli_num_rows($query);
    
?>
<style>
    .trix-button--icon-attach {
        display: none;
    }
</style>
<main class="container my-5">
    <?php if($checkData < 1): ?>
    <div class="card col-md-12 mx-auto mt-3 p-3 rounded-4">
        <div class="card-body">
            <div class="title">
                <h3><?= $judul['judul_diskusi'] ?></h3>
            </div>
            <div class="row mt-5">
                <div class="contents col-md-10 mt-lg-0 mt-3">
                    Belum ada comment
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php while($data = mysqli_fetch_assoc($query)): 
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $data['created_at']);

        // Format the DateTime object to the desired format
        $formattedDate = $date->format('d M Y, H:i');
        ?>
    <div class="card col-md-12 mx-auto mt-3 p-3 rounded-4">
        <div class="card-body">
            <?php if($a==1): ?>
            <div class="title">
                <h3><?= $judul['judul_diskusi'] ?></h3>
            </div>
            <?php endif; ?>

            <div class="row mt-5">
                <div class="author col-md-2 text-center align-self-top">
                    <div class=" card border-primary p-2 rounded-pill">
                        <div class="">
                            <img src="<?= $data['img'] == null ? 'https://ui-avatars.com/api/?name='. $data['nama'] .'' : $data['img']  ?>"
                                width="30" alt="">
                            <span class="fs-6" id='name-<?= $data['id_diskusi_chat'] ?>'><?= $data['nama'] ?></span>
                        </div>
                        <small class="text-dark"><?= $formattedDate ?></small>
                    </div>
                </div>

                <div class="contents col-md-10 mt-lg-0 mt-3" id='comment-<?= $data['id_diskusi_chat'] ?>'>
                    <?php if($data['image'] != ''): ?>
                    <img src="img/<?= $data['image'] ?>" width="100" alt="">
                    <?php endif; ?>
                    <?php if($data['id_parent'] != null): 
                            $parent_id = $data['id_parent'];
                            $sql_parent = "SELECT *,diskusi_chat.img as 'image'  
                            FROM diskusi_chat JOIN user ON diskusi_chat.id_user = user.id_user
                            WHERE id_diskusi_chat='$parent_id'";
                            $query_parent = mysqli_query($conn, $sql_parent);
                            $data_parent = mysqli_fetch_assoc($query_parent);
                        ?>
                    <div class="card bg-body-tertiary mt-lg-0 mt-3 rounded-4">
                        <div class="card-body">
                            <h6><?= $data_parent['nama'] ?></h6>
                            <p>
                                <?= $data_parent['content'] ?>
                            </p>
                        </div>
                    </div>
                    <?php endif; ?>
                    <p class="mt-2">
                        <div id="content-<?= $data['id_diskusi_chat'] ?>"><?= $data['content'] ?></div>
                    </p>
                    <div class="actions mt-3">
                        <div class="d-flex flex-row">
                            <?php if($_SESSION['loginData']['role'] == 'user'): ?>
                            <div class="align-self-center btn-reply" style="cursor: pointer;"
                                onclick="Reply(<?= $data['id_diskusi_chat'] ?>)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-reply-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M5.921 11.9 1.353 8.62a.719.719 0 0 1 0-1.238L5.921 4.1A.716.716 0 0 1 7 4.719V6c1.5 0 6 0 7 8-2.5-4.5-7-4-7-4v1.281c0 .56-.606.898-1.079.62z" />
                                </svg>
                            </div>
                            <div class="ms-3 align-self-center">
                                <a href="../report/add.php?id_chat=<?= $data['id_diskusi_chat'] ?>"><svg
                                        xmlns="http://www.w3.org/2000/svg" class="text-danger" width="20" height="20"
                                        fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    </svg>
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if($_SESSION['loginData']['role'] == 'admin' || $_SESSION['loginData']['user_id'] == $data['id_user']): ?>
                            <div class="ms-3 align-self-center">
                                <a href="delete-act.php?id=<?= $data['id_diskusi_chat'] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="20" height="20"
                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $a = 2; endwhile; ?>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <?php if($activePage>1): ?>
                <li class="page-item"><a class="page-link" href="?id=<?= $id ?>&page=<?= $activePage-1 ?>">Previous</a>
                </li>
                <?php endif; ?>
                <?php for($i=1; $i<=$totalPage; $i++): ?>
                <li class="page-item"><a class="page-link" href="?id=<?= $id ?>&page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor; ?>
                <?php if($activePage<$totalPage): ?>
                <li class="page-item"><a class="page-link" href="?id=<?= $id ?>&page=<?= $activePage+1 ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <!-- End Pagination -->
    <?php if($_SESSION['loginData']['role'] != 'admin'): ?>
    <!-- Form answer main -->
    <div class="form-answer card mt-5 rounded-4 p-3">
        <div class="card-body">
            <form id="myForm" action="add-act.php" enctype="multipart/form-data" method='post'>
                <div class="mb-4">
                    <h5 for="x" class="form-label text-bold mb-3">Masukkan Komentar</h5>
                    <div id="target">

                    </div>
                    <h6 class="form-label text-bold">Masukkan file gambar(Opsional):</h6>
                    <input id="file" type="file" name="file" class="form-control mb-3">
                    <input id="x" type="hidden" name="content" required>
                    <input type="hidden" name="id" value='<?= $id ?>'>
                    <trix-editor id="trix-editor" input="x" style="min-height: 200px;"></trix-editor>
                </div>

                <button type="submit" class="btn btn-primary btn-lg rounded-5 px-4 py-2 col-12 fw-bold">Submit</button>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <!-- End Form answer main -->
</main>
<?php 
        require_once '../layout/footer.php';
    ?>
<script>
    function parent(id) {
        let comment = $("#comment" + id).clone();
        // $("#target"+id).clone();
    }

    function Reply(id) {
        let nama = $("#name-" + id).html();
        let content_field = $("#content-" + id).html();
        content = `
            <h6 class="form-label text-bold">Membalas untuk</h6>
            <input class="form-control mb-3" disabled value="` + nama + `">
            <textarea disabled class="form-control mb-3">` + $(content_field).text() + `</textarea>
            <button type='button' class='btn btn-danger mb-3' onclick='replyRemove();'>Cancel</button>
            <input type="hidden" name='reply' value="` + id + `">
        `;
        $("#target").html(content);
    }

    function replyRemove() {
        $("#target").empty();
    }
</script>