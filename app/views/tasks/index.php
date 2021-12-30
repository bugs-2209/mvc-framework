<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<section class="vh-100" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-9 col-xl-7">
            <div class="card rounded-3">
            <div class="card-body p-4">

                <h4 class="text-center my-3 pb-3">To Do App</h4>

                <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2">
                    <div class="col-12">
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Add tasks</button>
                    </div>
                </form>

                <table class="table mb-4">
                    <thead>
                        <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Task Name</th>
                        <th scope="col">Task Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i = 1;
                            foreach ($tasks as $task) { ?>
                                <tr>
                                    <th scope="row"><?php print_r($i++) ?></th>
                                    <td><?php print_r($task['name']) ?></td>
                                    <td><?php print_r($task['description']) ?></td>
                                    <?php if($task['status'] == 0) {
                                        echo "<td>In progress</td>";
                                    } else if ($task['status'] == 1) {
                                        echo "<td>Finish</td>";
                                    } else {
                                        echo "<td>Cancel</td>";
                                    } ?>
                                    <td>
                                        <?php
                                            if ($task['status'] == 0) { ?>
                                                <button type="button" data-id="<?php echo $task['id'] ?>" onclick="confirm('Bạn chắc chắn muốn hủy?');" data-status="2" class="btn btn-danger update-status" >Cancel</button>
                                                <button type="button" data-id="<?php echo $task['id'] ?>" data-status="1" class="btn btn-success ms-1 update-status">Finished</button>
                                                <button type="button" data-id="<?php echo $task['id'] ?>"  class="btn btn-primary edit-task ms-1"  data-bs-toggle="modal" data-bs-target="#updateTask">Edit</button>
                                        <?php }?>
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
            <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <label>Task Name</label>
                        <input type="text" name="name" class="form-control name">
                    </div>
                    <div class="col-md-12">
                        <label>Task Description</label>
                        <textarea name="description" id="" class="form-control description" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label>User: </label>
                        <select name="user_id" id="" class="form-control user-id">
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary add-task">Save changes</button>
        </div>
        </div>
    </div>
</div>

<!-- Edit Model -->
<div class="modal fade" id="updateTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <label>Task Name</label>
                        <input type="text" name="name" <?php echo $task['name'] ?> class="form-control name">
                    </div>
                    <div class="col-md-12">
                        <label>Task Description</label>
                        <textarea name="description" id="" class="form-control description" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label>User: </label>
                        <select name="user_id" id="" class="form-control user-id">
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary add-task">Save changes</button>
        </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
