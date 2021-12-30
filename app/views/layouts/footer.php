    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.add-task').click(function() {
                
                const method = 'POST';
                const url = 'task/add-task';

                var name = $('.name').val();
                var description = $('.description').val();
                var userId = $('.user-id').find(":selected").val();
                
                var data = {
                    name: name,
                    description: description,
                    userId: userId,
                }

                sendData(method, data ,url);
            });

            

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

            $('.edit-task').click(function() {
                var id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '/task/edit/'+id+'',
                    success: function(data) {
                        
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
                    if (data) {
                        window.location.reload();
                    }
                }
            });
        }
    </script>
</body>
</html>