    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            //Create task
            $('.add-task').click(function() {
                
                const method = 'POST';
                const url = 'task/add-task';
                
                var name = $('.name').val();
                var description = $('.description').val();
                var userId = $('.user-id').find(":selected").val();

                if (name == '') {
                    $('.notification').html('Vui lòng không để trống');
                }

                if (description == '') {
                    $('.notification').html('Vui lòng không để trống');
                }

                var data = {
                    name: name,
                    description: description,
                    userId: userId,
                }
                
                if (data.name != '' && data.description != '') {
                    sendData(method, data ,url);
                }
            });

            //Update status
            $('.update-status').click(function() {

                const method = 'POST';
                var status = $(this).data('status');
                var id = $(this).data('id');
                const url = 'task/update-status/'+id+'';

                var data = {
                    status: status,
                }

                sendData(method, data , url);
            });

            //Show task edit
            $('.edit-task').click(function() {
                var id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '/task/edit/'+id+'',
                    success: function(data) {
                        var users = data[1];
                        var template = ``;
                        template += `<div class="col-md-12">
                                <label>Task Name</label>
                                <input type="text" name="name" value="${data[0].name}" class="form-control name-update">
                            </div>
                            <div class="col-md-12">
                                <label>Task Description</label>
                                <textarea name="description" id="" class="form-control description-update" cols="30" rows="10">${data[0].description}</textarea>
                            </div>
                            <div class="col-md-12">
                                <label>User: </label>
                                <select name="user_id" id="" class="form-control user-id-up">
                                ${users.map((i) => {
                                    return `<option ${(`${i.id}` == `${data[0].user_id}`) ? 'selected="selected"' : ""} value="${i.id}">${i.name}</option>`;
                                    })}
                                </select>
                            </div>`;
                        $("#edit-table").html(template);
                        $(".update-task").attr('data-id', data[0].id);
                    }
                });
            });

            //Update Task
            $('.update-task').on('click', function() {
                var name = $('.name-update').val();
                var description = $('.description-update').val();
                var userId = $('.user-id-up').val();
                var data = {
                    name: name, 
                    description: description, 
                    userId: userId,
                }
                var id = $(this).data('id');
                const method = 'POST';
                const url = '/task/update/'+id+'';
                sendData(method, data , url);
            });

            //Create User
            $('.add-user').click(function() {
                var name = $('.name').val();
                var email = $('.email').val();
                var password = $('.password').val();

                if (name == '') {
                    $('.notification').html('Vui lòng không để trống');
                }

                if (email == '') {
                    $('.notification').html('Vui lòng không để trống');
                }

                if (password == '') {
                    $('.notification').html('Vui lòng không để trống');
                }

                const method = 'POST';
                const url = '/user/create';
                const data = {
                    name: name, 
                    email: email,
                    password: password,
                };

                if (name != '' && email != '' && password != '') {
                    sendData(method, data , url);
                }
            });

            //Edit User
            $('.edit-user').click(function() {
                var id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '/user/edit/'+id+'',
                    success: function(data) {
                        var template = ``;
                        template += `<div class="col-md-12">
                        <label>Name</label>
                        <input type="text" name="name" value="${data.name}" class="form-control name-update">
                        <span class="notification text-danger"></span>
                        </div>
                        <div class="col-md-12">
                            <label>Email</label>
                            <input type="email" name="email" value="${data.email}" class="form-control email-update">
                            <span class="notification text-danger"></span>
                        </div>`;
                        $("#edit-user").html(template);
                        $(".update-user").attr('data-id', data.id);
                    }
                });
            });

            $('.update-user').on('click', function() {
                var name = $('.name-update').val();
                var email = $('.email-update').val();

                if (name == '') {
                    $('.notification').html('Vui lòng không để trống');
                }

                if (email == '') {
                    $('.notification').html('Vui lòng không để trống');
                }

                var id = $(this).data('id');

                const data = {name:name, email:email};
                const method = 'POST';
                const url = '/user/update/'+id+'';
                if (name != '' && email != '') {
                    sendData(method, data , url);
                }
            });

            $('.delete-user').click(function() {
                var id = $(this).data('id');

                const url = '/user/delete/'+id+''
                const method = 'POST';

                $.ajax({
                    type: method,
                    url: url,
                    success: function(data) {
                        window.location.reload();
                    }
                });
            });
        });
        
        function sendData(method, data, url) {
            $.ajax({
                type: method,
                url: url,
                data: data,
                success: function(data) {
                    if (data != '') {
                        window.location.reload(); 
                    }
                }
            });
        }
    </script>
</body>
</html>