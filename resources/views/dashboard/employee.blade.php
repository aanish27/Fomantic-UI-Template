<x-app-layout>
    <table id="myTable" class="ui very compact striped table" width="100%"></table>

    <script type="module">
        $(document).ready(function () {
            let table = $('#myTable').DataTable({
            scrollCollapse: true,
            scrollX: true,
            scrollY: 690,
            serverSide: true,
            processing: true,
            ajax: {
                url: 'employee/draw',
            },
            columns: [
                {
                    data: 'id',
                    title:'#' ,
                    name: 'id',
                },
                {
                    data: null ,
                    title: "Actions",
                    render: function (data, type, row) {
                        return `<button class="ui icon button" style="padding: 0; background:transparent;">
                                    <i class="edit outline small bordered colored icon green"></i>
                                </button>

                                <button class="ui icon button" style="padding: 0; background:transparent;">
                                    <i class="trash alternate outline small bordered colored icon red"></i>
                                </button>
                                `
                    },
                    name: 'action',
                    orderable: false,
                    sortable: false,
                },
                {
                    data: 'name' ,
                    title: 'Name' ,
                    name: 'name',
                },
                {
                    data: 'position' ,
                    title:'Position' ,
                    name: 'position',
                },
                {
                    data: 'dob',
                    title:'DOB' ,
                    name: 'dob',
                },
                {
                    data: 'email' ,
                    title:'Email' ,
                    name: 'email',
                },
                {
                    data: 'phone',
                    title:'Phone' ,
                    name: 'phone'
                },
                {
                    data: 'address' ,
                    title:'Address' ,
                    name: 'address',
                },
            ],
        });

        $('#myTable').on('draw.dt', function () {
            if (localStorage.getItem('theme') == 'dark') {
                $('.ui.unstackable.pagination.menu').addClass('inverted');
            }
        });
    });
    </script>
</x-app-layout>
