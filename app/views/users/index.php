<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<section class="vh-100" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-9 col-xl-7">
            <div class="card rounded-3">
                <a href="/" class="btn btn-dark">Back</a>
            <div class="card-body p-4">

                <h4 class="text-center my-3 pb-3">User Manager</h4>
                
                <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2">
                    <div class="col-12">
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Add users</button>
                    </div>
                </form>

                <table class="table mb-4">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                            $i = 1;
                            foreach ($users as $user) { ?>
                                <tr>
                                    <th scope="row"><?php print_r($i++) ?></th>
                                    <td><?php print_r($user['name']) ?></td>
                                    <td><?php print_r($user['email']) ?></td>
                                    <td>
                                        <button type="button" data-id="<?php echo $user['id'] ?>" onclick="confirm('Bạn chắc chắn muốn xóa?');" class="btn btn-danger delete-user">Delete</button>
                                        <button type="button" data-id="<?php echo $user['id'] ?>"  class="btn btn-primary edit-user ms-1"  data-bs-toggle="modal" data-bs-target="#updateUser">Edit</button>
                                    </td>
                                </tr>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>
<!-- Modal Add -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control name">
                        <span class="notification text-danger"></span>
                    </div>
                    <div class="col-md-12">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control email">
                        <span class="notification text-danger"></span>
                    </div>
                    <div class="col-md-12">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control password">
                        <span class="notification text-danger"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary add-user">Save changes</button>
        </div>
        </div>
    </div>
</div>

<!-- Edit User -->
<div class="modal fade" id="updateUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="row">
                    <div id="edit-user">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" data-id="" class="btn btn-primary update-user">Update</button>
        </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
