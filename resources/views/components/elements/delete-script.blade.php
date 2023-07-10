@props(['name', 'dashboard' => 'administrator'])
<script>
    function confirmDestroy(id, reference) {
        Swal.fire({
            title: 'هل انت متاكد؟',
            text: "انت تريد حذف هذا العنصر!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'اجل ,احذفه!'
        }).then((result) => {
            if (result.isConfirmed) {
                destroy(id, reference);
            }
        })
    }

    function destroy(id, reference) {
        axios.delete('/{{ $dashboard }}/{{ $name }}/' + id)
            .then(function(response) {
                // handle success
                console.log(response);
                reference.closest('tr').remove();
                showMessage(response.data)
            })
            .catch(function(error) {
                // handle error
                console.log(error);
                showMessage(error.response.data);
            })
            .then(function() {
                // always executed
            });
    }

    function showMessage(data) {
        Swal.fire({
            icon: data.icon,
            title: data.title,
            showConfirmButton: false,
            timer: 1000
        })
    }
</script>
