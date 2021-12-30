<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<section class="vh-100" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-9 col-xl-7">
            <div class="card rounded-3">
            <div class="card-body p-4">
                <h4 class="text-center my-3 pb-3">Welcome to FPT</h4>
                <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2">
                    <div class="col-12">
                        <a href="/task" class="btn btn-warning">Tasks</a>
                        <a href="/users" class="btn btn-info">Users</a>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>